<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $fillable = [
        'judul',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'lokasi',
        'deskripsi',
        'gambar',
        'aktif',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'aktif' => 'boolean',
    ];
}