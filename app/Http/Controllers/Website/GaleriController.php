<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Galeri;

class GaleriController extends Controller
{
    public function foto()
    {
        $foto = Galeri::query()
            ->where('tipe', 'foto')
            ->where('aktif', true)
            ->orderBy('urutan')
            ->orderByDesc('id')
            ->get();

        return view(
            'website.galeri.foto',
            compact('foto')
        );
    }


    public function video()
    {
        $video = Galeri::query()
            ->where('tipe', 'video')
            ->where('aktif', true)
            ->orderBy('urutan')
            ->orderByDesc('id')
            ->get();

        return view(
            'website.galeri.video',
            compact('video')
        );
    }
}