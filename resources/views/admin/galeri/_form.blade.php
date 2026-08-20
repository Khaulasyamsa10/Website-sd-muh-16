@if ($errors->any())

    <div class="admin-alert admin-alert-danger">

        <ul>

            @foreach ($errors->all() as $error)

                <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

@endif


@if(isset($galeri) && $galeri->exists)

    <form
        action="{{ route('admin.galeri.update', $galeri) }}"
        method="POST"
        enctype="multipart/form-data"
        class="admin-form"
    >

        @csrf
        @method('PUT')

@else

    <form
        action="{{ route('admin.galeri.store') }}"
        method="POST"
        enctype="multipart/form-data"
        class="admin-form"
    >

        @csrf

@endif


    <!-- ================= JUDUL ================= -->

    <div class="form-group">

        <label for="judul">
            Judul Galeri
        </label>

        <input
            type="text"
            id="judul"
            name="judul"
            value="{{ old('judul', $galeri->judul ?? '') }}"
            required
        >

    </div>


    <!-- ================= TIPE ================= -->

    <div class="form-group">

        <label for="tipe">
            Jenis Galeri
        </label>

        <select
            id="tipe"
            name="tipe"
            required
        >

            <option value="">
                -- Pilih Jenis --
            </option>

            <option
                value="foto"
                {{ old('tipe', $galeri->tipe ?? '') === 'foto' ? 'selected' : '' }}
            >
                Foto
            </option>

            <option
                value="video"
                {{ old('tipe', $galeri->tipe ?? '') === 'video' ? 'selected' : '' }}
            >
                Video
            </option>

        </select>

    </div>


    <!-- ================= DESKRIPSI ================= -->

    <div class="form-group">

        <label for="deskripsi">
            Deskripsi
        </label>

        <textarea
            id="deskripsi"
            name="deskripsi"
            rows="5"
        >{{ old('deskripsi', $galeri->deskripsi ?? '') }}</textarea>

    </div>


    <!-- ================= GAMBAR ================= -->

    <div class="form-group">

        <label for="gambar">
            Gambar / Thumbnail
        </label>

        <input
            type="file"
            id="gambar"
            name="gambar"
            accept="image/jpeg,image/png,image/webp"
        >

        <small>
            Untuk galeri foto, gambar wajib diunggah.
            Untuk video, gambar digunakan sebagai thumbnail.
        </small>


        @if(!empty($galeri->gambar))

            <div style="margin-top:15px;">

                <p>Gambar saat ini:</p>

                <img
                    src="{{ asset('storage/' . $galeri->gambar) }}"
                    alt="{{ $galeri->judul }}"
                    style="
                        max-width:300px;
                        border-radius:12px;
                    "
                >

            </div>

        @endif

    </div>


    <!-- ================= VIDEO FILE ================= -->

    <div class="form-group">

        <label for="video_file">
            Upload Video
        </label>

        <input
            type="file"
            id="video_file"
            name="video_file"
            accept="video/mp4,video/webm,video/quicktime,video/x-m4v"
        >

        <small>
            Bisa upload MP4, MOV, WEBM, atau M4V.
            Maksimal 100 MB.
        </small>


        @if(!empty($galeri->video_file))

            <div style="margin-top:15px;">

                <p>Video saat ini:</p>

                <video
                    controls
                    style="
                        width:100%;
                        max-width:500px;
                        border-radius:12px;
                    "
                >

                    <source
                        src="{{ asset('storage/' . $galeri->video_file) }}"
                    >

                </video>

            </div>

        @endif

    </div>


    <!-- ================= YOUTUBE ================= -->

    <div class="form-group">

        <label for="video_url">
            Link YouTube
        </label>

        <input
            type="url"
            id="video_url"
            name="video_url"
            value="{{ old('video_url', $galeri->video_url ?? '') }}"
            placeholder="https://www.youtube.com/watch?v=..."
        >

        <small>
            Opsional. Isi jika tidak mengupload video langsung.
        </small>

    </div>


    <!-- ================= URUTAN ================= -->

    <div class="form-group">

        <label for="urutan">
            Urutan
        </label>

        <input
            type="number"
            id="urutan"
            name="urutan"
            min="0"
            value="{{ old('urutan', $galeri->urutan ?? 0) }}"
        >

    </div>


    <!-- ================= AKTIF ================= -->

    <div class="form-group">

        <label>

            <input
                type="checkbox"
                name="aktif"
                value="1"

                {{
                    old(
                        'aktif',
                        isset($galeri)
                            ? $galeri->aktif
                            : true
                    )
                    ? 'checked'
                    : ''
                }}
            >

            Tampilkan di website

        </label>

    </div>


    <!-- ================= BUTTON ================= -->

    <div class="form-actions">

        <button
            type="submit"
            class="btn-primary"
        >

            <i class="fa-solid fa-floppy-disk"></i>

            {{ isset($galeri) && $galeri->exists
                ? 'Simpan Perubahan'
                : 'Tambah Galeri'
            }}

        </button>


        <a
            href="{{ route('admin.galeri.index') }}"
            class="btn-secondary"
        >
            Batal
        </a>

    </div>

</form>