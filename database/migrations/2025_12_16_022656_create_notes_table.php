<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            // Kolom dari Note Anda
            $table->string('judul_note');
            $table->text('isi'); // Menggunakan text untuk field isi yang lebih panjang
            $table->boolean('lokasi')->default(false); // Default false, sesuai Toggle
            
            // Timestamps
            $table->timestamps(); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};