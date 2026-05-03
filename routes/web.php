<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransaksiController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth','role:admin'])->group(function () {
    Route::resource('transaksi', TransaksiController::class);
});

Route::middleware(['auth','role:user'])->group(function () {
    Route::get('/transaksi', [TransaksiController::class, 'index']);
});

Route::resource('transaksi', TransaksiController::class)->middleware('auth');

Route::get('/transaksi', function () {
    return view('transaksi.index');
})->middleware(['auth'])->name('transaksi.index');
require __DIR__.'/auth.php';
