<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;


class ForgotPasswordController extends Controller
{
    public function sendCode(Request $request)
    {

    
        $request->validate([
            'email' => 'required|email'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Email not found'
            ], 404);
        }

        $otp = rand(100000, 999999);

        $user->otp = $otp;
$user->otp_expires_at = now()->addMinutes(10);
$user->save();

        Mail::raw("Your verification code is: $otp", function ($message) use ($user) {
    $message->to($user->email)
            ->subject('Career Compass Verification Code');
});

   





return response()->json([
    'status' => true,
    'message' => 'Verification code sent successfully'
]);

    }







public function verifyOtp(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'otp' => 'required'
    ]);

    $user = User::where('email', $request->email)
            ->where('otp', $request->otp)
            ->where('otp_expires_at', '>', now())
            ->first();

    if (!$user) {
       $user = User::where('email', $request->email)
            ->where('otp', $request->otp)
            ->where('otp_expires_at', '>', now())
            ->first();
    }

    return response()->json([
        'status' => true,
        'message' => 'OTP verified successfully'
    ]);
}

















public function resetPassword(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'otp' => 'required',
        'password' => 'required|min:8|confirmed',
    ]);

    $user = User::where('email', $request->email)
                ->where('otp', $request->otp)
                ->first();

    if (!$user) {
        return response()->json([
            'status' => false,
            'message' => 'Invalid verification code'
        ], 400);
    }
$user->password = Hash::make($request->password);
$user->otp = null;
$user->otp_expires_at = null;
$user->save();

    return response()->json([
        'status' => true,
        'message' => 'Password reset successfully'
    ]);
}





















}