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
Route::middleware('auth:sanctum')->post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return response()->json(['message' => 'Verification link sent!']);
})->name('verification.send');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return response()->json(['message' => 'Email verified successfully']);
})->middleware('signed')->name('verification.verify');

Route::middleware('auth:sanctum')->get('/email/verify', function (Request $request) {
    return response()->json([
        'verified' => $request->user()->hasVerifiedEmail(),
        'email' => $request->user()->email,
    ]);
})->name('verification.status');

Route::post('/register', [RegisterController::class, 'register'])->name('user.register');
Route::get('/verify-email', [RegisterController::class, 'verify_email']);
