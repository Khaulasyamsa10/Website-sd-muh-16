<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ppdb extends Model
{
    protected $table = 'ppdb';

    protected $fillable = [
        'judul',
        'tahun_ajaran',
        'jenjang',
        'status',
        'kuota',
        'link_pendaftaran',
        'brosur_gambar',
        'brosur_pdf',
        'aktif',
    ];

    protected $casts = [
        'kuota' => 'integer',
        'aktif' => 'boolean',
    ];
}