<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TicketController;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/admin/dashboard', function (Request $request) {
        return response()->json(['message' => 'Admin Dashboard', 'user' => $request->user()]);
    })->middleware('role:admin');

    Route::get('/user/dashboard', function (Request $request) {
        return response()->json(['message' => 'User Dashboard', 'user' => $request->user()]);
    })->middleware('role:user');

    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});

Route::get('/email/verify/{id}/{hash}', function (Request $request, $id, $hash) {
    $user = User::findOrFail($id);
    if (!$user->hasVerifiedEmail()) {
        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }
    }

    return redirect()->route('login')->with('message', ' User verified sucessfully!');

})->middleware(['signed', 'throttle:6,1'])->name('verification.verify');

Route::get('/email/verify', function (Request $request) {
    if ($request->user() && !$request->user()->hasVerifiedEmail()) {
        $request->user()->sendEmailVerificationNotification();
        return response()->json(['message' => 'Verification link sent']);
    }
    return response()->json(['message' => 'Already verified or not logged in'], 400);
})->middleware('auth:sanctum')->name('verification.send');

Route::prefix('tickets/')->get('index', [TicketController::class, 'index']);
