<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Ppdb;

class PpdbController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | Ambil PPDB yang aktif
        |--------------------------------------------------------------------------
        */

        $ppdb = Ppdb::query()
            ->where('aktif', true)
            ->latest('id')
            ->first();


        /*
        |--------------------------------------------------------------------------
        | Jika belum ada yang aktif, gunakan data terbaru
        |--------------------------------------------------------------------------
        */

        if (!$ppdb) {
            $ppdb = Ppdb::query()
                ->latest('id')
                ->first();
        }


        return view(
            'website.layanan.ppdb',
            compact('ppdb')
        );
    }
}