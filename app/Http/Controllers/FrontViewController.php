<?php

namespace App\Http\Controllers;

use App\Models\Parcel;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FrontViewController extends Controller
{
    public function index(): View
    {
        return view('index');
    }

    public function track(Request $request)
{
    $request->validate([
        'tracking_number' => 'required|string',
    ]);

    $parcel = Parcel::with('latestTrackingUpdate')
        ->where('tracking_number', $request->tracking_number)
        ->first();

    if (!$parcel) {
        return response()->json(['error' => 'Parcel not found'], 404);
    }

    return response()->json([
        'parcel' => $parcel,
        'latest_update' => $parcel->latestTrackingUpdate,
    ]);
}
}