@php
    $isEdit = $ppdb->exists;

    $statusSekarang = old(
        'status',
        $ppdb->status ?: 'dibuka'
    );
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

    <form action="{{ $isEdit
            ? route('admin.ppdb.update', $ppdb)
            : route('admin.ppdb.store')
        }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf

        @if($isEdit)
            @method('PUT')
        @endif


        <div class="ppdb-admin-form-grid">

            <div class="ppdb-admin-form-group full">

                <label for="judul">
                    Judul PPDB
                </label>

                <input type="text"
                       id="judul"
                       name="judul"
                       value="{{ old('judul', $ppdb->judul) }}"
                       placeholder="Contoh: PPDB 2027"
                       required>

                @error('judul')
                    <span class="ppdb-admin-error">
                        {{ $message }}
                    </span>
                @enderror

            </div>


            <div class="ppdb-admin-form-group">

                <label for="tahun_ajaran">
                    Tahun Ajaran
                </label>

                <input type="text"
                       id="tahun_ajaran"
                       name="tahun_ajaran"
                       value="{{ old(
                           'tahun_ajaran',
                           $ppdb->tahun_ajaran
                       ) }}"
                       placeholder="Contoh: 2027-2028"
                       required>

                @error('tahun_ajaran')
                    <span class="ppdb-admin-error">
                        {{ $message }}
                    </span>
                @enderror

            </div>


            <div class="ppdb-admin-form-group">

                <label for="jenjang">
                    Jenjang Pendidikan
                </label>

                <input type="text"
                       id="jenjang"
                       name="jenjang"
                       value="{{ old(
                           'jenjang',
                           $ppdb->jenjang ?: 'Sekolah Dasar'
                       ) }}"
                       required>

            </div>


            <div class="ppdb-admin-form-group">

                <label for="status">
                    Status Pendaftaran
                </label>

                <select id="status"
                        name="status"
                        required>

                    <option value="belum dibuka"
                        @selected(
                            $statusSekarang === 'belum dibuka'
                        )>
                        Belum Dibuka
                    </option>

                    <option value="dibuka"
                        @selected(
                            $statusSekarang === 'dibuka'
                        )>
                        Dibuka
                    </option>

                    <option value="ditutup"
                        @selected(
                            $statusSekarang === 'ditutup'
                        )>
                        Ditutup
                    </option>

                </select>

            </div>


            <div class="ppdb-admin-form-group">

                <label for="kuota">
                    Kuota Siswa
                </label>

                <input type="number"
                       id="kuota"
                       name="kuota"
                       value="{{ old('kuota', $ppdb->kuota) }}"
                       min="0"
                       placeholder="Contoh: 56">

            </div>


            <div class="ppdb-admin-form-group full">

                <label for="link_pendaftaran">
                    Link Pendaftaran
                </label>

                <input type="url"
                       id="link_pendaftaran"
                       name="link_pendaftaran"
                       value="{{ old(
                           'link_pendaftaran',
                           $ppdb->link_pendaftaran
                       ) }}"
                       placeholder="https://contoh.com/formulir">

            </div>


            <div class="ppdb-admin-form-group">

                <label for="brosur_gambar">
                    Gambar Brosur
                </label>

                @if($ppdb->brosur_gambar)

                    <img src="{{ asset(
                            'storage/' .
                            $ppdb->brosur_gambar
                        ) }}"
                         class="ppdb-admin-file-preview"
                         alt="Brosur PPDB">

                @endif

                <input type="file"
                       id="brosur_gambar"
                       name="brosur_gambar"
                       accept=".jpg,.jpeg,.png,.webp">

                <small>
                    Maksimal 5 MB.
                </small>

            </div>


            <div class="ppdb-admin-form-group">

                <label for="brosur_pdf">
                    Brosur PDF
                </label>

                @if($ppdb->brosur_pdf)

                    <a href="{{ asset(
                            'storage/' .
                            $ppdb->brosur_pdf
                        ) }}"
                       target="_blank"
                       class="ppdb-admin-pdf-preview">

                        <i class="fa-solid fa-file-pdf"></i>

                        Lihat PDF saat ini

                    </a>

                @endif

                <input type="file"
                       id="brosur_pdf"
                       name="brosur_pdf"
                       accept=".pdf,application/pdf">

                <small>
                    Maksimal 10 MB.
                </small>

            </div>


            <div class="ppdb-admin-form-group full">

                <label class="ppdb-admin-checkbox">

                    <input type="checkbox"
                           name="aktif"
                           value="1"
                           @checked(
                               old('aktif', $ppdb->aktif)
                           )>

                    <span>
                        Tampilkan data ini pada halaman website
                    </span>

                </label>

                <small>
                    Saat dicentang, periode PPDB lain otomatis
                    menjadi tidak aktif.
                </small>

            </div>

        </div>


        <div class="ppdb-admin-form-actions">

            <a href="{{ route('admin.ppdb.index') }}"
               class="ppdb-admin-cancel-button">

                <i class="fa-solid fa-arrow-left"></i>

                Kembali

            </a>

            <button type="submit"
                    class="ppdb-admin-save-button">

                <i class="fa-solid fa-floppy-disk"></i>

                {{ $isEdit
                    ? 'Simpan Perubahan'
                    : 'Tambah Data PPDB'
                }}

            </button>

        </div>

    </form>

</div>