<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserValidate;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Auth\Events\Registered;

class AuthController extends Controller
{
    public function register(UserValidate $request)
    {
        DB::beginTransaction();

        try {
            $role = $request->role;

            // Only allow admins to create admin accounts
            if ($role === 'admin' && (!Auth::check() || Auth::user()->role !== 'admin')) {
                return redirect()->route('login')->with([
                    'status' => 0,
                    'message' => 'Only admins can create admin accounts.',
                    'error' => 'Unauthorized role assignment',
                ]);
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'gender' => $request->gender,
                'phoneno' => $request->phoneno,
                'address' => $request->address,
                'role' => $role,
            ]);

            event(new Registered($user));
            Log::info('Verification email sent to: ' . $user->email);

            DB::commit();

            return redirect()->route('login')->with([
                'status' => 1,
                'message' => 'Registration successful. Please verify your email.',
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Registration failed: ' . $e->getMessage());

            return redirect()->route('login')->with([
                'status' => 0,
                'message' => 'Registration failed. Please try again.',
                'error' => $e->getMessage(),
            ]);
        }
    }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if (!$user->hasVerifiedEmail()) {
                Auth::logout();
                return redirect()->route('login')->with(['message' => 'Please verify your email first.']);
            }

            $request->session()->regenerate();

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard')->with('message', 'Welcome ' . $user->name . '!');
            } elseif ($user->role === 'user') {
                return redirect()->route('user.dashboard')->with('message', 'Welcome ' . $user->name . '!');
            } else {
                return redirect()->route('login.submit');
            }
        }

        return redirect()->route('login')->with(['message' => 'Invalid credentials']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('message', 'Logged out successfully');
    }
}
