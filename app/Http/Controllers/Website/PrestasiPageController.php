<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Prestasi;
use Illuminate\View\View;

class PrestasiPageController extends Controller
{
    public function akademik(): View
    {
        return $this->tampilkan(
            'akademik',
            'website.prestasi.akademik'
        );
    }

    public function olahraga(): View
    {
        return $this->tampilkan(
            'olahraga',
            'website.prestasi.olahraga'
        );
    }

    public function keislaman(): View
    {
        return $this->tampilkan(
            'keislaman',
            'website.prestasi.keislaman'
        );
    }

    public function seni(): View
    {
        return $this->tampilkan(
            'seni',
            'website.prestasi.seni'
        );
    }

    private function tampilkan(
        string $kategori,
        string $view
    ): View {
        $prestasi = Prestasi::query()
            ->where('kategori', $kategori)
            ->where('aktif', true)
            ->orderBy('urutan')
            ->orderByDesc('tanggal')
            ->orderByDesc('id')
            ->get();

        return view(
            $view,
            compact('prestasi')
        );
    }
}