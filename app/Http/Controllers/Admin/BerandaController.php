<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Beranda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BerandaController extends Controller
{
    /**
     * Halaman edit beranda.
     */
    public function edit()
    {
        $beranda = Beranda::first();

        return view('admin.beranda.edit', compact('beranda'));
    }

    /**
     * Simpan / update beranda.
     */
    public function update(Request $request)
    {
        $request->validate([
            // HERO
            'hero_judul' => 'nullable|string|max:255',
            'hero_nama_sekolah' => 'nullable|string|max:255',
            'hero_tagline' => 'nullable|string|max:255',
            'hero_background' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'hero_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',

            // VISI MISI
            'visi_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'visi_caption' => 'nullable|string|max:255',
            'visi_tagline' => 'nullable|string|max:255',
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',

            // KEPALA SEKOLAH
            'kepsek_foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'kepsek_nama' => 'nullable|string|max:255',
            'kepsek_jabatan' => 'nullable|string|max:255',
            'kepsek_pembuka' => 'nullable|string|max:255',
            'kepsek_sambutan' => 'nullable|string',
            'kepsek_penutup' => 'nullable|string|max:255',

            // VIDEO PROFIL
            'video_judul' => 'nullable|string|max:255',
            'video_deskripsi' => 'nullable|string',
            'video_url' => 'nullable|string|max:500',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Ambil data pertama.
        | Kalau belum ada, buat data baru.
        |--------------------------------------------------------------------------
        */

        $beranda = Beranda::first();

        if (!$beranda) {
            $beranda = new Beranda();
        }

        /*
        |--------------------------------------------------------------------------
        | Data text
        |--------------------------------------------------------------------------
        */

        $beranda->hero_judul = $request->hero_judul;
        $beranda->hero_nama_sekolah = $request->hero_nama_sekolah;
        $beranda->hero_tagline = $request->hero_tagline;

        $beranda->visi_caption = $request->visi_caption;
        $beranda->visi_tagline = $request->visi_tagline;
        $beranda->visi = $request->visi;
        $beranda->misi = $request->misi;

        $beranda->kepsek_nama = $request->kepsek_nama;
        $beranda->kepsek_jabatan = $request->kepsek_jabatan;
        $beranda->kepsek_pembuka = $request->kepsek_pembuka;
        $beranda->kepsek_sambutan = $request->kepsek_sambutan;
        $beranda->kepsek_penutup = $request->kepsek_penutup;

        $beranda->video_judul = $request->video_judul;
        $beranda->video_deskripsi = $request->video_deskripsi;
        $beranda->video_url = $request->video_url;

        /*
        |--------------------------------------------------------------------------
        | Upload Background Hero
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('hero_background')) {

            if ($beranda->hero_background) {
                Storage::disk('public')->delete($beranda->hero_background);
            }

            $beranda->hero_background =
                $request->file('hero_background')
                    ->store('beranda/hero', 'public');
        }

        /*
        |--------------------------------------------------------------------------
        | Upload Foto Siswa Hero
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('hero_image')) {

            if ($beranda->hero_image) {
                Storage::disk('public')->delete($beranda->hero_image);
            }

            $beranda->hero_image =
                $request->file('hero_image')
                    ->store('beranda/hero', 'public');
        }

        /*
        |--------------------------------------------------------------------------
        | Upload Foto Visi
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('visi_image')) {

            if ($beranda->visi_image) {
                Storage::disk('public')->delete($beranda->visi_image);
            }

            $beranda->visi_image =
                $request->file('visi_image')
                    ->store('beranda/visi', 'public');
        }

        /*
        |--------------------------------------------------------------------------
        | Upload Foto Kepala Sekolah
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('kepsek_foto')) {

            if ($beranda->kepsek_foto) {
                Storage::disk('public')->delete($beranda->kepsek_foto);
            }

            $beranda->kepsek_foto =
                $request->file('kepsek_foto')
                    ->store('beranda/kepsek', 'public');
        }

        $beranda->save();

        return redirect()
            ->route('admin.beranda.edit')
            ->with('success', 'Halaman Beranda berhasil diperbarui.');
    }
}