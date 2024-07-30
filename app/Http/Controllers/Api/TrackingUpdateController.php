<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TrackingUpdate;
use App\Models\Parcel;
use App\Models\Customer;
use App\Models\Receiver;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TrackingUpdateController extends Controller
{
     /**
     * Display a listing of the tracking updates.
     */
    public function index(): View
    {
        $trackingUpdates = TrackingUpdate::with('parcel')->latest()->paginate(10);
        return view('admin.trackingupdates.index', compact('trackingUpdates'));
    }

    /**
     * Show the form for creating a new tracking update.
     */
    public function create(): View
    {
        $parcels = Parcel::all();
        $receivers = Receiver::all();
        return view('admin.trackingupdates.create', compact('parcels','receivers'));
    }

    /**
     * Store a newly created tracking update in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'parcel_id' => 'required|exists:parcels,id',
            'status' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
            'tracking_number' => 'nullable|string|max:255', // You can remove this if tracking_number is not stored
        ]);
    
        TrackingUpdate::create([
            'parcel_id' => $validated['parcel_id'],
            'status' => $validated['status'],
            'location' => $validated['location'],
            'description' => $validated['description'],
            'tracking_number' => $validated['tracking_number'] ?? null, // Only if you are storing it
        ]);
    
        return redirect()->route('api.tracking-updates.index')
            ->with('success', 'Tracking update created successfully.');
    }
    
    /**
     * Display the specified tracking update.
     */
    // public function show(TrackingUpdate $trackingUpdate): View
    // {
    //      return view('admin.trackingupdates.show', compact('trackingUpdate'));
    // }

    /**
     * Show the form for editing the specified tracking update.
     */
    public function edit(TrackingUpdate $trackingUpdate): View
    {
        $parcels = Parcel::all();
        return view('admin.trackingupdates.update', compact('trackingUpdate', 'parcels'));
    }

    /**
     * Update the specified tracking update in storage.
     */
    public function update(Request $request, TrackingUpdate $trackingUpdate): RedirectResponse
    {
        $validated = $request->validate([
            'parcel_id' => 'required|exists:parcels,id',
            'status' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $trackingUpdate->update($validated);

        return redirect()->route('api.tracking-updates.index')
            ->with('success', 'Tracking update updated successfully.');
    }

    
    public function destroy(TrackingUpdate $trackingUpdate): RedirectResponse
    {
        $trackingUpdate->delete();

        return redirect()->route('api.tracking-updates.index')
            ->with('success', 'Tracking update deleted successfully.');
    }

    public function getTrackingInfo($trackingNumber)
    {
        // Fetch the parcel data based on the tracking number
        $parcel = Parcel::where('tracking_number', $trackingNumber)->first();

        if (!$parcel) {
            return response()->json(['message' => 'Tracking number not found'], 404);
        }

        // Return the relevant tracking data
        return response()->json([
            'status' => $parcel->status,
            'location' => $parcel->location,
        ]);
    }
}
