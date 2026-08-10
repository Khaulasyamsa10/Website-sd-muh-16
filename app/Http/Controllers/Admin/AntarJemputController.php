<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AntarJemput;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AntarJemputController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | HALAMAN ADMIN
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $antarJemput = AntarJemput::query()
            ->latest('id')
            ->first();

        /*
         * Jika belum ada data sama sekali,
         * buat satu data kosong.
         */
        if (!$antarJemput) {
            $antarJemput = AntarJemput::create([
                'pamflet_gambar' => null,
                'batas_pendaftaran' => null,
            ]);
        }

        return view(
            'admin.antar-jemput.index',
            compact('antarJemput')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update(Request $request)
    {
        $data = $request->validate([
            'pamflet_gambar' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

            'batas_pendaftaran' => [
                'nullable',
                'date',
            ],
        ], [
            'pamflet_gambar.image' =>
                'File pamflet harus berupa gambar.',

            'pamflet_gambar.mimes' =>
                'Format pamflet harus JPG, JPEG, PNG, atau WEBP.',

            'pamflet_gambar.max' =>
                'Ukuran pamflet maksimal 5 MB.',

            'batas_pendaftaran.date' =>
                'Batas pendaftaran harus berupa tanggal yang valid.',
        ]);


        $antarJemput = AntarJemput::query()
            ->latest('id')
            ->first();


        if (!$antarJemput) {
            $antarJemput = new AntarJemput();
        }


        /*
        |--------------------------------------------------------------------------
        | UPLOAD PAMFLET
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('pamflet_gambar')) {

            if (
                $antarJemput->pamflet_gambar &&
                Storage::disk('public')
                    ->exists($antarJemput->pamflet_gambar)
            ) {
                Storage::disk('public')
                    ->delete($antarJemput->pamflet_gambar);
            }


            $data['pamflet_gambar'] =
                $request
                    ->file('pamflet_gambar')
                    ->store(
                        'antar-jemput',
                        'public'
                    );
        }


        /*
        |--------------------------------------------------------------------------
        | SIMPAN
        |--------------------------------------------------------------------------
        */

        $antarJemput->fill($data);

        $antarJemput->save();


        return redirect()
            ->route('admin.antar-jemput.index')
            ->with(
                'success',
                'Informasi antar jemput berhasil diperbarui.'
            );
    }
}