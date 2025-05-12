<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return view('login');
})->middleware('auth:sanctum');

Route::get('/test', function () {
    return response()->json([
        'status' => '1',
        'message' => 'API is working',
        'timestamp' => now(),
    ]);
});
