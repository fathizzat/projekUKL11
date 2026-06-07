<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Dashboard — semua role bisa akses (auth required)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// Profile routes (Breeze default)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// User CRUD — super_admin only
Route::middleware(['auth', 'role:super_admin'])->group(function () {
    Route::resource('user', UserController::class);
});

// Transaksi CRUD — super_admin & bendahara
Route::middleware(['auth', 'role:super_admin,bendahara'])->group(function () {
    Route::resource('transaksi', TransaksiController::class);
});

require __DIR__.'/auth.php';