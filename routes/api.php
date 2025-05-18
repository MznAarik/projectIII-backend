<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return view('login');
// })->middleware('auth:sanctum');

Route::get('/test', function () {
    return response()->json([
        'status' => 1,
        'message' => 'Test API Working!',
        'timestamp' => now(),
    ]);
});

Route::post('/register', [RegisterController::class, 'register'])->name('user.register');
Route::get('/verify-email', [RegisterController::class, 'verifyEmail'])->name('verify.email');
