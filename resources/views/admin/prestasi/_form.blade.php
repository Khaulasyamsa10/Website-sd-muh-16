<div class="prestasi-admin-form-grid">

    <!-- Judul -->

    <div class="prestasi-form-group prestasi-form-full">

        <label for="judul">
            Judul Prestasi <span>*</span>
        </label>

        <input type="text"
               id="judul"
               name="judul"
               value="{{ old('judul', $prestasi->judul ?? '') }}"
               placeholder="Contoh: Juara 1 Olimpiade Matematika"
               required>

        @error('judul')
            <small class="prestasi-form-error">
                {{ $message }}
            </small>
        @enderror

    </div>


    <!-- Kategori -->

    <div class="prestasi-form-group">

        <label for="kategori">
            Kategori <span>*</span>
        </label>

        <select id="kategori"
                name="kategori"
                required>

            <option value="">
                Pilih kategori prestasi
            </option>

            <option value="akademik"
                {{ old('kategori', $prestasi->kategori ?? '') === 'akademik'
                    ? 'selected'
                    : '' }}>

                Akademik

            </option>

            <option value="olahraga"
                {{ old('kategori', $prestasi->kategori ?? '') === 'olahraga'
                    ? 'selected'
                    : '' }}>

                Olahraga

            </option>

            <option value="keislaman"
                {{ old('kategori', $prestasi->kategori ?? '') === 'keislaman'
                    ? 'selected'
                    : '' }}>

                Keislaman

            </option>

            <option value="seni"
                {{ old('kategori', $prestasi->kategori ?? '') === 'seni'
                    ? 'selected'
                    : '' }}>

                Seni

            </option>

        </select>

        @error('kategori')
            <small class="prestasi-form-error">
                {{ $message }}
            </small>
        @enderror

    </div>


    <!-- Nama peserta -->

    <div class="prestasi-form-group">

        <label for="nama_peserta">
            Nama Peserta
        </label>

        <input type="text"
               id="nama_peserta"
               name="nama_peserta"
               value="{{ old(
                    'nama_peserta',
                    $prestasi->nama_peserta ?? ''
               ) }}"
               placeholder="Contoh: Ahmad Fulan">

        @error('nama_peserta')
            <small class="prestasi-form-error">
                {{ $message }}
            </small>
        @enderror

    </div>


    <!-- Kelas -->

    <div class="prestasi-form-group">

        <label for="kelas">
            Kelas
        </label>

        <input type="text"
               id="kelas"
               name="kelas"
               value="{{ old('kelas', $prestasi->kelas ?? '') }}"
               placeholder="Contoh: 5A">

        @error('kelas')
            <small class="prestasi-form-error">
                {{ $message }}
            </small>
        @enderror

    </div>


    <!-- Peringkat -->

    <div class="prestasi-form-group">

        <label for="peringkat">
            Peringkat
        </label>

        <input type="text"
               id="peringkat"
               name="peringkat"
               value="{{ old(
                    'peringkat',
                    $prestasi->peringkat ?? ''
               ) }}"
               placeholder="Contoh: Juara 1">

        @error('peringkat')
            <small class="prestasi-form-error">
                {{ $message }}
            </small>
        @enderror

    </div>


    <!-- Tingkat -->

    <div class="prestasi-form-group">

        <label for="tingkat">
            Tingkat Perlombaan
        </label>

        <input type="text"
               id="tingkat"
               name="tingkat"
               value="{{ old(
                    'tingkat',
                    $prestasi->tingkat ?? ''
               ) }}"
               placeholder="Contoh: Kecamatan, Kota, Provinsi">

        @error('tingkat')
            <small class="prestasi-form-error">
                {{ $message }}
            </small>
        @enderror

    </div>


    <!-- Tanggal -->

    <div class="prestasi-form-group">

        <label for="tanggal">
            Tanggal Prestasi
        </label>

        <input type="date"
               id="tanggal"
               name="tanggal"
               value="{{ old(
                    'tanggal',
                    isset($prestasi) && $prestasi->tanggal
                        ? $prestasi->tanggal->format('Y-m-d')
                        : ''
               ) }}">

        @error('tanggal')
            <small class="prestasi-form-error">
                {{ $message }}
            </small>
        @enderror

    </div>


    <!-- Urutan -->

    <div class="prestasi-form-group">

        <label for="urutan">
            Urutan Tampilan
        </label>

        <input type="number"
               id="urutan"
               name="urutan"
               min="0"
               value="{{ old(
                    'urutan',
                    $prestasi->urutan ?? 0
               ) }}">

        <small class="prestasi-form-help">
            Angka lebih kecil akan tampil lebih dahulu.
        </small>

        @error('urutan')
            <small class="prestasi-form-error">
                {{ $message }}
            </small>
        @enderror

    </div>


    <!-- Foto -->

    <div class="prestasi-form-group prestasi-form-full">

        <label for="gambar">
            Foto Prestasi
        </label>

        @if(isset($prestasi) && $prestasi->gambar)

            <div class="prestasi-current-image">

                <img src="{{ asset('storage/' . $prestasi->gambar) }}"
                     alt="{{ $prestasi->judul }}">

                <span>Foto yang sedang digunakan</span>

            </div>

        @endif

        <input type="file"
               id="gambar"
               name="gambar"
               accept=".jpg,.jpeg,.png,.webp">

        <small class="prestasi-form-help">
            Format JPG, JPEG, PNG, atau WEBP. Maksimal 4 MB.
        </small>

        @error('gambar')
            <small class="prestasi-form-error">
                {{ $message }}
            </small>
        @enderror

    </div>


    <!-- Deskripsi -->

    <div class="prestasi-form-group prestasi-form-full">

        <label for="deskripsi">
            Deskripsi Prestasi
        </label>

        <textarea id="deskripsi"
                  name="deskripsi"
                  rows="6"
                  placeholder="Tuliskan informasi lengkap mengenai prestasi...">{{ old(
                    'deskripsi',
                    $prestasi->deskripsi ?? ''
                  ) }}</textarea>

        @error('deskripsi')
            <small class="prestasi-form-error">
                {{ $message }}
            </small>
        @enderror

    </div>


    <!-- Status -->

    <div class="prestasi-form-group prestasi-form-full">

        <label>Status Tampilan</label>

        <input type="hidden"
               name="aktif"
               value="0">

        <label class="prestasi-status-checkbox">

            <input type="checkbox"
                   name="aktif"
                   value="1"
                   {{ old(
                        'aktif',
                        isset($prestasi)
                            ? $prestasi->aktif
                            : true
                   ) ? 'checked' : '' }}>

            <span class="prestasi-checkbox-box">
                <i class="fa-solid fa-check"></i>
            </span>

            <span class="prestasi-checkbox-text">

                <strong>Tampilkan di website</strong>

                <small>
                    Nonaktifkan apabila data belum siap ditampilkan.
                </small>

            </span>

        </label>

        @error('aktif')
            <small class="prestasi-form-error">
                {{ $message }}
            </small>
        @enderror

    </div>

</div>