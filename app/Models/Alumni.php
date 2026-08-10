<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    protected $table = 'alumni';

    protected $fillable = [
        'nama_lengkap',
        'tahun_lulus',
        'jenis_kelamin',
        'no_hp',
        'email',
        'pendidikan_saat_ini',
        'pekerjaan',
        'alamat',
        'pesan_kesan',
        'status',
    ];

    protected $casts = [
        'tahun_lulus' => 'integer',
    ];
}