@php
    $isEdit = $galeri->exists;
@endphp


@if($errors->any())

    <div class="admin-error-message">

        <i class="fa-solid fa-circle-exclamation"></i>

        <div>

            <strong>
                Data galeri belum berhasil disimpan.
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
                'admin.galeri.update',
                $galeri
            )
            : route(
                'admin.galeri.store'
            )
        }}"
        method="POST"
        enctype="multipart/form-data">

        @csrf

        @if($isEdit)
            @method('PUT')
        @endif


        <div class="gallery-admin-form-grid">

            <!-- Judul -->

            <div class="gallery-admin-form-group full">

                <label for="judul">
                    Judul Galeri
                </label>

                <input
                    type="text"
                    id="judul"
                    name="judul"
                    value="{{ old(
                        'judul',
                        $galeri->judul
                    ) }}"
                    placeholder="Contoh: Kegiatan Outing Class"
                    required>

            </div>


            <!-- Jenis -->

            <div class="gallery-admin-form-group">

                <label for="tipe">
                    Jenis Galeri
                </label>

                <select
                    id="tipe"
                    name="tipe"
                    onchange="toggleGalleryFields()"
                    required>

                    <option value="">
                        -- Pilih Jenis --
                    </option>

                    <option
                        value="foto"
                        @selected(
                            old(
                                'tipe',
                                $galeri->tipe
                            ) === 'foto'
                        )>

                        Foto

                    </option>

                    <option
                        value="video"
                        @selected(
                            old(
                                'tipe',
                                $galeri->tipe
                            ) === 'video'
                        )>

                        Video

                    </option>

                </select>

            </div>


            <!-- Urutan -->

            <div class="gallery-admin-form-group">

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
                        $galeri->urutan ?? 0
                    ) }}">

            </div>


            <!-- Deskripsi -->

            <div class="gallery-admin-form-group full">

                <label for="deskripsi">
                    Deskripsi
                </label>

                <textarea
                    id="deskripsi"
                    name="deskripsi"
                    rows="5"
                    placeholder="Tuliskan deskripsi singkat...">{{ old(
                        'deskripsi',
                        $galeri->deskripsi
                    ) }}</textarea>

            </div>


            <!-- Gambar -->

            <div
                class="gallery-admin-form-group full"
                id="galleryImageField">

                <label for="gambar">
                    Gambar / Thumbnail
                </label>


                @if($galeri->gambar)

                    <img
                        src="{{ asset(
                            'storage/' .
                            $galeri->gambar
                        ) }}"
                        class="gallery-admin-image-preview"
                        alt="{{ $galeri->judul }}">

                @endif


                <input
                    type="file"
                    id="gambar"
                    name="gambar"
                    accept=".jpg,.jpeg,.png,.webp">

                <small>
                    Untuk foto, gambar wajib diunggah.
                    Untuk video, gambar digunakan sebagai thumbnail.
                    Maksimal 5 MB.
                </small>

            </div>


            <!-- Video -->

            <div
                class="gallery-admin-form-group full"
                id="galleryVideoField">

                <label for="video_url">
                    Link Video YouTube
                </label>

                <input
                    type="url"
                    id="video_url"
                    name="video_url"
                    value="{{ old(
                        'video_url',
                        $galeri->video_url
                    ) }}"
                    placeholder="https://www.youtube.com/watch?v=...">

                <small>
                    Masukkan URL YouTube atau YouTube Shorts.
                </small>

            </div>


            <!-- Status -->

            <div class="gallery-admin-form-group full">

                <label class="gallery-admin-checkbox">

                    <input
                        type="checkbox"
                        name="aktif"
                        value="1"
                        @checked(
                            old(
                                'aktif',
                                $galeri->exists
                                    ? $galeri->aktif
                                    : true
                            )
                        )>

                    <span>
                        Tampilkan galeri ini di website
                    </span>

                </label>

            </div>

        </div>


        <div class="gallery-admin-form-actions">

            <a
                href="{{ route(
                    'admin.galeri.index'
                ) }}"
                class="gallery-admin-secondary-button">

                <i class="fa-solid fa-arrow-left"></i>

                Kembali

            </a>


            <button
                type="submit"
                class="gallery-admin-primary-button">

                <i class="fa-solid fa-floppy-disk"></i>

                {{ $isEdit
                    ? 'Simpan Perubahan'
                    : 'Tambah Galeri'
                }}

            </button>

        </div>

    </form>

</div>


<script>

    function toggleGalleryFields() {

        const type =
            document.getElementById('tipe').value;

        const videoField =
            document.getElementById(
                'galleryVideoField'
            );

        if (type === 'video') {

            videoField.style.display = 'flex';

        } else {

            videoField.style.display = 'none';

        }

    }

    document.addEventListener(
        'DOMContentLoaded',
        toggleGalleryFields
    );

</script>