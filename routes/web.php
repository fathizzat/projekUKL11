

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

// Transaksi view & store - semua role
Route::middleware(['auth', 'role:super_admin,bendahara,anggota'])->group(function () {
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::post('/transaksi', [TransaksiController::class, 'store'])->name('transaksi.store');
});

// Transaksi CRUD & Konfirmasi — super_admin & bendahara
Route::middleware(['auth', 'role:super_admin,bendahara'])->group(function () {
    Route::resource('transaksi', TransaksiController::class)->except(['index', 'store']);
    Route::patch('/transaksi/{transaksi}/konfirmasi', [TransaksiController::class, 'konfirmasi'])->name('transaksi.konfirmasi');
});



require __DIR__.'/auth.php';