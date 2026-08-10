<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use Illuminate\Http\Request;

class AlumniController extends Controller
{
    public function index()
    {
        return view('website.alumni');
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_lengkap' => [
                'required',
                'string',
                'max:255',
            ],

            'tahun_lulus' => [
                'required',
                'integer',
                'digits:4',
                'min:1950',
                'max:' . now()->year,
            ],

            'jenis_kelamin' => [
                'required',
                'in:Laki-laki,Perempuan',
            ],

            'no_hp' => [
                'nullable',
                'string',
                'max:30',
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
            ],

            'pendidikan_saat_ini' => [
                'nullable',
                'string',
                'max:255',
            ],

            'pekerjaan' => [
                'nullable',
                'string',
                'max:255',
            ],

            'alamat' => [
                'nullable',
                'string',
                'max:2000',
            ],

            'pesan_kesan' => [
                'nullable',
                'string',
                'max:3000',
            ],
        ], [
            'nama_lengkap.required' =>
                'Nama lengkap wajib diisi.',

            'tahun_lulus.required' =>
                'Tahun lulus wajib diisi.',

            'tahun_lulus.digits' =>
                'Tahun lulus harus terdiri dari 4 angka.',

            'jenis_kelamin.required' =>
                'Jenis kelamin wajib dipilih.',

            'email.email' =>
                'Format email tidak valid.',
        ]);

        $data['status'] = 'baru';

        Alumni::create($data);

        return redirect()
            ->route('alumni')
            ->with(
                'success',
                'Terima kasih. Data alumni berhasil dikirim dan tersimpan.'
            );
    }
}