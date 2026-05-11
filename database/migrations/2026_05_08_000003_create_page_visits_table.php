<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('page_visits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('count')->default(0); // jumlah kunjungan halaman
            $table->timestamps();
        });

        // Insert baris awal dengan count = 0
        DB::table('page_visits')->insert(['count' => 0]);
    }

    public function down(): void
    {
        Schema::dropIfExists('page_visits');
    }
};
