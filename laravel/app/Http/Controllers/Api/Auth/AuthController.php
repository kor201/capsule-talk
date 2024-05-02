<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\Entities\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\CarbonImmutable;
use App\Http\Controllers\Controller;

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
        $tokenResult = $user->createToken('login');
        $tokenModel = $tokenResult->accessToken;
        $tokenModel->expires_at = CarbonImmutable::now()->addMonths(1);
        $tokenModel->save();

        return response()->json(['message' => 'login was successful.', 'access_token' => $tokenResult->plainTextToken,], 200);
    }
}
