<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    public function index()
    {
        $daftarBerita = Berita::query()
            ->latest('tanggal')
            ->latest('id')
            ->get();

        return view(
            'admin.berita.index',
            compact('daftarBerita')
        );
    }

    public function create()
    {
        return view('admin.berita.create', [
            'berita' => new Berita(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);

        $data['slug'] = $this->createUniqueSlug(
            $data['judul']
        );

        $data['unggulan'] = $request->boolean('unggulan');
        $data['aktif'] = $request->boolean('aktif');

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request
                ->file('gambar')
                ->store('berita', 'public');
        }

        DB::transaction(function () use ($data) {
            if ($data['unggulan']) {
                Berita::query()->update([
                    'unggulan' => false,
                ]);
            }

            Berita::create($data);
        });

        return redirect()
            ->route('admin.berita.index')
            ->with(
                'success',
                'Berita berhasil ditambahkan.'
            );
    }

    public function edit(Berita $berita)
    {
        return view(
            'admin.berita.edit',
            compact('berita')
        );
    }

    public function update(
        Request $request,
        Berita $berita
    ) {
        $data = $this->validateData($request);

        $data['slug'] = $this->createUniqueSlug(
            $data['judul'],
            $berita->id
        );

        $data['unggulan'] = $request->boolean('unggulan');
        $data['aktif'] = $request->boolean('aktif');

        if ($request->hasFile('gambar')) {
            if (
                $berita->gambar &&
                Storage::disk('public')->exists($berita->gambar)
            ) {
                Storage::disk('public')->delete($berita->gambar);
            }

            $data['gambar'] = $request
                ->file('gambar')
                ->store('berita', 'public');
        }

        DB::transaction(function () use ($data, $berita) {
            if ($data['unggulan']) {
                Berita::query()
                    ->where('id', '!=', $berita->id)
                    ->update([
                        'unggulan' => false,
                    ]);
            }

            $berita->update($data);
        });

        return redirect()
            ->route('admin.berita.index')
            ->with(
                'success',
                'Berita berhasil diperbarui.'
            );
    }

    public function destroy(Berita $berita)
    {
        if (
            $berita->gambar &&
            Storage::disk('public')->exists($berita->gambar)
        ) {
            Storage::disk('public')->delete($berita->gambar);
        }

        $berita->delete();

        return redirect()
            ->route('admin.berita.index')
            ->with(
                'success',
                'Berita berhasil dihapus.'
            );
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'judul' => [
                'required',
                'string',
                'max:255',
            ],

            'kategori' => [
                'required',
                'string',
                'max:100',
            ],

            'ringkasan' => [
                'nullable',
                'string',
                'max:500',
            ],

            'isi' => [
                'required',
                'string',
            ],

            'tanggal' => [
                'required',
                'date',
            ],

            'penulis' => [
                'nullable',
                'string',
                'max:100',
            ],

            'gambar' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

            'unggulan' => [
                'nullable',
                'boolean',
            ],

            'aktif' => [
                'nullable',
                'boolean',
            ],
        ], [
            'judul.required' =>
                'Judul berita wajib diisi.',

            'kategori.required' =>
                'Kategori berita wajib diisi.',

            'isi.required' =>
                'Isi berita wajib diisi.',

            'tanggal.required' =>
                'Tanggal berita wajib diisi.',

            'gambar.image' =>
                'File gambar harus berupa gambar.',

            'gambar.max' =>
                'Ukuran gambar maksimal 5 MB.',
        ]);
    }

    private function createUniqueSlug(
        string $judul,
        ?int $ignoreId = null
    ): string {
        $slugDasar = Str::slug($judul);

        if ($slugDasar === '') {
            $slugDasar = 'berita';
        }

        $slug = $slugDasar;
        $nomor = 1;

        while (
            Berita::query()
                ->where('slug', $slug)
                ->when(
                    $ignoreId,
                    fn ($query) => $query->where(
                        'id',
                        '!=',
                        $ignoreId
                    )
                )
                ->exists()
        ) {
            $slug = $slugDasar . '-' . $nomor;
            $nomor++;
        }

        return $slug;
    }
}