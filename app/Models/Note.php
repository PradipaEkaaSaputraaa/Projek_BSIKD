<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    // Tentukan nama tabel secara eksplisit (opsional jika nama model sama dengan singular tabel)
    protected $table = 'notes'; 
    
    // Tentukan field yang boleh diisi melalui form (Mass Assignment)
    protected $fillable = [
        'judul_note',
        'isi',
        'lokasi',
    ];

    // Konversi field lokasi (boolean) secara otomatis
    protected $casts = [
        'lokasi' => 'boolean',
    ];
}