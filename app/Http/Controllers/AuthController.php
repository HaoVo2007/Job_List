<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
     
        $user = User::where('email', $request->email)->first();
     
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'message' => 'Login successfully!',
            'status' => 'success',
            'token' => $token,
        ]);
    }

    public function register(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'name' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if($user) {
            return response([
                'status' => 'error',
                'message' => 'Email exist',
            ]);
        }

        User::create([
            'name' => $request->name, 
            'email' => $request->email, 
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Register successfully',
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out successfully',
            'status' => 'success'
        ], 200);
    }

    public function getUser(Request $request) {

        $user = $request->user();

        if($user->employer != null) {
            $message = 'employer';
        } else {
            $message = 'user';
        }

        return response([
            'status' => 'success',
            'data' => $user,
            'message' => $message,
        ]);
    }
}
  