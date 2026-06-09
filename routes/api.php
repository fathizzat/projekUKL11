<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\TransaksiController;
use Illuminate\Support\Facades\Route;

// Public API
Route::post('/login', [AuthController::class, 'login']);

// Protected API (Sanctum)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::apiResource('users', UserController::class);
    Route::apiResource('transaksi', TransaksiController::class);
});

Route::post('/login', [AuthController::class, 'login']);

Route::get('/tes-api', function () {
    return response()->json([
        'status' => 'API BERJALAN',
    ]);
});