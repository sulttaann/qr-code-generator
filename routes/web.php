<?php

use App\Http\Controllers\QrCodeGeneratorController;
use App\Http\Controllers\PaymentProfileController;
use Illuminate\Support\Facades\Route;

// Halaman utama langsung ke form buat QR
Route::get('/', [QrCodeGeneratorController::class, 'create'])->name('home');

// QR Code
Route::get('/qrcodes',        [QrCodeGeneratorController::class, 'index'])->name('qr_codes.index');
Route::get('/qrcodes/create', [QrCodeGeneratorController::class, 'create'])->name('qr_codes.create');
Route::post('/qrcodes',       [QrCodeGeneratorController::class, 'store'])->name('qr_codes.store');
Route::get('/qrcodes/{id}',   [QrCodeGeneratorController::class, 'show'])->name('qr_codes.show');
Route::delete('/qrcodes/{id}',[QrCodeGeneratorController::class, 'destroy'])->name('qr_codes.destroy');

// Payment
Route::post('/payment-profile', [PaymentProfileController::class, 'store'])->name('payment.store');
