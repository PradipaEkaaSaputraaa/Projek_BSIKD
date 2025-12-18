<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
   public function run(): void
{
    // Untuk Admin
    \App\Models\User::updateOrCreate(
        ['email' => 'admin@gmail.com'], // Cari berdasarkan email ini
        [
            'name' => 'admin',
            'password' => 'admin123',
            'role' => 'admin',
        ]
    );

    // Untuk User
    \App\Models\User::updateOrCreate(
        ['email' => 'user@gmail.com'], // Cari berdasarkan email ini
        [
            'name' => 'user',
            'password' => 'user123',
            'role' => 'user',
        ]
    );
}
}
