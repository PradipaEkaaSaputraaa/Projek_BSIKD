<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed', 
        ];
    }

    /**
     * Izin akses masuk ke sistem login Filament
     */
  public function canAccessPanel(\Filament\Panel $panel): bool
{
    if ($panel->getId() === 'dashboard') {
        // Hanya admin yang bisa melihat ISI panel dashboard
        // Tapi biarkan user login di sini (ini sudah kita atur di redirect)
        return true; 
    }

    if ($panel->getId() === 'user') {
        return $this->role === 'user';
    }

    return false;
}

    /**
     * Helper untuk menentukan arah redirect setelah login di /login
     */
    public function getRedirectRoute(): string
    {
        return match ($this->role) {
            'admin' => '/dashboard', // Sesuaikan dengan path di route:list kamu
            'user'  => '/app',
            default => '/login',
        };
    }
}