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
                'token_expires_at' => now()->addHours(24),
            ]);

            $verificationUrl = url('/api/verify-email?token=' . $token);

            $data = [
                'name' => $user->name,
                'email' => $user->email,
                'verificationUrl' => $verificationUrl,
            ];

            Mail::to($user->email)->send(new EmailVerification($data));
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
            return response()->json([
                'status' => 0,
                'message' => 'Invalid verification token.',
            ], 400);
        }

        $user = User::where('email_verification_token', $token)->first();

        if (!$user) {
            return response()->json([
                'status' => 0,
<<<<<<< HEAD
                'message' => 'Invalid verification token.',
            ], 400);
=======
                'message' => 'No user found! Please signup again',
            ], 404);
>>>>>>> ba298730d8d5e47f9c5b93e075ea23c5dbb418aa
        }

        // Check if the token has expired
        if (Carbon::now()->gt($user->token_expires_at)) {
            return response()->json([
                'status' => 0,
                'message' => 'Verification token has expired.',
            ], 400);
        }

        // Update user as verified
        $user->is_verified = true;
        $user->email_verified_at = now();
        $user->email_verification_token = null;
        $user->token_expires_at = null;
        $user->save();

        return response()->json([
            'status' => 1,
            'message' => 'Your email has been successfully verified.',
        ]);
    }
}