<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Beranda extends Model
{
    protected $table = 'beranda';

    protected $fillable = [
        'hero_background',
        'hero_image',
        'hero_judul',
        'hero_nama_sekolah',
        'hero_tagline',

        'visi_image',
        'visi_caption',
        'visi_tagline',
        'visi',
        'misi',

        'kepsek_foto',
        'kepsek_nama',
        'kepsek_jabatan',
        'kepsek_pembuka',
        'kepsek_sambutan',
        'kepsek_penutup',

        'video_judul',
        'video_deskripsi',
        'video_url',
    ];
}