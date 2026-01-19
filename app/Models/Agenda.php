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
        'is_active',
    ];
}
