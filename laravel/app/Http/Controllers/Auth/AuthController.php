<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'message' => 'registered successfully.',
            'user' => $user,
            'token' => $user->createToken('register')->plainTextToken
        ], 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized.'], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('login')->plainTextToken;

        return response()->json(['message' => 'login was successful.', 'token' => $token], 200);
    }

    public function user(Request $request)
    {
        if(!response()->json($request->user())){
            return response()->json(['message' => 'Unauthorized.'], 401);
        }

        return response()->json(['message' => 'Access successful.', 'user' => $request->user()], 200);
    }
}
