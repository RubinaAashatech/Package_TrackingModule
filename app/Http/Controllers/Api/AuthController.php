<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Customer;
class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validate request data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('YourAppName')->plainTextToken;
            return response()->json(['token' => $token]);
        }
    
        return response()->json(['error' => 'Unauthorized'], 401);
    }
    
    public function customer(Request $request)
    {
        // Validate request data
        $request->validate([
            'fullname' => 'required|string|max:255',
            'phone_no' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'email' => 'nullable|email|unique:customers,email',
        ]);
        $credentials = $request->only('fullname', 'phone_no', 'address','email');
        if (Auth::attempt($credentials)) {
            $customer = Auth::user();
            $token = $customer->createToken('AppName')->plainTextToken;
            return response()->json(['token' => $token]);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }
}





