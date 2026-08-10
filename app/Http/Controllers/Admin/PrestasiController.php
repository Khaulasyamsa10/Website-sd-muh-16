<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prestasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class PrestasiController extends Controller
{
    /**
     * Menampilkan daftar prestasi.
     */
    public function index()
    {
        $prestasi = Prestasi::query()
            ->orderBy('kategori')
            ->orderBy('urutan')
            ->orderByDesc('tanggal')
            ->orderByDesc('id')
            ->get();

        return view('admin.prestasi.index', compact('prestasi'));
    }

    /**
     * Menampilkan form tambah prestasi.
     */
    public function create()
    {
        return view('admin.prestasi.create');
    }

    /**
     * Menyimpan prestasi baru.
     */
    public function store(Request $request)
    {
        $data = $this->validasiPrestasi($request);

        $data['aktif'] = $request->boolean('aktif');
        $data['urutan'] = $data['urutan'] ?? 0;

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request
                ->file('gambar')
                ->store('prestasi', 'public');
        }

        Prestasi::create($data);

        return redirect()
            ->route('admin.prestasi.index')
            ->with('success', 'Prestasi berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit.
     */
    public function edit(Prestasi $prestasi)
    {
        return view(
            'admin.prestasi.edit',
            compact('prestasi')
        );
    }

    /**
     * Memperbarui data prestasi.
     */
    public function update(
        Request $request,
        Prestasi $prestasi
    ) {
        $data = $this->validasiPrestasi($request);

        $data['aktif'] = $request->boolean('aktif');
        $data['urutan'] = $data['urutan'] ?? 0;

        if ($request->hasFile('gambar')) {
            if (
                $prestasi->gambar &&
                Storage::disk('public')->exists($prestasi->gambar)
            ) {
                Storage::disk('public')->delete(
                    $prestasi->gambar
                );
            }

            $data['gambar'] = $request
                ->file('gambar')
                ->store('prestasi', 'public');
        } else {
            unset($data['gambar']);
        }

        $prestasi->update($data);

        return redirect()
            ->route('admin.prestasi.index')
            ->with('success', 'Prestasi berhasil diperbarui.');
    }

    /**
     * Menghapus data prestasi.
     */
    public function destroy(Prestasi $prestasi)
    {
        if (
            $prestasi->gambar &&
            Storage::disk('public')->exists($prestasi->gambar)
        ) {
            Storage::disk('public')->delete(
                $prestasi->gambar
            );
        }

        $prestasi->delete();

        return redirect()
            ->route('admin.prestasi.index')
            ->with('success', 'Prestasi berhasil dihapus.');
    }

    /**
     * Validasi form tambah dan edit prestasi.
     */
    private function validasiPrestasi(Request $request): array
    {
        return $request->validate([
            'judul' => [
                'required',
                'string',
                'max:255',
            ],

            'kategori' => [
                'required',
                Rule::in([
                    'akademik',
                    'olahraga',
                    'keislaman',
                    'seni',
                ]),
            ],

            'nama_peserta' => [
                'nullable',
                'string',
                'max:255',
            ],

            'kelas' => [
                'nullable',
                'string',
                'max:100',
            ],

            'peringkat' => [
                'nullable',
                'string',
                'max:100',
            ],

            'tingkat' => [
                'nullable',
                'string',
                'max:100',
            ],

            'tanggal' => [
                'nullable',
                'date',
            ],

            'deskripsi' => [
                'nullable',
                'string',
            ],

            'gambar' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:4096',
            ],

            'urutan' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'aktif' => [
                'nullable',
                'boolean',
            ],
        ]);
    }
}