<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TrackingUpdate;
use App\Models\Parcel;
use App\Models\Receiver;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TrackingUpdateController extends Controller
{
    public function index(): View
{
    $trackingUpdates = TrackingUpdate::with('parcel')->latest()->paginate(10);
    $parcels = Parcel::with('receiver')->get();
    return view('admin.trackingupdates.index', compact('trackingUpdates', 'parcels'));
}

    public function updateOrCreate(Request $request): RedirectResponse
    {
        $receivers = Receiver::all();
        $validated = $request->validate([
            'parcel_id' => 'required|exists:parcels,id',
            'location' => 'nullable|string|max:255',
        ]);

        $parcel = Parcel::findOrFail($validated['parcel_id']);

        TrackingUpdate::updateOrCreate(
            ['parcel_id' => $parcel->id],
            [
                'status' => $parcel->status,
                'location' => $validated['location'],
                'description' => $parcel->description,
                'tracking_number' => $parcel->tracking_number,
            ]
        );

        return redirect()->route('api.tracking-updates.index')
            ->with('success', 'Tracking update created/updated successfully.');
    }

    public function edit(TrackingUpdate $trackingUpdate): View
    {
        $parcels = Parcel::all();
        $receivers = Receiver::all();
        return view('admin.trackingupdates.update', compact('trackingUpdate', 'parcels','receivers'));
    }

    public function update(Request $request, TrackingUpdate $trackingUpdate): RedirectResponse
    {
        $validated = $request->validate([
            'parcel_id' => 'required|exists:parcels,id',
            'location' => 'nullable|string|max:255',
        ]);

        $parcel = Parcel::findOrFail($validated['parcel_id']);

        $trackingUpdate->update([
            'status' => $parcel->status,
            'location' => $validated['location'],
            'description' => $parcel->description,
            'tracking_number' => $parcel->tracking_number,
        ]);

        return redirect()->route('api.tracking-updates.index')
            ->with('success', 'Tracking update updated successfully.');
    }

    public function destroy(TrackingUpdate $trackingUpdate): RedirectResponse
    {
        $trackingUpdate->delete();

        return redirect()->route('api.tracking-updates.index')
            ->with('success', 'Tracking update deleted successfully.');
    }
}