<?php
namespace App\Http\Controllers;
use App\Models\Receiver;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ReceiverController extends Controller
{
    /**
     * Display a listing of the receivers.
     *
     * @return JsonResponse|View
     */
    public function index(Request $request)
    {
        if ($request->expectsJson()) {
            $receivers = Receiver::all();
            return response()->json($receivers);
        }
        $receivers = Receiver::all();
        return view('admin.receivers.index', compact('receivers'));
    }
    /**
     * Show the form for creating a new receivers.
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.receivers.create');
    }
    /**
     * Store a newly created customer in storage.
     *
     * @param Request $request
     * @return JsonResponse|RedirectResponse
     */
    public function store(Request $request): JsonResponse|RedirectResponse
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'phone_no' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'email' => 'nullable|email|unique:receivers,email',
        ]);
        $receiver = Receiver::create($request->all());
        if ($request->expectsJson()) {
            return response()->json($receiver, 201); // 201 Created
        }
        return redirect()->route('api.receivers.index')->with('success', 'Receiver added successfully.');
    }
    /**
     * Display the specified receivers.
     *
     * @param Receiver $receivers
     * @param Request $request
     * @return JsonResponse|View
     */
    public function show(Receiver $receiver, Request $request): JsonResponse|View
    {
        if ($request->expectsJson()) {
            return response()->json($receiver);
        }
        return view('admin.receivers.show', compact('receivers'));
    }
    /**
     * Show the form for editing the specified customer.
     *
     * @param Receiver $receivers
     * @return View
     */
    public function edit(Receiver $receiver): View
    {
        return view('admin.receivers.update', compact('receiver'));
    }
    /**
     * Update the specified customer in storage.
     *
     * @param Request $request
     * @param Receiver $receivers
     * @return JsonResponse|RedirectResponse
     */
    public function update(Request $request, Receiver $receiver): JsonResponse|RedirectResponse
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'phone_no' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'email' => 'nullable|email|unique:customers,email,' . $receiver->id,
        ]);
        $receiver->update($request->all());
        if ($request->expectsJson()) {
            return response()->json($receiver);
        }
        return redirect()->route('api.receivers.index')->with('success', 'Customer updated successfully.');
    }
    /**
     * Remove the specified receivers from storage.
     *
     * @param Receiver $receivers
     * @return JsonResponse
     */
    public function destroy(Receiver $receiver): RedirectResponse
    {
        try {
            $receiver->delete();
            return redirect()->route('api.receivers.index')->with('success', 'Receiver deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('api.receivers.index')->with('error', 'Failed to delete customer.');
        }
    }
}






