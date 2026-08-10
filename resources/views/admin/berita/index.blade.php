@extends('admin.layouts.app')

@section('title', 'Kelola Berita')

@section('page-title', 'Berita')

@section('content')

<div class="admin-page-header">

    <div>

        <h1>Data Berita</h1>

        <p>
            Tambah, edit, dan kelola berita sekolah.
        </p>

    </div>

    <a href="{{ route('admin.berita.create') }}"
       class="news-admin-primary-button">

        <i class="fa-solid fa-plus"></i>

        Tambah Berita

    </a>

</div>


@if(session('success'))

    <div class="admin-success-message">

        <i class="fa-solid fa-circle-check"></i>

        {{ session('success') }}

    </div>

@endif


<div class="news-admin-table-card">

    <div class="news-admin-table-wrapper">

        <table class="news-admin-table">

            <thead>

                <tr>
                    <th>Gambar</th>
                    <th>Judul</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Unggulan</th>
                    <th>Aksi</th>
                </tr>

            </thead>

            <tbody>

                @forelse($daftarBerita as $item)

                    <tr>

                        <td>

                            @if($item->gambar)

                                <img src="{{ asset(
                                        'storage/' .
                                        $item->gambar
                                    ) }}"
                                     class="news-admin-thumbnail"
                                     alt="{{ $item->judul }}">

                            @else

                                <div class="news-admin-no-image">

                                    <i class="fa-regular fa-image"></i>

                                </div>

                            @endif

                        </td>

                        <td>

                            <strong>
                                {{ $item->judul }}
                            </strong>

                            <span class="news-admin-category">
                                {{ $item->kategori }}
                            </span>

                        </td>

                        <td>
                            {{ $item->tanggal
                                ->translatedFormat('d M Y')
                            }}
                        </td>

                        <td>

                            <span class="news-admin-badge
                                {{ $item->aktif ? 'active' : '' }}">

                                {{ $item->aktif
                                    ? 'Tampil'
                                    : 'Disembunyikan'
                                }}

                            </span>

                        </td>

                        <td>

                            @if($item->unggulan)

                                <span class="news-admin-featured">

                                    <i class="fa-solid fa-star"></i>

                                    Utama

                                </span>

                            @else

                                <span>-</span>

                            @endif

                        </td>

                        <td>

                            <div class="news-admin-actions">

                                <a href="{{ route(
                                        'admin.berita.edit',
                                        $item
                                    ) }}"
                                   class="news-admin-edit"
                                   title="Edit">

                                    <i class="fa-solid fa-pen"></i>

                                </a>

                                <form action="{{ route(
                                        'admin.berita.destroy',
                                        $item
                                    ) }}"
                                      method="POST"
                                      onsubmit="return confirm(
                                          'Hapus berita ini?'
                                      )">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="news-admin-delete"
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
                            class="news-admin-empty">

                            Belum ada berita yang ditambahkan.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection