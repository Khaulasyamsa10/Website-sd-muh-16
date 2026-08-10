<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use Illuminate\Http\Request;

class AlumniController extends Controller
{
    public function index(Request $request)
    {
        $cari = trim((string) $request->query('cari'));

        $tahun = $request->query('tahun');

        $query = Alumni::query();


        /*
        |--------------------------------------------------------------------------
        | Pencarian
        |--------------------------------------------------------------------------
        */

        if ($cari !== '') {

            $query->where(function ($subQuery) use ($cari) {

                $subQuery
                    ->where(
                        'nama_lengkap',
                        'like',
                        '%' . $cari . '%'
                    )
                    ->orWhere(
                        'email',
                        'like',
                        '%' . $cari . '%'
                    )
                    ->orWhere(
                        'no_hp',
                        'like',
                        '%' . $cari . '%'
                    )
                    ->orWhere(
                        'pekerjaan',
                        'like',
                        '%' . $cari . '%'
                    );

            });
        }


        /*
        |--------------------------------------------------------------------------
        | Filter Tahun Lulus
        |--------------------------------------------------------------------------
        */

        if ($tahun) {

            $query->where(
                'tahun_lulus',
                $tahun
            );
        }


        $daftarAlumni = $query
            ->latest('created_at')
            ->paginate(15)
            ->withQueryString();


        $daftarTahun = Alumni::query()
            ->select('tahun_lulus')
            ->distinct()
            ->orderByDesc('tahun_lulus')
            ->pluck('tahun_lulus');


        $jumlahBaru = Alumni::query()
            ->where('status', 'baru')
            ->count();


        $totalAlumni = Alumni::query()
            ->count();


        return view(
            'admin.alumni.index',
            compact(
                'daftarAlumni',
                'daftarTahun',
                'jumlahBaru',
                'totalAlumni',
                'cari',
                'tahun'
            )
        );
    }


    public function show(Alumni $alumni)
    {
        if ($alumni->status === 'baru') {

            $alumni->update([
                'status' => 'dibaca',
            ]);
        }

        return view(
            'admin.alumni.show',
            compact('alumni')
        );
    }


    public function destroy(Alumni $alumni)
    {
        $alumni->delete();

        return redirect()
            ->route('admin.alumni.index')
            ->with(
                'success',
                'Data alumni berhasil dihapus.'
            );
    }
}