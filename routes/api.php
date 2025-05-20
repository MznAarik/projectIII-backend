<?php

// routes/api.php
use App\Http\Controllers\AuthController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});

Route::get('/email/verify/{id}/{hash}', function (Request $request, $id, $hash) {
    $user = User::findOrFail($id);
    if (!$user->hasVerifiedEmail()) {
        if ($user->markEmailAsVerified()) {
            event(new \Illuminate\Auth\Events\Verified($user));
        }
    }
    return response()->json(['message' => 'Email verified successfully']);
})->middleware(['signed', 'throttle:6,1'])->name('verification.verify');

Route::get('/email/verify', function (Request $request) {
    if ($request->user() && !$request->user()->hasVerifiedEmail()) {
        $request->user()->sendEmailVerificationNotification();
        return response()->json(['message' => 'Verification link sent']);
    }
    return response()->json(['message' => 'Already verified or not logged in'], 400);
})->middleware('auth:sanctum')->name('verification.send');