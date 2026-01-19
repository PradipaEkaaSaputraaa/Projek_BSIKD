<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('posters', function (Blueprint $table) { $table->boolean('is_active')->default(true); });
    Schema::table('agendas', function (Blueprint $table) { $table->boolean('is_active')->default(true); });
    Schema::table('notes', function (Blueprint $table) { $table->boolean('is_active')->default(true); });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('signage_tables', function (Blueprint $table) {
            //
        });
    }
};
