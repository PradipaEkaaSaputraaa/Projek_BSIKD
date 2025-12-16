<?php

// database/migrations/..._create_posters_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('posters', function (Blueprint $table) {
            $table->id();
            $table->string('judul_poster');
            $table->string('path_poster')->nullable(); // String untuk menyimpan path file
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posters');
    }
};
