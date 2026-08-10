<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ekstrakurikuler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EkstrakurikulerController extends Controller
{
    public function index()
    {
        $daftarEkstrakurikuler = Ekstrakurikuler::query()
            ->orderBy('kategori')
            ->orderBy('urutan')
            ->orderBy('nama')
            ->get();

        return view(
            'admin.ekstrakurikuler.index',
            compact('daftarEkstrakurikuler')
        );
    }


    public function create()
    {
        return view(
            'admin.ekstrakurikuler.create',
            [
                'ekstrakurikuler' => new Ekstrakurikuler(),
            ]
        );
    }


    public function store(Request $request)
    {
        $data = $this->validateData($request);

        $data['aktif'] = $request->boolean('aktif');

        if ($request->hasFile('gambar')) {

            $data['gambar'] = $request
                ->file('gambar')
                ->store(
                    'ekstrakurikuler',
                    'public'
                );
        }

        Ekstrakurikuler::create($data);

        return redirect()
            ->route('admin.ekstrakurikuler.index')
            ->with(
                'success',
                'Data ekstrakurikuler berhasil ditambahkan.'
            );
    }


    public function edit(
        Ekstrakurikuler $ekstrakurikuler
    ) {
        return view(
            'admin.ekstrakurikuler.edit',
            compact('ekstrakurikuler')
        );
    }


    public function update(
        Request $request,
        Ekstrakurikuler $ekstrakurikuler
    ) {
        $data = $this->validateData($request);

        $data['aktif'] = $request->boolean('aktif');

        if ($request->hasFile('gambar')) {

            if (
                $ekstrakurikuler->gambar &&
                Storage::disk('public')->exists(
                    $ekstrakurikuler->gambar
                )
            ) {
                Storage::disk('public')->delete(
                    $ekstrakurikuler->gambar
                );
            }

            $data['gambar'] = $request
                ->file('gambar')
                ->store(
                    'ekstrakurikuler',
                    'public'
                );
        }

        $ekstrakurikuler->update($data);

        return redirect()
            ->route('admin.ekstrakurikuler.index')
            ->with(
                'success',
                'Data ekstrakurikuler berhasil diperbarui.'
            );
    }


    public function destroy(
        Ekstrakurikuler $ekstrakurikuler
    ) {
        if (
            $ekstrakurikuler->gambar &&
            Storage::disk('public')->exists(
                $ekstrakurikuler->gambar
            )
        ) {
            Storage::disk('public')->delete(
                $ekstrakurikuler->gambar
            );
        }

        $ekstrakurikuler->delete();

        return redirect()
            ->route('admin.ekstrakurikuler.index')
            ->with(
                'success',
                'Data ekstrakurikuler berhasil dihapus.'
            );
    }


    private function validateData(
        Request $request
    ): array {
        return $request->validate([
            'nama' => [
                'required',
                'string',
                'max:255',
            ],

            'kategori' => [
                'required',
                'in:wajib,pilihan,bimpres',
            ],

            'kelas' => [
                'nullable',
                'string',
                'max:100',
            ],

            'jadwal' => [
                'nullable',
                'string',
                'max:255',
            ],

            'keterangan' => [
                'nullable',
                'string',
            ],

            'gambar' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

            'aktif' => [
                'nullable',
                'boolean',
            ],

            'urutan' => [
                'nullable',
                'integer',
                'min:0',
            ],
        ], [
            'nama.required' =>
                'Nama ekstrakurikuler wajib diisi.',

            'kategori.required' =>
                'Kategori ekstrakurikuler wajib dipilih.',

            'kategori.in' =>
                'Kategori ekstrakurikuler tidak valid.',

            'gambar.image' =>
                'File yang diunggah harus berupa gambar.',

            'gambar.max' =>
                'Ukuran gambar maksimal 5 MB.',
        ]);
    }
}