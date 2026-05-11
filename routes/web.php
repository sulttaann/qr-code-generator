<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QrCodeGeneratorController;
use App\Http\Controllers\PaymentProfileController;

// Halaman publik profil payment — tidak perlu login
// Route::get('/pay/{slug}', [PaymentProfileController::class, 'show'])->name('payment.show');

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

    Route::get('/qrcodes', [QrCodeGeneratorController::class, 'index'])->name('qr_codes.index');
    Route::get('/qrcodes/create', [QrCodeGeneratorController::class, 'create'])->name('qr_codes.create');
    Route::post('/qrcodes', [QrCodeGeneratorController::class, 'store'])->name('qr_codes.store');
    Route::get('/qrcodes/{id}', [QrCodeGeneratorController::class, 'show'])->name('qr_codes.show');
    Route::delete('/qrcodes/{id}', [QrCodeGeneratorController::class, 'destroy'])->name('qr_codes.destroy');

    // Payment profile
    Route::post('/payment-profile', [PaymentProfileController::class, 'store'])->name('payment.store');
});

require __DIR__.'/auth.php';
