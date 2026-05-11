<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payment_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();       // identifikasi unik untuk URL kartu
            $table->string('platform');             // DANA, GoPay, OVO, BCA, dll
            $table->string('nomor');                // nomor HP atau rekening
            $table->string('nama');                 // nama pemilik akun
            $table->integer('nominal')->nullable(); // nominal pembayaran (opsional)
            $table->string('qr_image');             // path gambar QR yang diupload
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_profiles');
    }
};
