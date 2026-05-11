<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('page_visits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('count')->default(0);
            $table->timestamps();
        });

        // Insert baris awal
        DB::table('page_visits')->insert(['count' => 0]);
    }

    public function down(): void
    {
        Schema::dropIfExists('page_visits');
    }
};
