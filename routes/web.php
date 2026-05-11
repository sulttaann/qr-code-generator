<?php

use App\Http\Controllers\QrCodeGeneratorController;
use App\Http\Controllers\PaymentProfileController;
use Illuminate\Support\Facades\Route;

// Satu halaman utama — form + hasil QR
Route::get('/',        [QrCodeGeneratorController::class, 'index'])->name('home');
Route::post('/generate', [QrCodeGeneratorController::class, 'generate'])->name('qr.generate');

// Payment — halaman terpisah karena butuh upload file
Route::post('/payment', [PaymentProfileController::class, 'store'])->name('payment.store');
Route::get('/payment/{slug}', [PaymentProfileController::class, 'card'])->name('payment.card');
