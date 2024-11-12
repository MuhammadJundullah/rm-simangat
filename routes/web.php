<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;


Route::middleware('auth')->group(function () {
    Route::get('/', [MenuController::class, 'redirect']);
    Route::get('/menu', [MenuController::class, 'getMenu'])->name('dashboard');
    Route::get('/pesanan', [OrderController::class, 'getPesanan'])->name('pesanan');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/checkout', [OrderController::class, 'store'])->name('checkout');
    Route::post('/pesanan/batalkan', [OrderController::class, 'batalkanPesanan'])->name('pesanan.batalkan');
    Route::get('/pesanan/rincian', [OrderController::class, 'rincianPesanan'])->name('rincian');
});





require __DIR__.'/auth.php';
