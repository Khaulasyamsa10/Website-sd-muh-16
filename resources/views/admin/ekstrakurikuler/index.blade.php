@extends('admin.layouts.app')

@section('title', 'Kelola Ekstrakurikuler')

@section('page-title', 'Ekstrakurikuler')

@section('content')


<div class="admin-page-header">

    <div>

        <h1>Data Ekstrakurikuler</h1>

        <p>
            Kelola seluruh kegiatan ekstrakurikuler sekolah.
        </p>

    </div>


    <a
        href="{{ route(
            'admin.ekstrakurikuler.create'
        ) }}"
        class="ekstra-admin-primary-button">

        <i class="fa-solid fa-plus"></i>

        Tambah Ekstrakurikuler

    </a>

</div>


@if(session('success'))

    <div class="admin-success-message">

        <i class="fa-solid fa-circle-check"></i>

        {{ session('success') }}

    </div>

@endif


<div class="ekstra-admin-table-card">

    <div class="ekstra-admin-table-wrapper">

        <table class="ekstra-admin-table">

            <thead>

                <tr>

                    <th>Gambar</th>

                    <th>Nama</th>

                    <th>Kategori</th>

                    <th>Kelas</th>

                    <th>Jadwal</th>

                    <th>Urutan</th>

                    <th>Status</th>

                    <th>Aksi</th>

                </tr>

            </thead>


            <tbody>

                @forelse(
                    $daftarEkstrakurikuler as $item
                )

                    <tr>

                        <!-- GAMBAR -->

                        <td>

                            @if($item->gambar)

                                <img
                                    src="{{ asset(
                                        'storage/' .
                                        $item->gambar
                                    ) }}"
                                    class="ekstra-admin-thumbnail"
                                    alt="{{ $item->nama }}">

                            @else

                                <div class="ekstra-admin-no-image">

                                    <i class="fa-regular fa-image"></i>

                                </div>

                            @endif

                        </td>


                        <!-- NAMA -->

                        <td>

                            <strong>
                                {{ $item->nama }}
                            </strong>

                        </td>


                        <!-- KATEGORI -->

                        <td>

                            @if($item->kategori === 'wajib')

                                <span class="ekstra-admin-category wajib">

                                    Wajib

                                </span>

                            @elseif(
                                $item->kategori === 'pilihan'
                            )

                                <span class="ekstra-admin-category pilihan">

                                    Pilihan

                                </span>

                            @else

                                <span class="ekstra-admin-category bimpres">

                                    Bimpres

                                </span>

                            @endif

                        </td>


                        <!-- KELAS -->

                        <td>
                            {{ $item->kelas ?: '-' }}
                        </td>


                        <!-- JADWAL -->

                        <td>
                            {{ $item->jadwal ?: '-' }}
                        </td>


                        <!-- URUTAN -->

                        <td>
                            {{ $item->urutan }}
                        </td>


                        <!-- STATUS -->

                        <td>

                            <span
                                class="ekstra-admin-status
                                {{ $item->aktif
                                    ? 'active'
                                    : ''
                                }}">

                                {{ $item->aktif
                                    ? 'Aktif'
                                    : 'Nonaktif'
                                }}

                            </span>

                        </td>


                        <!-- AKSI -->

                        <td>

                            <div class="ekstra-admin-actions">

                                <a
                                    href="{{ route(
                                        'admin.ekstrakurikuler.edit',
                                        $item
                                    ) }}"
                                    class="ekstra-admin-edit"
                                    title="Edit">

                                    <i class="fa-solid fa-pen"></i>

                                </a>


                                <form
                                    action="{{ route(
                                        'admin.ekstrakurikuler.destroy',
                                        $item
                                    ) }}"
                                    method="POST"
                                    onsubmit="return confirm(
                                        'Apakah Anda yakin ingin menghapus {{ $item->nama }}?'
                                    )">

                                    @csrf
                                    @method('DELETE')


                                    <button
                                        type="submit"
                                        class="ekstra-admin-delete"
                                        title="Hapus">

                                        <i class="fa-solid fa-trash"></i>

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>


                @empty

                    <tr>

                        <td
                            colspan="8"
                            class="ekstra-admin-empty">

                            <i class="fa-solid fa-person-running"></i>

                            <strong>
                                Belum Ada Data Ekstrakurikuler
                            </strong>

                            <span>
                                Klik tombol Tambah Ekstrakurikuler
                                untuk menambahkan data.
                            </span>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection