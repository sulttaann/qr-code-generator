<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('qr_code_generators', function (Blueprint $table) {
            $table->id();
            $table->string('qr_type');    // jenis QR: url, whatsapp, wifi, dll
            $table->text('qr_content');   // konten yang di-encode ke QR
            $table->string('qr_image')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('qr_code_generators');
    }
};
