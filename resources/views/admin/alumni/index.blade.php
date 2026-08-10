@extends('admin.layouts.app')

@section('title', 'Data Alumni')

@section('page-title', 'Alumni')

@section('content')

<div class="admin-page-header">

    <div>

        <h1>Data Alumni</h1>

        <p>
            Lihat dan kelola data alumni yang dikirim melalui website.
        </p>

    </div>

</div>


@if(session('success'))

    <div class="admin-success-message">

        <i class="fa-solid fa-circle-check"></i>

        {{ session('success') }}

    </div>

@endif


<!-- STATISTIK -->

<div class="alumni-admin-stat-grid">

    <div class="alumni-admin-stat-card">

        <div class="alumni-admin-stat-icon">

            <i class="fa-solid fa-user-graduate"></i>

        </div>

        <div>

            <span>Total Alumni</span>

            <strong>
                {{ $totalAlumni }}
            </strong>

        </div>

    </div>


    <div class="alumni-admin-stat-card">

        <div class="alumni-admin-stat-icon new">

            <i class="fa-solid fa-envelope"></i>

        </div>

        <div>

            <span>Data Baru</span>

            <strong>
                {{ $jumlahBaru }}
            </strong>

        </div>

    </div>

</div>


<!-- PENCARIAN -->

<form action="{{ route('admin.alumni.index') }}"
      method="GET"
      class="alumni-admin-filter">

    <div class="alumni-admin-search">

        <i class="fa-solid fa-magnifying-glass"></i>

        <input
            type="search"
            name="cari"
            value="{{ $cari }}"
            placeholder="Cari nama, email, nomor HP...">

    </div>


    <select name="tahun">

        <option value="">
            Semua Tahun Lulus
        </option>

        @foreach($daftarTahun as $itemTahun)

            <option
                value="{{ $itemTahun }}"
                @selected(
                    (string) $tahun
                    === (string) $itemTahun
                )>

                {{ $itemTahun }}

            </option>

        @endforeach

    </select>


    <button type="submit">

        <i class="fa-solid fa-filter"></i>

        Filter

    </button>


    @if($cari || $tahun)

        <a href="{{ route('admin.alumni.index') }}">

            Reset

        </a>

    @endif

</form>


<!-- TABEL -->

<div class="alumni-admin-table-card">

    <div class="alumni-admin-table-wrapper">

        <table class="alumni-admin-table">

            <thead>

                <tr>

                    <th>Nama</th>

                    <th>Tahun Lulus</th>

                    <th>Kontak</th>

                    <th>Pendidikan / Pekerjaan</th>

                    <th>Status</th>

                    <th>Aksi</th>

                </tr>

            </thead>


            <tbody>

                @forelse($daftarAlumni as $item)

                    <tr class="{{ $item->status === 'baru'
                        ? 'alumni-row-new'
                        : ''
                    }}">

                        <td>

                            <strong>
                                {{ $item->nama_lengkap }}
                            </strong>

                            <span>
                                {{ $item->jenis_kelamin }}
                            </span>

                        </td>


                        <td>

                            {{ $item->tahun_lulus }}

                        </td>


                        <td>

                            @if($item->no_hp)

                                <span>
                                    {{ $item->no_hp }}
                                </span>

                            @endif

                            @if($item->email)

                                <small>
                                    {{ $item->email }}
                                </small>

                            @endif

                            @if(!$item->no_hp && !$item->email)

                                -

                            @endif

                        </td>


                        <td>

                            {{ $item->pekerjaan
                                ?: $item->pendidikan_saat_ini
                                ?: '-'
                            }}

                        </td>


                        <td>

                            @if($item->status === 'baru')

                                <span class="alumni-admin-status new">

                                    Baru

                                </span>

                            @else

                                <span class="alumni-admin-status">

                                    Dibaca

                                </span>

                            @endif

                        </td>


                        <td>

                            <div class="alumni-admin-actions">

                                <a
                                    href="{{ route(
                                        'admin.alumni.show',
                                        $item
                                    ) }}"
                                    class="alumni-admin-view"
                                    title="Lihat">

                                    <i class="fa-solid fa-eye"></i>

                                </a>


                                <form
                                    action="{{ route(
                                        'admin.alumni.destroy',
                                        $item
                                    ) }}"
                                    method="POST"
                                    onsubmit="return confirm(
                                        'Hapus data alumni ini?'
                                    )">

                                    @csrf
                                    @method('DELETE')


                                    <button
                                        type="submit"
                                        class="alumni-admin-delete"
                                        title="Hapus">

                                        <i class="fa-solid fa-trash"></i>

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="6"
                            class="alumni-admin-empty">

                            <i class="fa-solid fa-user-graduate"></i>

                            <strong>
                                Belum Ada Data Alumni
                            </strong>

                            <span>
                                Data yang dikirim dari formulir alumni
                                akan muncul di sini.
                            </span>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>


@if($daftarAlumni->hasPages())

    <div class="alumni-admin-pagination">

        {{ $daftarAlumni->links() }}

    </div>

@endif

@endsection