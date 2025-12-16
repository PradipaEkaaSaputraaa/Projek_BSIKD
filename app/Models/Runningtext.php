<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Runningtext extends Model
{
    use HasFactory;

    // Secara eksplisit mendefinisikan nama tabel (opsional, tapi disarankan)
    protected $table = 'runningtexts'; 
    
    /**
     * The attributes that are mass assignable.
     * Field yang diizinkan untuk diisi melalui form.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'isitext',
    ];

    /**
     * The attributes that should be cast to native types.
     * Karena semua kolom adalah string/text, kita tidak perlu casting khusus, 
     * kecuali jika Anda ingin memastikan 'isitext' selalu berupa string.
     *
     * @var array<string, string>
     */
    // protected $casts = [
    //     'created_at' => 'datetime',
    //     'updated_at' => 'datetime',
    // ];
}