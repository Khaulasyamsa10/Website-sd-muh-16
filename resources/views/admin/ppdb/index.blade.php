@extends('admin.layouts.app')

@section('title', 'Kelola PPDB')

@section('page-title', 'PPDB')

@section('content')


{{-- ==================================================
     HEADER
================================================== --}}

<div class="admin-page-header">

    <div>

        <h1>
            Data PPDB
        </h1>

        <p>
            Kelola informasi penerimaan peserta didik baru
            untuk setiap tahun ajaran.
        </p>

    </div>


    <a
        href="{{ route('admin.ppdb.create') }}"
        class="ppdb-admin-add-button">

        <i class="fa-solid fa-plus"></i>

        Tambah Data PPDB

    </a>

</div>



{{-- ==================================================
     SUCCESS MESSAGE
================================================== --}}

@if(session('success'))

    <div class="admin-success-message">

        <i class="fa-solid fa-circle-check"></i>

        <span>
            {{ session('success') }}
        </span>

    </div>

@endif



{{-- ==================================================
     DAFTAR PPDB
================================================== --}}

<div class="ppdb-admin-table-card">

    <div class="ppdb-admin-table-wrapper">

        <table class="ppdb-admin-table">

            <thead>

                <tr>

                    <th>
                        Tahun Ajaran
                    </th>

                    <th>
                        Judul
                    </th>

                    <th>
                        Status
                    </th>

                    <th>
                        Kuota
                    </th>

                    <th>
                        Link Pendaftaran
                    </th>

                    <th>
                        Ditampilkan
                    </th>

                    <th>
                        Aksi
                    </th>

                </tr>

            </thead>


            <tbody>

                @forelse($daftarPpdb as $item)

                    <tr>


                        {{-- Tahun Ajaran --}}

                        <td>

                            <strong>
                                {{ $item->tahun_ajaran }}
                            </strong>

                        </td>



                        {{-- Judul --}}

                        <td>

                            <div class="ppdb-admin-title">

                                <strong>
                                    {{ $item->judul }}
                                </strong>

                                @if($item->jenjang)

                                    <span>
                                        {{ $item->jenjang }}
                                    </span>

                                @endif

                            </div>

                        </td>



                        {{-- Status --}}

                        <td>

                            <span class="ppdb-admin-status">

                                {{ $item->status
                                    ? \Illuminate\Support\Str::headline(
                                        $item->status
                                    )
                                    : 'Belum ditentukan'
                                }}

                            </span>

                        </td>



                        {{-- Kuota --}}

                        <td>

                            @if($item->kuota !== null)

                                {{ $item->kuota }} siswa

                            @else

                                <span class="ppdb-admin-muted">
                                    Belum ditentukan
                                </span>

                            @endif

                        </td>



                        {{-- Link Pendaftaran --}}

                        <td>

                            @if($item->link_pendaftaran)

                                <a
                                    href="{{ $item->link_pendaftaran }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="ppdb-admin-registration-link">

                                    <i class="fa-solid fa-arrow-up-right-from-square"></i>

                                    Buka Link

                                </a>

                            @else

                                <span class="ppdb-admin-muted">

                                    Belum tersedia

                                </span>

                            @endif

                        </td>



                        {{-- Status Aktif --}}

                        <td>

                            @if($item->aktif)

                                <span class="ppdb-admin-badge active">

                                    <i class="fa-solid fa-circle-check"></i>

                                    Aktif

                                </span>

                            @else

                                <span class="ppdb-admin-badge">

                                    <i class="fa-regular fa-circle"></i>

                                    Tidak Aktif

                                </span>

                            @endif

                        </td>



                        {{-- Aksi --}}

                        <td>

                            <div class="ppdb-admin-actions">

                                <a
                                    href="{{ route(
                                        'admin.ppdb.edit',
                                        $item
                                    ) }}"
                                    class="ppdb-admin-edit-button"
                                    title="Edit PPDB">

                                    <i class="fa-solid fa-pen"></i>

                                </a>


                                <form
                                    action="{{ route(
                                        'admin.ppdb.destroy',
                                        $item
                                    ) }}"
                                    method="POST"
                                    onsubmit="return confirm(
                                        'Apakah Anda yakin ingin menghapus data PPDB tahun ajaran {{ $item->tahun_ajaran }}?'
                                    )">

                                    @csrf
                                    @method('DELETE')


                                    <button
                                        type="submit"
                                        class="ppdb-admin-delete-button"
                                        title="Hapus PPDB">

                                        <i class="fa-solid fa-trash"></i>

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>


                @empty

                    <tr>

                        <td
                            colspan="7"
                            class="ppdb-admin-empty">

                            <i class="fa-solid fa-user-graduate"></i>

                            <strong>
                                Belum Ada Data PPDB
                            </strong>

                            <span>
                                Klik tombol Tambah Data PPDB
                                untuk menambahkan informasi
                                tahun ajaran baru.
                            </span>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection