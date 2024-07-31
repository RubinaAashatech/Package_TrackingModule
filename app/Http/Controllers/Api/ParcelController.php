<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Parcel;
use App\Models\Receiver;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ParcelController extends Controller
{
/**
     * Display a listing of the parcels.
     *
     * @return JsonResponse|View
     */
    public function index(Request $request)
    {
        if ($request->expectsJson()) {
            $parcels = Parcel::all();
            return response()->json($parcels);
        }
        $parcels = Parcel::all();
        return view('admin.parcels.index', compact('parcels'));
    }

    /**
     * Show the form for creating a new parcel.
     *
     * @return View
     */
    public function create(Request $request)
    {
        $customers = Customer::all();
        $receivers = Receiver::all();
        
        $selectedCustomer = null;
        $selectedReceiver = null;
        $receiverCountry = '';
        $receiverState = '';
        $receiverCity = '';
        $receiverStreetAddress = '';
        $receiverPostalCode = '';
    
        if ($request->filled('customer_id')) {
            $selectedCustomer = Customer::find($request->input('customer_id'));
            // You can remove fetching customer address if it's no longer required
        }
    
        if ($request->filled('receiver_id')) {
            $selectedReceiver = Receiver::find($request->input('receiver_id'));
            if ($selectedReceiver) {
                $receiverCountry = $selectedReceiver->country;
                $receiverState = $selectedReceiver->state;
                $receiverCity = $selectedReceiver->city;
                $receiverStreetAddress = $selectedReceiver->street_address;
                $receiverPostalCode = $selectedReceiver->postal_code;
            }
        }
    
        return view('admin.parcels.create', compact(
            'customers', 
            'receivers', 
            'selectedCustomer', 
            'selectedReceiver', 
            'receiverCountry',
            'receiverState',
            'receiverCity',
            'receiverStreetAddress',
            'receiverPostalCode'
        ));
    }
    
    /**
     * Store a newly created parcel in storage.
     *
     * @param Request $request
     * @return JsonResponse|RedirectResponse
     */
    public function store(Request $request): JsonResponse|RedirectResponse
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'receiver_id' => 'required|exists:receivers,id',
            'carrier' => 'required|string|max:255',
            'sending_date' => 'required|date',
            'weight' => 'required|numeric',
            'status' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'estimated_delivery_date' => 'required|date',
        ]);

        $parcel = Parcel::create($validated);

        if ($request->expectsJson()) {
            return response()->json($parcel, 201); // 201 Created
        }
        return redirect()->route('api.parcels.index')->with('success', 'Parcel added successfully.');
    }
    /**
     * Display the specified parcel.
     *
     * @param Parcel $parcel
     * @param Request $request
     * @return JsonResponse|View
     */
    public function show(Parcel $parcel, Request $request): JsonResponse|View
    {
        if ($request->expectsJson()) {
            return response()->json($parcel);
        }

        return view('admin.parcels.show', compact('parcel'));
    }

    /**
     * Show the form for editing the specified parcel.
     *
     * @param Parcel $parcel
     * @return View
     */
    public function edit(Parcel $parcel): View
    {
        $customers = Customer::all();
        $receivers = Receiver::all();
        return view('admin.parcels.update', compact('parcel', 'customers', 'receivers'));
    }

    /**
     * Update the specified parcel in storage.
     *
     * @param Request $request
     * @param Parcel $parcel
     * @return JsonResponse|RedirectResponse
     */
    public function update(Request $request, Parcel $parcel): JsonResponse|RedirectResponse
    {
        $request->validate([
            'tracking_number' => 'required|string|unique:parcels,tracking_number,' . $parcel->id,
            'customer_id' => 'required|exists:customers,id',
            'receiver_id' => 'required|exists:receivers,id',
            'carrier' => 'required|string|max:255',
            'sending_date' => 'required|date',
            'weight' => 'required|numeric|min:0',
            'status' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'estimated_delivery_date' => 'required|date',
        ]);

        $parcel->update($request->all());

        if ($request->expectsJson()) {
            return response()->json($parcel);
        }

        return redirect()->route('api.parcels.index')->with('success', 'Parcel updated successfully.');
    }

    /**
     * Remove the specified parcel from storage.
     *
     * @param Parcel $parcel
     * @return JsonResponse|RedirectResponse
     */
    public function destroy(Parcel $parcel): JsonResponse|RedirectResponse
    {
        try {
            $parcel->delete();
            if (request()->expectsJson()) {
                return response()->json(null, 204); // 204 No Content
            }
            return redirect()->route('api.parcels.index')->with('success', 'Parcel deleted successfully.');
        } catch (\Exception $e) {
            if (request()->expectsJson()) {
                return response()->json(['error' => 'Failed to delete parcel.'], 500); // 500 Internal Server Error
            }
            return redirect()->route('api.parcels.index')->with('error', 'Failed to delete parcel.');
        }
    }
}

