<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        {{ $ekstrakurikuler->exists
            ? 'Edit Ekstrakurikuler'
            : 'Tambah Ekstrakurikuler' }}
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="admin-page">

<div class="admin-form-container">

    <h1>
        {{ $ekstrakurikuler->exists
            ? 'Edit Kegiatan'
            : 'Tambah Kegiatan' }}
    </h1>

    <a href="{{ route('admin.ekstrakurikuler.index') }}"
       class="admin-back">
        ← Kembali
    </a>

    @if($errors->any())
        <div class="admin-error">

            <strong>Periksa kembali data berikut:</strong>

            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

        </div>
    @endif

    <form
        action="{{ $ekstrakurikuler->exists
            ? route(
                'admin.ekstrakurikuler.update',
                $ekstrakurikuler
              )
            : route('admin.ekstrakurikuler.store') }}"
        method="POST"
        enctype="multipart/form-data"
        class="admin-form">

        @csrf

        @if($ekstrakurikuler->exists)
            @method('PUT')
        @endif

        <div class="admin-field">

            <label for="nama">Nama kegiatan</label>

            <input
                type="text"
                id="nama"
                name="nama"
                value="{{ old('nama', $ekstrakurikuler->nama) }}"
                required>

        </div>

        <div class="admin-field">

            <label for="kategori">Kategori</label>

            <select id="kategori" name="kategori" required>

                <option value="">Pilih kategori</option>

                <option value="wajib"
                    @selected(
                        old('kategori', $ekstrakurikuler->kategori)
                        === 'wajib'
                    )>
                    Ekstrakurikuler Wajib
                </option>

                <option value="pilihan"
                    @selected(
                        old('kategori', $ekstrakurikuler->kategori)
                        === 'pilihan'
                    )>
                    Ekstrakurikuler Pilihan
                </option>

                <option value="bimpres"
                    @selected(
                        old('kategori', $ekstrakurikuler->kategori)
                        === 'bimpres'
                    )>
                    Bimbingan Prestasi
                </option>

            </select>

        </div>

        <div class="admin-field">

            <label for="kelas">Kelas</label>

            <input
                type="text"
                id="kelas"
                name="kelas"
                placeholder="Contoh: Kelas 1–6"
                value="{{ old('kelas', $ekstrakurikuler->kelas) }}">

        </div>

        <div class="admin-field">

            <label for="jadwal">Jadwal</label>

            <input
                type="text"
                id="jadwal"
                name="jadwal"
                placeholder="Contoh: Sabtu pagi"
                value="{{ old('jadwal', $ekstrakurikuler->jadwal) }}">

        </div>

        <div class="admin-field">

            <label for="keterangan">Keterangan</label>

            <textarea
                id="keterangan"
                name="keterangan"
                rows="4"
                placeholder="Informasi tambahan">{{ old(
                    'keterangan',
                    $ekstrakurikuler->keterangan
                ) }}</textarea>

        </div>

        <div class="admin-field">

            <label for="gambar">Gambar kegiatan</label>

            <input
                type="file"
                id="gambar"
                name="gambar"
                accept=".jpg,.jpeg,.png,.webp">

            @if($ekstrakurikuler->gambar)

                <div class="admin-current-image">

                    <p>Gambar saat ini:</p>

                    <img
                        src="{{ asset(
                            'storage/' . $ekstrakurikuler->gambar
                        ) }}"
                        alt="{{ $ekstrakurikuler->nama }}">

                </div>

            @endif

        </div>

        <div class="admin-field">

            <label for="urutan">Urutan tampil</label>

            <input
                type="number"
                id="urutan"
                name="urutan"
                min="0"
                value="{{ old(
                    'urutan',
                    $ekstrakurikuler->urutan ?? 0
                ) }}"
                required>

        </div>

        <div class="admin-field admin-checkbox">

            <input type="hidden" name="aktif" value="0">

            <input
                type="checkbox"
                id="aktif"
                name="aktif"
                value="1"
                @checked(
                    old(
                        'aktif',
                        $ekstrakurikuler->exists
                            ? $ekstrakurikuler->aktif
                            : true
                    )
                )>

            <label for="aktif">Tampilkan di halaman website</label>

        </div>

        <button
            type="submit"
            class="admin-btn admin-btn-primary">
            Simpan Data
        </button>

    </form>

</div>

</body>
</html>