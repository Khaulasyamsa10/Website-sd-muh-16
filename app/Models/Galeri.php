<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    protected $table = 'galeris';

    protected $fillable = [
        'judul',
        'tipe',
        'deskripsi',
        'gambar',
        'video_url',
        'video_file',
        'aktif',
        'urutan',
    ];

    protected $casts = [
        'aktif' => 'boolean',
        'urutan' => 'integer',
    ];
}