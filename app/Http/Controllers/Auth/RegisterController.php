<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserValidate;
use App\Mail\EmailVerification;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

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
                'password' => $request['password'],
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
    public function verify_email(Request $request)
    {

        $token = $request->query('token');
        if (!$token) {
            return response()->json([
                'status' => 0,
                'message' => 'Verification failed. No token provided!',
            ], 400);
        }
        $user = User::where('email_verification_token', $token)->first();
        $check_expiration = $user->value('token_expires_at');
        // dd($check_expiration);

        // lt less than gt greater than
        if ($check_expiration->lt(Carbon::now())) {
            return response()->json([
                'status' => 0,
                'message' => 'Verification token has expired.',
            ], 400);
        } else {

            $user->update([
                'email_verifivation' => now(),
                'email_verification_token' => null,
                'is_verified' => true,
            ]);
        }
    }
}