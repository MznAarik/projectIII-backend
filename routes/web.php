<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

ROute::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:user'])->prefix('api/user/')->group(function () {
    Route::get('dashboard', [UserController::class, 'index'])->name('user.dashboard');
});

Route::middleware(['auth', 'role:admin'])->prefix('api/admin/')->group(function () {
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashbaord');
});
