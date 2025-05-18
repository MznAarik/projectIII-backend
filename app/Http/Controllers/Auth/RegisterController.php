<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserValidate;
use App\Mail\EmailVerification;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function register(UserValidate $request)
    {
        DB::beginTransaction();

        try {
            $token = Str::random(32);
            $user = User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'gender' => $request['gender'],
                'phoneno' => $request['phoneno'],
                'address' => $request['address'],
                'email_verification_token' => $token,
                'token_expires_at' => Carbon::now()->addHours(24),
            ]);

            $verificationUrl = url('/api/verify-email?token=' . $token);

            Mail::to($user->email)->send(new EmailVerification([
                'name' => $user->name,
                'email' => $user->email,
                'verificationUrl' => $verificationUrl,
            ]));

            Log::info('Verification email sent to: ' . $user->email);

            DB::commit();

            return response()->json([
                'status' => 1,
                'message' => 'Registration successful. Please verify your email.',
                'user' => $user,
            ], 201);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Registration failed: ' . $e->getMessage());

            return response()->json([
                'status' => 0,
                'message' => 'Registration failed. Please try again.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function verifyEmail(Request $request)
    {
        $token = $request->query('token');

        if (!$token) {
            return response()->json(['status' => 0, 'message' => 'Invalid verification token.'], 400);
        }

        $user = User::where('email_verification_token', $token)->first();

        if (!$user) {
            return response()->json(['status' => 0, 'message' => 'No user found! Please sign up again.'], 404);
        }

        if (Carbon::now()->gt($user->token_expires_at)) {
            return response()->json(['status' => 0, 'message' => 'Verification token has expired.'], 400);
        }

        $user->update([
            'is_verified' => true,
            'email_verified_at' => Carbon::now(),
            'email_verification_token' => null,
            'token_expires_at' => null
        ]);

        return response()->json(['status' => 1, 'message' => 'Your email has been successfully verified.']);
    }
}
