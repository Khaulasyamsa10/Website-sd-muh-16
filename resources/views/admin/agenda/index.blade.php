@extends('admin.layouts.app')

@section('title', 'Kelola Agenda')

@section('page-title', 'Agenda Sekolah')

@section('content')

<div class="admin-page-header">

    <div>
        <h1>Kelola Agenda</h1>

        <p>
            Tambah, ubah, dan hapus agenda kegiatan sekolah.
        </p>
    </div>

    <a href="{{ route('admin.agenda.create') }}"
       class="admin-action-button">

        <i class="fa-solid fa-plus"></i>
        Tambah Agenda

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
                    <th>Judul</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th>Lokasi</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>

            </thead>

            <tbody>

                @forelse($agenda as $item)

                    <tr>

                        {{-- Nomor --}}
                        <td>
                            {{ $loop->iteration }}
                        </td>


                        {{-- Gambar --}}
                        <td>

                            @if($item->gambar)

                                <img
                                    src="{{ asset('storage/' . $item->gambar) }}"
                                    class="agenda-admin-image"
                                    alt="{{ $item->judul }}">

                            @else

                                <div class="agenda-no-image">

                                    <i class="fa-solid fa-image"></i>

                                    <span>Tidak ada gambar</span>

                                </div>

                            @endif

                        </td>


                        {{-- Judul --}}
                        <td>

                            <div class="agenda-admin-title">

                                <strong>
                                    {{ $item->judul }}
                                </strong>

                                @if($item->deskripsi)

                                    <span>
                                        {{ \Illuminate\Support\Str::limit(
                                            $item->deskripsi,
                                            70
                                        ) }}
                                    </span>

                                @endif

                            </div>

                        </td>


                        {{-- Tanggal --}}
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


                        {{-- Waktu --}}
                        <td>

                            @if($item->jam_mulai)

                                {{ \Carbon\Carbon::parse(
                                    $item->jam_mulai
                                )->format('H.i') }}

                                @if($item->jam_selesai)

                                    -

                                    {{ \Carbon\Carbon::parse(
                                        $item->jam_selesai
                                    )->format('H.i') }}

                                @endif

                                WIB

                            @else

                                <span class="agenda-data-empty">
                                    Tidak ditentukan
                                </span>

                            @endif

                        </td>


                        {{-- Lokasi --}}
                        <td>

                            @if($item->lokasi)

                                <div class="agenda-admin-location">

                                    <i class="fa-solid fa-location-dot"></i>

                                    <span>
                                        {{ $item->lokasi }}
                                    </span>

                                </div>

                            @else

                                <span class="agenda-data-empty">
                                    Tidak ditentukan
                                </span>

                            @endif

                        </td>


                        {{-- Status --}}
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


                        {{-- Aksi --}}
                        <td>

                            <div class="admin-table-actions">

                                <a
                                    href="{{ route(
                                        'admin.agenda.edit',
                                        $item
                                    ) }}"
                                    class="table-action-button edit-button"
                                    title="Edit Agenda">

                                    <i class="fa-solid fa-pen"></i>

                                </a>


                                <form
                                    action="{{ route(
                                        'admin.agenda.destroy',
                                        $item
                                    ) }}"
                                    method="POST"
                                    onsubmit="return confirm(
                                        'Yakin ingin menghapus agenda ini?'
                                    )">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="table-action-button delete-button"
                                        title="Hapus Agenda">

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

                            <i class="fa-solid fa-calendar-xmark"></i>

                            <h3>Belum Ada Agenda</h3>

                            <p>
                                Tekan tombol Tambah Agenda untuk
                                menambahkan agenda sekolah.
                            </p>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection