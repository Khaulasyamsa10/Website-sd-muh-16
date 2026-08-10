@extends('admin.layouts.app')

@section('title', 'Kelola Prestasi')

@section('page-title', 'Prestasi Sekolah')

@section('content')

<div class="admin-page-header">

    <div>

        <h1>Kelola Prestasi</h1>

        <p>
            Tambah, ubah, dan hapus data prestasi siswa.
        </p>

    </div>

    <a href="{{ route('admin.prestasi.create') }}"
       class="admin-action-button">

        <i class="fa-solid fa-plus"></i>

        Tambah Prestasi

    </a>

</div>


@if(session('success'))

    <div class="admin-success-message">

        <i class="fa-solid fa-circle-check"></i>

        {{ session('success') }}

    </div>

@endif


<div class="admin-table-card">

    <div class="admin-table-responsive">

        <table class="admin-data-table">

            <thead>

                <tr>
                    <th>No.</th>
                    <th>Gambar</th>
                    <th>Prestasi</th>
                    <th>Kategori</th>
                    <th>Peserta</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>

            </thead>

            <tbody>

                @forelse($prestasi as $item)

                    <tr>

                        <td>
                            {{ $loop->iteration }}
                        </td>

                        <td>

                            @if($item->gambar)

                                <img
                                    src="{{ asset('storage/' . $item->gambar) }}"
                                    alt="{{ $item->judul }}"
                                    class="prestasi-admin-image">

                            @else

                                <div class="prestasi-admin-no-image">

                                    <i class="fa-regular fa-image"></i>

                                </div>

                            @endif

                        </td>

                        <td>

                            <div class="prestasi-admin-title">

                                <strong>
                                    {{ $item->judul }}
                                </strong>

                                @if($item->peringkat)

                                    <span>
                                        {{ $item->peringkat }}
                                    </span>

                                @endif

                            </div>

                        </td>

                        <td>

                            <span class="prestasi-category-badge kategori-{{ $item->kategori }}">

                                @if($item->kategori === 'akademik')

                                    <i class="fa-solid fa-graduation-cap"></i>

                                @elseif($item->kategori === 'olahraga')

                                    <i class="fa-solid fa-medal"></i>

                                @elseif($item->kategori === 'keislaman')

                                    <i class="fa-solid fa-mosque"></i>

                                @else

                                    <i class="fa-solid fa-palette"></i>

                                @endif

                                {{ ucfirst($item->kategori) }}

                            </span>

                        </td>

                        <td>

                            @if($item->nama_peserta)

                                <div class="prestasi-admin-participant">

                                    <strong>
                                        {{ $item->nama_peserta }}
                                    </strong>

                                    @if($item->kelas)

                                        <span>
                                            Kelas {{ $item->kelas }}
                                        </span>

                                    @endif

                                </div>

                            @else

                                <span class="agenda-data-empty">
                                    Tidak ditentukan
                                </span>

                            @endif

                        </td>

                        <td>

                            @if($item->tanggal)

                                {{ $item->tanggal
                                    ->locale('id')
                                    ->translatedFormat('d F Y') }}

                            @else

                                <span class="agenda-data-empty">
                                    Tidak ditentukan
                                </span>

                            @endif

                        </td>

                        <td>

                            @if($item->aktif)

                                <span class="status-badge status-active">

                                    <i class="fa-solid fa-circle-check"></i>

                                    Aktif

                                </span>

                            @else

                                <span class="status-badge status-inactive">

                                    <i class="fa-solid fa-circle-xmark"></i>

                                    Tidak Aktif

                                </span>

                            @endif

                        </td>

                        <td>

                            <div class="admin-table-actions">

                                <a href="{{ route('admin.prestasi.edit', $item) }}"
                                   class="table-action-button edit-button"
                                   title="Edit Prestasi">

                                    <i class="fa-solid fa-pen"></i>

                                </a>

                                <form
                                    action="{{ route('admin.prestasi.destroy', $item) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus prestasi ini?')">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="table-action-button delete-button"
                                        title="Hapus Prestasi">

                                        <i class="fa-solid fa-trash"></i>

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="8"
                            class="admin-empty-table">

                            <i class="fa-solid fa-trophy"></i>

                            <h3>Belum Ada Prestasi</h3>

                            <p>
                                Tekan tombol Tambah Prestasi untuk
                                memasukkan data baru.
                            </p>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection