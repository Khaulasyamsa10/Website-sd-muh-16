<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Kelola Ekstrakurikuler</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="admin-page">

<div class="admin-container">

    <div class="admin-heading">

        <div>
            <h1>Kelola Ekstrakurikuler</h1>

            <p>
                Kelola ekstrakurikuler wajib, pilihan,
                dan bimbingan prestasi.
            </p>
        </div>

        <a href="{{ route('admin.ekstrakurikuler.create') }}"
           class="admin-btn admin-btn-primary">
            + Tambah Kegiatan
        </a>

    </div>

    @if(session('success'))
        <div class="admin-alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="admin-table-wrapper">

        <table class="admin-table">

            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Kelas</th>
                    <th>Jadwal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

            @forelse($ekstrakurikuler as $item)

                <tr>

                    <td>
                        @if($item->gambar)
                            <img
                                src="{{ asset('storage/' . $item->gambar) }}"
                                class="admin-thumbnail"
                                alt="{{ $item->nama }}">
                        @else
                            <span class="admin-no-image">Tidak ada foto</span>
                        @endif
                    </td>

                    <td>{{ $item->nama }}</td>

                    <td>
                        @if($item->kategori === 'wajib')
                            Wajib
                        @elseif($item->kategori === 'pilihan')
                            Pilihan
                        @else
                            Bimbingan Prestasi
                        @endif
                    </td>

                    <td>{{ $item->kelas ?: '-' }}</td>

                    <td>{{ $item->jadwal ?: '-' }}</td>

                    <td>
                        {{ $item->aktif ? 'Aktif' : 'Tidak aktif' }}
                    </td>

                    <td class="admin-actions">

                        <a
                            href="{{ route(
                                'admin.ekstrakurikuler.edit',
                                $item
                            ) }}"
                            class="admin-btn admin-btn-edit">
                            Edit
                        </a>

                        <form
                            action="{{ route(
                                'admin.ekstrakurikuler.destroy',
                                $item
                            ) }}"
                            method="POST"
                            onsubmit="return confirm(
                                'Yakin ingin menghapus kegiatan ini?'
                            )">

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="admin-btn admin-btn-delete">
                                Hapus
                            </button>

                        </form>

                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="7" class="admin-empty">
                        Belum ada data ekstrakurikuler.
                    </td>
                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

</body>
</html>