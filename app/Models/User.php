<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role', 
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Pastikan password di-handle dengan benar oleh Laravel 11
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed', // Ini sangat penting!
        ];
    }

    /**
     * Izin akses masuk ke sistem login Filament
     */
    public function canAccessPanel(\Filament\Panel $panel): bool
{
    // Jika mencoba masuk ke panel Admin
    if ($panel->getId() === 'admin') {
        return $this->role === 'admin';
    }

    // Jika mencoba masuk ke panel User (Pastikan ID-nya 'user')
    if ($panel->getId() === 'user') {
        return $this->role === 'user';
    }

    return false;
}
}