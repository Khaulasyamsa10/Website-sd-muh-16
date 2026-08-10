<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ppdb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class PpdbController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $daftarPpdb = Ppdb::query()
            ->latest('id')
            ->get();

        return view(
            'admin.ppdb.index',
            compact('daftarPpdb')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view(
            'admin.ppdb.create',
            [
                'ppdb' => new Ppdb(),
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $data = $this->validateData($request);

        $data['aktif'] =
            $request->boolean('aktif');


        /*
        |--------------------------------------------------------------------------
        | Upload Brosur Gambar
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('brosur_gambar')) {

            $data['brosur_gambar'] =
                $request
                    ->file('brosur_gambar')
                    ->store(
                        'ppdb',
                        'public'
                    );
        }


        /*
        |--------------------------------------------------------------------------
        | Upload Brosur PDF
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('brosur_pdf')) {

            $data['brosur_pdf'] =
                $request
                    ->file('brosur_pdf')
                    ->store(
                        'ppdb',
                        'public'
                    );
        }


        /*
        |--------------------------------------------------------------------------
        | Hanya satu PPDB aktif
        |--------------------------------------------------------------------------
        */

        if ($data['aktif']) {

            Ppdb::query()
                ->update([
                    'aktif' => false,
                ]);
        }


        Ppdb::create($data);


        return redirect()
            ->route('admin.ppdb.index')
            ->with(
                'success',
                'Data PPDB berhasil ditambahkan.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    public function edit(Ppdb $ppdb)
    {
        return view(
            'admin.ppdb.edit',
            compact('ppdb')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        Ppdb $ppdb
    ) {
        $data =
            $this->validateData(
                $request,
                $ppdb
            );


        $data['aktif'] =
            $request->boolean('aktif');


        /*
        |--------------------------------------------------------------------------
        | Ganti Brosur Gambar
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('brosur_gambar')) {

            if (
                $ppdb->brosur_gambar &&
                Storage::disk('public')
                    ->exists(
                        $ppdb->brosur_gambar
                    )
            ) {
                Storage::disk('public')
                    ->delete(
                        $ppdb->brosur_gambar
                    );
            }


            $data['brosur_gambar'] =
                $request
                    ->file('brosur_gambar')
                    ->store(
                        'ppdb',
                        'public'
                    );
        }


        /*
        |--------------------------------------------------------------------------
        | Ganti Brosur PDF
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('brosur_pdf')) {

            if (
                $ppdb->brosur_pdf &&
                Storage::disk('public')
                    ->exists(
                        $ppdb->brosur_pdf
                    )
            ) {
                Storage::disk('public')
                    ->delete(
                        $ppdb->brosur_pdf
                    );
            }


            $data['brosur_pdf'] =
                $request
                    ->file('brosur_pdf')
                    ->store(
                        'ppdb',
                        'public'
                    );
        }


        /*
        |--------------------------------------------------------------------------
        | Jika data ini dibuat aktif,
        | nonaktifkan PPDB lainnya
        |--------------------------------------------------------------------------
        */

        if ($data['aktif']) {

            Ppdb::query()
                ->where(
                    'id',
                    '!=',
                    $ppdb->id
                )
                ->update([
                    'aktif' => false,
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Simpan perubahan
        |--------------------------------------------------------------------------
        */

        $ppdb->update($data);


        return redirect()
            ->route('admin.ppdb.index')
            ->with(
                'success',
                'Data PPDB berhasil diperbarui.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */

    public function destroy(Ppdb $ppdb)
    {
        $wasActive = $ppdb->aktif;


        /*
        |--------------------------------------------------------------------------
        | Hapus Brosur Gambar
        |--------------------------------------------------------------------------
        */

        if (
            $ppdb->brosur_gambar &&
            Storage::disk('public')
                ->exists(
                    $ppdb->brosur_gambar
                )
        ) {
            Storage::disk('public')
                ->delete(
                    $ppdb->brosur_gambar
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Hapus PDF
        |--------------------------------------------------------------------------
        */

        if (
            $ppdb->brosur_pdf &&
            Storage::disk('public')
                ->exists(
                    $ppdb->brosur_pdf
                )
        ) {
            Storage::disk('public')
                ->delete(
                    $ppdb->brosur_pdf
                );
        }


        $ppdb->delete();


        /*
        |--------------------------------------------------------------------------
        | Jika yang dihapus sebelumnya aktif,
        | aktifkan data terbaru
        |--------------------------------------------------------------------------
        */

        if ($wasActive) {

            $latest =
                Ppdb::query()
                    ->latest('id')
                    ->first();


            if ($latest) {

                $latest->update([
                    'aktif' => true,
                ]);
            }
        }


        return redirect()
            ->route('admin.ppdb.index')
            ->with(
                'success',
                'Data PPDB berhasil dihapus.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | VALIDASI
    |--------------------------------------------------------------------------
    */

    private function validateData(
        Request $request,
        ?Ppdb $ppdb = null
    ): array {

        return $request->validate([

            'judul' => [
                'required',
                'string',
                'max:255',
            ],

            'tahun_ajaran' => [
                'required',
                'string',
                'max:50',

                Rule::unique(
                    'ppdb',
                    'tahun_ajaran'
                )->ignore(
                    $ppdb?->id
                ),
            ],

            'jenjang' => [
                'nullable',
                'string',
                'max:100',
            ],

            'status' => [
                'nullable',
                'string',
                'max:100',
            ],

            'kuota' => [
                'nullable',
                'integer',
                'min:0',
            ],

            /*
            |--------------------------------------------------------------------------
            | LINK PENDAFTARAN
            |--------------------------------------------------------------------------
            */

            'link_pendaftaran' => [
                'nullable',
                'url',
                'max:2048',
            ],

            'brosur_gambar' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

            'brosur_pdf' => [
                'nullable',
                'file',
                'mimes:pdf',
                'max:10240',
            ],

            'aktif' => [
                'nullable',
                'boolean',
            ],

        ], [

            'judul.required' =>
                'Judul PPDB wajib diisi.',

            'tahun_ajaran.required' =>
                'Tahun ajaran wajib diisi.',

            'tahun_ajaran.unique' =>
                'Tahun ajaran tersebut sudah tersedia.',

            'link_pendaftaran.url' =>
                'Link pendaftaran harus berupa URL yang valid.',

            'brosur_gambar.image' =>
                'Brosur gambar harus berupa file gambar.',

            'brosur_gambar.max' =>
                'Ukuran gambar maksimal 5 MB.',

            'brosur_pdf.mimes' =>
                'Brosur harus berupa file PDF.',

            'brosur_pdf.max' =>
                'Ukuran PDF maksimal 10 MB.',
        ]);
    }
}