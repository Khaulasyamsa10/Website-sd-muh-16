@extends('admin.layouts.app')

@section('title', 'Kelola Galeri')

@section('page-title', 'Galeri')

@section('content')

<div class="admin-page-header">

    <div>

        <h1>Data Galeri</h1>

        <p>
            Kelola seluruh dokumentasi foto dan video sekolah.
        </p>

    </div>

    <a href="{{ route('admin.galeri.create') }}"
       class="gallery-admin-primary-button">

        <i class="fa-solid fa-plus"></i>

        Tambah Galeri

    </a>

</div>


@if(session('success'))

    <div class="admin-success-message">

        <i class="fa-solid fa-circle-check"></i>

        <span>
            {{ session('success') }}
        </span>

    </div>

@endif


<div class="gallery-admin-table-card">

    <div class="gallery-admin-table-wrapper">

        <table class="gallery-admin-table">

            <thead>

                <tr>
                    <th>Preview</th>
                    <th>Judul</th>
                    <th>Jenis</th>
                    <th>Urutan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>

            </thead>

            <tbody>

                @forelse($daftarGaleri as $item)

                    <tr>

                        {{-- PREVIEW --}}

                        <td>

                            @if($item->gambar)

                                <img
                                    src="{{ asset('storage/' . $item->gambar) }}"
                                    class="gallery-admin-thumbnail"
                                    alt="{{ $item->judul }}">

                            @else

                                <div class="gallery-admin-no-image">

                                    @if($item->tipe === 'video')

                                        <i class="fa-solid fa-video"></i>

                                    @else

                                        <i class="fa-regular fa-image"></i>

                                    @endif

                                </div>

                            @endif

                        </td>


                        {{-- JUDUL --}}

                        <td>

                            <strong>
                                {{ $item->judul }}
                            </strong>

                            @if($item->deskripsi)

                                <span class="gallery-admin-description">

                                    {{ \Illuminate\Support\Str::limit(
                                        $item->deskripsi,
                                        60
                                    ) }}

                                </span>

                            @endif

                        </td>


                        {{-- JENIS --}}

                        <td>

                            <span class="gallery-admin-type {{ $item->tipe }}">

                                @if($item->tipe === 'foto')

                                    <i class="fa-regular fa-image"></i>

                                    Foto

                                @else

                                    <i class="fa-solid fa-video"></i>

                                    Video

                                @endif

                            </span>

                        </td>


                        {{-- URUTAN --}}

                        <td>
                            {{ $item->urutan }}
                        </td>


                        {{-- STATUS --}}

                        <td>

                            <span class="gallery-admin-status
                                {{ $item->aktif ? 'active' : '' }}">

                                @if($item->aktif)

                                    <i class="fa-solid fa-circle-check"></i>

                                    Aktif

                                @else

                                    <i class="fa-solid fa-circle-xmark"></i>

                                    Nonaktif

                                @endif

                            </span>

                        </td>


                        {{-- AKSI --}}

                        <td>

                            <div class="gallery-admin-actions">

                                <a
                                    href="{{ route(
                                        'admin.galeri.edit',
                                        $item
                                    ) }}"
                                    class="gallery-admin-edit"
                                    title="Edit">

                                    <i class="fa-solid fa-pen"></i>

                                </a>


                                <form
                                    action="{{ route(
                                        'admin.galeri.destroy',
                                        $item
                                    ) }}"
                                    method="POST"
                                    onsubmit="return confirm(
                                        'Apakah Anda yakin ingin menghapus galeri ini?'
                                    )">

                                    @csrf
                                    @method('DELETE')


                                    <button
                                        type="submit"
                                        class="gallery-admin-delete"
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
                            class="gallery-admin-empty">

                            <i class="fa-regular fa-images"></i>

                            <strong>
                                Belum Ada Galeri
                            </strong>

                            <span>
                                Klik tombol Tambah Galeri untuk
                                menambahkan foto atau video.
                            </span>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection