@php
    $isEdit = $ekstrakurikuler->exists;
@endphp


@if($errors->any())

    <div class="admin-error-message">

        <i class="fa-solid fa-circle-exclamation"></i>

        <div>

            <strong>
                Data belum berhasil disimpan.
            </strong>

            <ul>

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    </div>

@endif


<div class="admin-form-card">

    <form
        action="{{ $isEdit
            ? route(
                'admin.ekstrakurikuler.update',
                $ekstrakurikuler
            )
            : route(
                'admin.ekstrakurikuler.store'
            )
        }}"
        method="POST"
        enctype="multipart/form-data">

        @csrf

        @if($isEdit)
            @method('PUT')
        @endif


        <div class="ekstra-admin-form-grid">


            <!-- NAMA -->

            <div class="ekstra-admin-form-group full">

                <label for="nama">
                    Nama Ekstrakurikuler
                </label>

                <input
                    type="text"
                    id="nama"
                    name="nama"
                    value="{{ old(
                        'nama',
                        $ekstrakurikuler->nama
                    ) }}"
                    placeholder="Contoh: Hizbul Wathan"
                    required>

                @error('nama')

                    <span class="ekstra-admin-error">
                        {{ $message }}
                    </span>

                @enderror

            </div>


            <!-- KATEGORI -->

            <div class="ekstra-admin-form-group">

                <label for="kategori">
                    Kategori
                </label>

                <select
                    id="kategori"
                    name="kategori"
                    required>

                    <option value="">
                        -- Pilih Kategori --
                    </option>

                    <option
                        value="wajib"
                        @selected(
                            old(
                                'kategori',
                                $ekstrakurikuler->kategori
                            ) === 'wajib'
                        )>

                        Ekstrakurikuler Wajib

                    </option>

                    <option
                        value="pilihan"
                        @selected(
                            old(
                                'kategori',
                                $ekstrakurikuler->kategori
                            ) === 'pilihan'
                        )>

                        Ekstrakurikuler Pilihan

                    </option>

                    <option
                        value="bimpres"
                        @selected(
                            old(
                                'kategori',
                                $ekstrakurikuler->kategori
                            ) === 'bimpres'
                        )>

                        Bimbingan Prestasi

                    </option>

                </select>

            </div>


            <!-- URUTAN -->

            <div class="ekstra-admin-form-group">

                <label for="urutan">
                    Urutan Tampil
                </label>

                <input
                    type="number"
                    id="urutan"
                    name="urutan"
                    min="0"
                    value="{{ old(
                        'urutan',
                        $ekstrakurikuler->urutan ?? 0
                    ) }}">

                <small>
                    Angka lebih kecil tampil lebih dahulu.
                </small>

            </div>


            <!-- KELAS -->

            <div class="ekstra-admin-form-group">

                <label for="kelas">
                    Kelas
                </label>

                <input
                    type="text"
                    id="kelas"
                    name="kelas"
                    value="{{ old(
                        'kelas',
                        $ekstrakurikuler->kelas
                    ) }}"
                    placeholder="Contoh: Kelas 1 - 6">

            </div>


            <!-- JADWAL -->

            <div class="ekstra-admin-form-group">

                <label for="jadwal">
                    Jadwal
                </label>

                <input
                    type="text"
                    id="jadwal"
                    name="jadwal"
                    value="{{ old(
                        'jadwal',
                        $ekstrakurikuler->jadwal
                    ) }}"
                    placeholder="Contoh: Jumat, 13.00 - 14.30">

            </div>


            <!-- KETERANGAN -->

            <div class="ekstra-admin-form-group full">

                <label for="keterangan">
                    Keterangan
                </label>

                <textarea
                    id="keterangan"
                    name="keterangan"
                    rows="6"
                    placeholder="Tuliskan penjelasan mengenai kegiatan ekstrakurikuler...">{{ old(
                        'keterangan',
                        $ekstrakurikuler->keterangan
                    ) }}</textarea>

            </div>


            <!-- GAMBAR -->

            <div class="ekstra-admin-form-group full">

                <label for="gambar">
                    Gambar Ekstrakurikuler
                </label>


                @if($ekstrakurikuler->gambar)

                    <div class="ekstra-admin-image-current">

                        <img
                            src="{{ asset(
                                'storage/' .
                                $ekstrakurikuler->gambar
                            ) }}"
                            alt="{{ $ekstrakurikuler->nama }}">

                        <span>
                            Gambar yang sedang digunakan.
                        </span>

                    </div>

                @endif


                <input
                    type="file"
                    id="gambar"
                    name="gambar"
                    accept=".jpg,.jpeg,.png,.webp">

                <small>
                    Format JPG, JPEG, PNG, atau WEBP.
                    Maksimal 5 MB.
                    @if($isEdit)
                        Kosongkan jika tidak ingin mengganti gambar.
                    @endif
                </small>

                @error('gambar')

                    <span class="ekstra-admin-error">
                        {{ $message }}
                    </span>

                @enderror

            </div>


            <!-- STATUS -->

            <div class="ekstra-admin-form-group full">

                <label class="ekstra-admin-checkbox">

                    <input
                        type="checkbox"
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

                    <span>
                        Tampilkan ekstrakurikuler ini di website
                    </span>

                </label>

            </div>

        </div>


        <!-- BUTTON -->

        <div class="ekstra-admin-form-actions">

            <a
                href="{{ route(
                    'admin.ekstrakurikuler.index'
                ) }}"
                class="ekstra-admin-secondary-button">

                <i class="fa-solid fa-arrow-left"></i>

                Kembali

            </a>


            <button
                type="submit"
                class="ekstra-admin-primary-button">

                <i class="fa-solid fa-floppy-disk"></i>

                {{ $isEdit
                    ? 'Simpan Perubahan'
                    : 'Tambah Ekstrakurikuler'
                }}

            </button>

        </div>

    </form>

</div>