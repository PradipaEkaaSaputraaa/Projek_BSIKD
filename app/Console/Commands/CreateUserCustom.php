<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User; // Penting untuk import Model User
use Illuminate\Support\Facades\Hash; // Penting untuk enkripsi password

class CreateUserCustom extends Command
{
    // Bagian ini yang tadi merah, pastikan ada di DALAM kurung kurawal class
    protected $signature = 'buat:user';

    protected $description = 'Membuat user baru dengan role spesifik untuk perusahaan';

    public function handle()
    {
        $name = $this->ask('Nama?');
        $email = $this->ask('Email?');
        
        // Cek apakah email sudah ada
        if (User::where('email', $email)->exists()) {
            $this->error('Email sudah terdaftar!');
            return;
        }

        $password = $this->secret('Password?');
        $role = $this->choice('Role?', ['admin', 'user'], 1);

        User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'role' => $role,
        ]);

        $this->info("Berhasil! User $name dibuat sebagai $role.");
    }
}