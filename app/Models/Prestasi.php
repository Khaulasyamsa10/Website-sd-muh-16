<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    protected $table = 'prestasi';

    protected $fillable = [
        'judul',
        'kategori',
        'nama_peserta',
        'kelas',
        'peringkat',
        'tingkat',
        'tanggal',
        'deskripsi',
        'gambar',
        'aktif',
        'urutan',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'aktif' => 'boolean',
        'urutan' => 'integer',
    ];
}