<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('runningtexts', function (Blueprint $table) {
            $table->id();
            $table->text('isitext'); // Menggunakan 'text' untuk teks panjang
            $table->timestamps(); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('runningtexts');
    }
};

