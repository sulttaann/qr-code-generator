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
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('slug')->unique();        // URL unik: /pay/slug
            $table->string('platform');              // DANA, GoPay, OVO, dll
            $table->string('nomor');                 // nomor HP / rekening
            $table->string('nama');                  // nama pemilik
            $table->integer('nominal')->nullable();  // nominal (opsional)
            $table->string('qr_image');              // path gambar QR upload
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_profiles');
    }
};
