@php
    $isEdit = $berita->exists;
@endphp


@if($errors->any())

    <div class="admin-error-message">

        <i class="fa-solid fa-circle-exclamation"></i>

        <div>

            <strong>
                Data berita belum berhasil disimpan.
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

    <form action="{{ $isEdit
            ? route('admin.berita.update', $berita)
            : route('admin.berita.store')
        }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf

        @if($isEdit)
            @method('PUT')
        @endif


        <div class="news-admin-form-grid">

            <div class="news-admin-form-group full">

                <label for="judul">
                    Judul Berita
                </label>

                <input type="text"
                       id="judul"
                       name="judul"
                       value="{{ old('judul', $berita->judul) }}"
                       placeholder="Masukkan judul berita"
                       required>

                @error('judul')
                    <span class="news-admin-error">
                        {{ $message }}
                    </span>
                @enderror

            </div>


            <div class="news-admin-form-group">

                <label for="kategori">
                    Kategori
                </label>

                <input type="text"
                       id="kategori"
                       name="kategori"
                       value="{{ old(
                           'kategori',
                           $berita->kategori
                               ?: 'Berita Sekolah'
                       ) }}"
                       placeholder="Berita Sekolah"
                       required>

            </div>


            <div class="news-admin-form-group">

                <label for="tanggal">
                    Tanggal Berita
                </label>

                <input type="date"
                       id="tanggal"
                       name="tanggal"
                       value="{{ old(
                           'tanggal',
                           $berita->tanggal
                               ? $berita->tanggal->format('Y-m-d')
                               : now()->format('Y-m-d')
                       ) }}"
                       required>

            </div>


            <div class="news-admin-form-group full">

                <label for="ringkasan">
                    Ringkasan
                </label>

                <textarea id="ringkasan"
                          name="ringkasan"
                          rows="3"
                          maxlength="500"
                          placeholder="Ringkasan singkat berita">{{ old(
                              'ringkasan',
                              $berita->ringkasan
                          ) }}</textarea>

            </div>


            <div class="news-admin-form-group full">

                <label for="isi">
                    Isi Berita
                </label>

                <textarea id="isi"
                          name="isi"
                          rows="12"
                          placeholder="Tuliskan isi berita secara lengkap"
                          required>{{ old(
                              'isi',
                              $berita->isi
                          ) }}</textarea>

                @error('isi')
                    <span class="news-admin-error">
                        {{ $message }}
                    </span>
                @enderror

            </div>


            <div class="news-admin-form-group">

                <label for="penulis">
                    Penulis
                </label>

                <input type="text"
                       id="penulis"
                       name="penulis"
                       value="{{ old(
                           'penulis',
                           $berita->penulis
                       ) }}"
                       placeholder="Contoh: Admin Sekolah">

            </div>


            <div class="news-admin-form-group">

                <label for="gambar">
                    Gambar Berita
                </label>

                @if($berita->gambar)

                    <img src="{{ asset(
                            'storage/' .
                            $berita->gambar
                        ) }}"
                         class="news-admin-image-preview"
                         alt="{{ $berita->judul }}">

                @endif

                <input type="file"
                       id="gambar"
                       name="gambar"
                       accept=".jpg,.jpeg,.png,.webp">

                <small>
                    Maksimal 5 MB. Kosongkan jika tidak mengganti gambar.
                </small>

            </div>


            <div class="news-admin-form-group full">

                <label class="news-admin-checkbox">

                    <input type="checkbox"
                           name="aktif"
                           value="1"
                           @checked(old(
                               'aktif',
                               $berita->exists
                                   ? $berita->aktif
                                   : true
                           ))>

                    <span>
                        Tampilkan berita pada website
                    </span>

                </label>


                <label class="news-admin-checkbox">

                    <input type="checkbox"
                           name="unggulan"
                           value="1"
                           @checked(old(
                               'unggulan',
                               $berita->unggulan
                           ))>

                    <span>
                        Jadikan sebagai berita utama
                    </span>

                </label>

                <small>
                    Hanya satu berita yang dapat menjadi berita utama.
                </small>

            </div>

        </div>


        <div class="news-admin-form-actions">

            <a href="{{ route('admin.berita.index') }}"
               class="news-admin-secondary-button">

                <i class="fa-solid fa-arrow-left"></i>

                Kembali

            </a>

            <button type="submit"
                    class="news-admin-primary-button">

                <i class="fa-solid fa-floppy-disk"></i>

                {{ $isEdit
                    ? 'Simpan Perubahan'
                    : 'Tambah Berita'
                }}

            </button>

        </div>

    </form>

</div>