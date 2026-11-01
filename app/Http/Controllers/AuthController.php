<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'User registered successfully',
            'token' => $token,
            'user' => $user,
        ]);
    }


public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json([
            'status' => false,
            'message' => 'Invalid email or password'
        ], 401);
    }

    $token = $user->createToken('auth_token')->plainTextToken;

    return response()->json([
        'status' => true,
        'message' => 'Login successful',
        'token' => $token,
        'user' => $user,
    ]);
}

public function logout(Request $request)
{
    $token = $request->user()->currentAccessToken();

    if ($token) {
        $token->delete();
    }

    return response()->json([
        'status' => true,
        'message' => 'Logged out successfully'
    ]);
}



public function user(Request $request)
{
    return response()->json([
        'status' => true,
        'user' => $request->user()
    ]);
}

public function updateProfile(Request $request)
{
    $user = auth()->user();

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
    ]);

    $user->update([
        'name' => $request->name,
        'email' => $request->email,
    ]);

    return response()->json([
        'status' => true,
        'message' => 'Profile updated successfully',
        'data' => $user,
    ]);
}

public function changePassword(Request $request)
{
    $user = auth()->user();

    $request->validate([
        'current_password' => 'required',
        'password' => 'required|min:8|confirmed',
    ]);

    if (!Hash::check($request->current_password, $user->password)) {
        return response()->json([
            'status' => false,
            'message' => 'Current password is incorrect'
        ], 422);
    }

    $user->update([
        'password' => Hash::make($request->password)
    ]);

    return response()->json([
        'status' => true,
        'message' => 'Password changed successfully'
    ]);
}



public function googleLogin(Request $request)
{
    $request->validate([
        'access_token' => 'required|string',
    ]);

    $googleUser = Socialite::driver('google')
        ->stateless()
        ->userFromToken($request->access_token);

    $user = User::where('email', $googleUser->getEmail())->first();

    if (!$user) {
        $user = User::create([
            'name' => $googleUser->getName() ?? 'Google User',
            'email' => $googleUser->getEmail(),
            'password' => Hash::make(uniqid()),
        ]);
    }

    $token = $user->createToken('auth_token')->plainTextToken;

    return response()->json([
        'status' => true,
        'message' => 'Google login successful',
        'token' => $token,
        'user' => $user,
    ]);
}

public function appleLogin(Request $request)
{
    $request->validate([
        'identity_token' => 'required|string',
    ]);

    $appleUser = Socialite::driver('apple')
        ->stateless()
        ->userFromToken($request->identity_token);

    $user = User::where('email', $appleUser->getEmail())->first();

    if (!$user) {
        $user = User::create([
            'name' => $appleUser->getName() ?? 'Apple User',
            'email' => $appleUser->getEmail(),
            'password' => Hash::make(uniqid()),
        ]);
    }

    $token = $user->createToken('auth_token')->plainTextToken;

    return response()->json([
        'status' => true,
        'message' => 'Apple login successful',
        'token' => $token,
        'user' => $user,
    ]);
}



















}
