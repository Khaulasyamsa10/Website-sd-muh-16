<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Ekstrakurikuler;

class EkstrakurikulerPageController extends Controller
{
    public function index()
    {
        $wajib = Ekstrakurikuler::query()
            ->where('kategori', 'wajib')
            ->where('aktif', true)
            ->orderBy('urutan')
            ->get();

        $pilihan = Ekstrakurikuler::query()
            ->where('kategori', 'pilihan')
            ->where('aktif', true)
            ->orderBy('urutan')
            ->get();

        $bimpres = Ekstrakurikuler::query()
            ->where('kategori', 'bimpres')
            ->where('aktif', true)
            ->orderBy('urutan')
            ->get();

        return view(
            'website.ekstrakurikuler',
            compact(
                'wajib',
                'pilihan',
                'bimpres'
            )
        );
    }
}