<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    public function index()
    {
        $daftarGaleri = Galeri::query()
            ->orderBy('tipe')
            ->orderBy('urutan')
            ->latest('id')
            ->get();

        return view(
            'admin.galeri.index',
            compact('daftarGaleri')
        );
    }


    public function create()
    {
        return view(
            'admin.galeri.create',
            [
                'galeri' => new Galeri(),
            ]
        );
    }


    public function store(Request $request)
    {
        $data = $this->validateData($request);

        $data['aktif'] = $request->boolean('aktif');

        /*
         * Jika tipe foto, gambar wajib ada.
         */
        if (
            $request->input('tipe') === 'foto' &&
            !$request->hasFile('gambar')
        ) {
            return back()
                ->withErrors([
                    'gambar' =>
                        'Gambar wajib diunggah untuk galeri foto.',
                ])
                ->withInput();
        }

        /*
         * Jika tipe video, URL video wajib ada.
         */
        if (
            $request->input('tipe') === 'video' &&
            !$request->filled('video_url')
        ) {
            return back()
                ->withErrors([
                    'video_url' =>
                        'Link video wajib diisi untuk galeri video.',
                ])
                ->withInput();
        }

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request
                ->file('gambar')
                ->store('galeri', 'public');
        }

        Galeri::create($data);

        return redirect()
            ->route('admin.galeri.index')
            ->with(
                'success',
                'Galeri berhasil ditambahkan.'
            );
    }


    public function edit(Galeri $galeri)
    {
        return view(
            'admin.galeri.edit',
            compact('galeri')
        );
    }


    public function update(
        Request $request,
        Galeri $galeri
    ) {
        $data = $this->validateData($request);

        $data['aktif'] = $request->boolean('aktif');

        if (
            $request->input('tipe') === 'foto' &&
            !$request->hasFile('gambar') &&
            !$galeri->gambar
        ) {
            return back()
                ->withErrors([
                    'gambar' =>
                        'Gambar wajib tersedia untuk galeri foto.',
                ])
                ->withInput();
        }

        if (
            $request->input('tipe') === 'video' &&
            !$request->filled('video_url')
        ) {
            return back()
                ->withErrors([
                    'video_url' =>
                        'Link video wajib diisi untuk galeri video.',
                ])
                ->withInput();
        }

        if ($request->hasFile('gambar')) {

            if (
                $galeri->gambar &&
                Storage::disk('public')
                    ->exists($galeri->gambar)
            ) {
                Storage::disk('public')
                    ->delete($galeri->gambar);
            }

            $data['gambar'] = $request
                ->file('gambar')
                ->store('galeri', 'public');
        }

        $galeri->update($data);

        return redirect()
            ->route('admin.galeri.index')
            ->with(
                'success',
                'Galeri berhasil diperbarui.'
            );
    }


    public function destroy(Galeri $galeri)
    {
        if (
            $galeri->gambar &&
            Storage::disk('public')
                ->exists($galeri->gambar)
        ) {
            Storage::disk('public')
                ->delete($galeri->gambar);
        }

        $galeri->delete();

        return redirect()
            ->route('admin.galeri.index')
            ->with(
                'success',
                'Galeri berhasil dihapus.'
            );
    }


    private function validateData(
        Request $request
    ): array {
        return $request->validate([

            'judul' => [
                'required',
                'string',
                'max:255',
            ],

            'tipe' => [
                'required',
                'in:foto,video',
            ],

            'deskripsi' => [
                'nullable',
                'string',
            ],

            'gambar' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

            'video_url' => [
                'nullable',
                'url',
                'max:2048',
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

            'judul.required' =>
                'Judul galeri wajib diisi.',

            'tipe.required' =>
                'Jenis galeri wajib dipilih.',

            'tipe.in' =>
                'Jenis galeri tidak valid.',

            'gambar.image' =>
                'File harus berupa gambar.',

            'gambar.max' =>
                'Ukuran gambar maksimal 5 MB.',

            'video_url.url' =>
                'Link video harus berupa URL yang valid.',

        ]);
    }
}