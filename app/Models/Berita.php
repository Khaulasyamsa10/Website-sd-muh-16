<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $table = 'beritas';

    protected $fillable = [
        'judul',
        'slug',
        'kategori',
        'ringkasan',
        'isi',
        'gambar',
        'tanggal',
        'penulis',
        'unggulan',
        'aktif',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'unggulan' => 'boolean',
        'aktif' => 'boolean',
    ];
}