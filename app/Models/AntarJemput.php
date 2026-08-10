<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AntarJemput extends Model
{
    protected $table = 'antar_jemputs';

    protected $fillable = [
        'pamflet_gambar',
        'batas_pendaftaran',
    ];

    protected $casts = [
        'batas_pendaftaran' => 'date',
    ];
}