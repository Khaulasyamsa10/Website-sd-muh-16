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
        |--------------------------------------------------------------------------
        | VALIDASI FOTO
        |--------------------------------------------------------------------------
        */

        if (
            $request->input('tipe') === 'foto' &&
            !$request->hasFile('gambar')
        ) {
            return back()
                ->withErrors([
                    'gambar' => 'Gambar wajib diunggah untuk galeri foto.',
                ])
                ->withInput();
        }


        /*
        |--------------------------------------------------------------------------
        | VALIDASI VIDEO
        |--------------------------------------------------------------------------
        |
        | Video boleh berupa:
        | 1. Upload video langsung
        | 2. Link YouTube
        |
        */

        if (
            $request->input('tipe') === 'video' &&
            !$request->hasFile('video_file') &&
            !$request->filled('video_url')
        ) {
            return back()
                ->withErrors([
                    'video_file' =>
                        'Silakan upload video atau isi link YouTube.',
                ])
                ->withInput();
        }


        /*
        |--------------------------------------------------------------------------
        | UPLOAD GAMBAR / THUMBNAIL
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request
                ->file('gambar')
                ->store('galeri/gambar', 'public');
        }


        /*
        |--------------------------------------------------------------------------
        | UPLOAD VIDEO
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('video_file')) {
            $data['video_file'] = $request
                ->file('video_file')
                ->store('galeri/video', 'public');
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


        /*
        |--------------------------------------------------------------------------
        | VALIDASI FOTO
        |--------------------------------------------------------------------------
        */

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


        /*
        |--------------------------------------------------------------------------
        | VALIDASI VIDEO
        |--------------------------------------------------------------------------
        */

        if (
            $request->input('tipe') === 'video' &&
            !$request->hasFile('video_file') &&
            !$request->filled('video_url') &&
            !$galeri->video_file
        ) {
            return back()
                ->withErrors([
                    'video_file' =>
                        'Silakan upload video atau isi link YouTube.',
                ])
                ->withInput();
        }


        /*
        |--------------------------------------------------------------------------
        | GANTI GAMBAR
        |--------------------------------------------------------------------------
        */

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
                ->store('galeri/gambar', 'public');
        }


        /*
        |--------------------------------------------------------------------------
        | GANTI VIDEO
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('video_file')) {

            if (
                $galeri->video_file &&
                Storage::disk('public')
                    ->exists($galeri->video_file)
            ) {
                Storage::disk('public')
                    ->delete($galeri->video_file);
            }

            $data['video_file'] = $request
                ->file('video_file')
                ->store('galeri/video', 'public');
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
        /*
        |--------------------------------------------------------------------------
        | HAPUS GAMBAR
        |--------------------------------------------------------------------------
        */

        if (
            $galeri->gambar &&
            Storage::disk('public')
                ->exists($galeri->gambar)
        ) {
            Storage::disk('public')
                ->delete($galeri->gambar);
        }


        /*
        |--------------------------------------------------------------------------
        | HAPUS VIDEO
        |--------------------------------------------------------------------------
        */

        if (
            $galeri->video_file &&
            Storage::disk('public')
                ->exists($galeri->video_file)
        ) {
            Storage::disk('public')
                ->delete($galeri->video_file);
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

            'video_file' => [
                'nullable',
                'file',
                'mimes:mp4,mov,webm,m4v',
                'max:102400',
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

            'video_file.file' =>
                'File video tidak valid.',

            'video_file.mimes' =>
                'Format video harus MP4, MOV, WEBM, atau M4V.',

            'video_file.max' =>
                'Ukuran video maksimal 100 MB.',

        ]);
    }
}