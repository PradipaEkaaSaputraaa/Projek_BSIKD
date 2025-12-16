<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    //
    protected $fillable = [
        'tgl',
        'jam',
        'isi_agenda',
        // Tambahkan semua kolom yang boleh diisi dari request/form
    ];
}
