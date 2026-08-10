<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $cari = trim((string) $request->query('cari'));

        $beritaUtama = Berita::query()
            ->where('aktif', true)
            ->where('unggulan', true)
            ->latest('tanggal')
            ->latest('id')
            ->first();

        /*
         * Jika belum ada berita yang ditandai unggulan,
         * gunakan berita aktif terbaru.
         */
        if (!$beritaUtama) {
            $beritaUtama = Berita::query()
                ->where('aktif', true)
                ->latest('tanggal')
                ->latest('id')
                ->first();
        }

        $query = Berita::query()
            ->where('aktif', true)
            ->when($cari !== '', function ($query) use ($cari) {
                $query->where(function ($subQuery) use ($cari) {
                    $subQuery
                        ->where('judul', 'like', '%' . $cari . '%')
                        ->orWhere(
                            'kategori',
                            'like',
                            '%' . $cari . '%'
                        )
                        ->orWhere(
                            'ringkasan',
                            'like',
                            '%' . $cari . '%'
                        )
                        ->orWhere(
                            'isi',
                            'like',
                            '%' . $cari . '%'
                        );
                });
            });

        /*
         * Berita utama tidak ditampilkan dua kali
         * ketika pengguna tidak sedang mencari.
         */
        if ($cari === '' && $beritaUtama) {
            $query->where('id', '!=', $beritaUtama->id);
        }

        $beritaList = $query
            ->latest('tanggal')
            ->latest('id')
            ->paginate(6)
            ->withQueryString();

        return view('website.berita', compact(
            'beritaUtama',
            'beritaList',
            'cari'
        ));
    }

    public function show(Berita $berita)
    {
        abort_unless($berita->aktif, 404);

        $beritaLain = Berita::query()
            ->where('aktif', true)
            ->where('id', '!=', $berita->id)
            ->latest('tanggal')
            ->latest('id')
            ->limit(3)
            ->get();

        return view('website.berita-detail', compact(
            'berita',
            'beritaLain'
        ));
    }
}