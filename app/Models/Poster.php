<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poster extends Model
{
    use HasFactory;

    protected $table = 'posters';

    protected $fillable = [
        'judul_poster',
        'path_poster', // Wajib diisi agar Filament bisa menyimpannya
        'is_active',
    ];
}