<!DOCTYPE html>

<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Kelola Beranda</title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>


<body class="admin-body">


<div class="admin-page">


    {{-- ================= HEADER ADMIN ================= --}}

    <div class="admin-topbar">

        <div>

            <h1>
                Kelola Halaman Beranda
            </h1>

            <p>
                Atur informasi yang tampil pada halaman utama website.
            </p>

        </div>


        <div class="admin-top-actions">

            <a href="{{ url('/') }}"
               target="_blank"
               class="btn-preview">

                <i class="fa-solid fa-eye"></i>

                Lihat Website

            </a>


            <a href="{{ route('dashboard') }}"
               class="btn-dashboard">

                <i class="fa-solid fa-house"></i>

                Dashboard

            </a>

        </div>

    </div>



    {{-- ================= SUCCESS ================= --}}

    @if(session('success'))

        <div class="admin-alert-success">

            <i class="fa-solid fa-circle-check"></i>

            {{ session('success') }}

        </div>

    @endif



    {{-- ================= ERROR ================= --}}

    @if($errors->any())

        <div class="admin-alert-error">

            <strong>
                Ada data yang belum benar:
            </strong>

            <ul>

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif



    {{-- ================= FORM ================= --}}

    <form
        action="{{ route('admin.beranda.update') }}"
        method="POST"
        enctype="multipart/form-data"
        class="admin-beranda-form"
    >

        @csrf

        @method('PUT')



        {{-- ==================================================
            HERO
        ================================================== --}}

        <div class="admin-card">

            <div class="admin-card-title">

                <div class="admin-card-icon">

                    <i class="fa-solid fa-image"></i>

                </div>

                <div>

                    <h2>
                        Hero / Banner
                    </h2>

                    <p>
                        Bagian paling atas halaman Beranda.
                    </p>

                </div>

            </div>


            <div class="admin-form-grid">


                <div class="admin-form-group">

                    <label>
                        Judul Sambutan
                    </label>

                    <input
                        type="text"
                        name="hero_judul"
                        value="{{ old(
                            'hero_judul',
                            $beranda?->hero_judul
                            ?? 'Selamat Datang di'
                        ) }}"
                    >

                </div>


                <div class="admin-form-group">

                    <label>
                        Nama Sekolah
                    </label>

                    <input
                        type="text"
                        name="hero_nama_sekolah"
                        value="{{ old(
                            'hero_nama_sekolah',
                            $beranda?->hero_nama_sekolah
                            ?? 'SD Muhammadiyah 16 Karangasem Surakarta'
                        ) }}"
                    >

                </div>


                <div class="admin-form-group full">

                    <label>
                        Tagline
                    </label>

                    <input
                        type="text"
                        name="hero_tagline"
                        value="{{ old(
                            'hero_tagline',
                            $beranda?->hero_tagline
                            ?? 'Bersih, Religius, Inovatif, Gigih, Humanis, Talenta'
                        ) }}"
                    >

                </div>



                {{-- Background Hero --}}

                <div class="admin-form-group">

                    <label>
                        Background Hero
                    </label>


                    @if($beranda?->hero_background)

                        <div class="admin-image-preview">

                            <img
                                src="{{ asset(
                                    'storage/'
                                    . $beranda->hero_background
                                ) }}"
                                alt="Background Hero"
                            >

                        </div>

                    @endif


                    <input
                        type="file"
                        name="hero_background"
                        accept=".jpg,.jpeg,.png,.webp"
                    >

                    <small>
                        JPG, PNG atau WEBP. Maksimal 5 MB.
                    </small>

                </div>



                {{-- Foto Siswa --}}

                <div class="admin-form-group">

                    <label>
                        Foto Siswa Hero
                    </label>


                    @if($beranda?->hero_image)

                        <div class="admin-image-preview">

                            <img
                                src="{{ asset(
                                    'storage/'
                                    . $beranda->hero_image
                                ) }}"
                                alt="Foto Hero"
                            >

                        </div>

                    @endif


                    <input
                        type="file"
                        name="hero_image"
                        accept=".jpg,.jpeg,.png,.webp"
                    >

                    <small>
                        Biarkan kosong jika tidak ingin mengganti foto.
                    </small>

                </div>


            </div>

        </div>



        {{-- ==================================================
            VISI MISI
        ================================================== --}}

        <div class="admin-card">

            <div class="admin-card-title">

                <div class="admin-card-icon">

                    <i class="fa-solid fa-bullseye"></i>

                </div>

                <div>

                    <h2>
                        Visi & Misi
                    </h2>

                    <p>
                        Kelola visi, misi dan foto pendukung.
                    </p>

                </div>

            </div>


            <div class="admin-form-grid">


                <div class="admin-form-group full">

                    <label>
                        Foto Visi Misi
                    </label>


                    @if($beranda?->visi_image)

                        <div class="admin-image-preview medium">

                            <img
                                src="{{ asset(
                                    'storage/'
                                    . $beranda->visi_image
                                ) }}"
                                alt="Foto Visi Misi"
                            >

                        </div>

                    @endif


                    <input
                        type="file"
                        name="visi_image"
                        accept=".jpg,.jpeg,.png,.webp"
                    >

                </div>



                <div class="admin-form-group">

                    <label>
                        Judul Caption
                    </label>

                    <input
                        type="text"
                        name="visi_caption"
                        value="{{ old(
                            'visi_caption',
                            $beranda?->visi_caption
                            ?? 'Membangun Generasi Islami'
                        ) }}"
                    >

                </div>



                <div class="admin-form-group">

                    <label>
                        Tagline Caption
                    </label>

                    <input
                        type="text"
                        name="visi_tagline"
                        value="{{ old(
                            'visi_tagline',
                            $beranda?->visi_tagline
                            ?? 'Bersih • Religius • Inovatif • Gigih • Humanis • Talenta'
                        ) }}"
                    >

                </div>



                <div class="admin-form-group full">

                    <label>
                        Visi Sekolah
                    </label>

                    <textarea
                        name="visi"
                        rows="6"
                    >{{ old(
                        'visi',
                        $beranda?->visi
                    ) }}</textarea>

                </div>



                <div class="admin-form-group full">

                    <label>
                        Misi Sekolah
                    </label>

                    <textarea
                        name="misi"
                        rows="12"
                        placeholder="Tulis satu misi pada setiap baris..."
                    >{{ old(
                        'misi',
                        $beranda?->misi
                    ) }}</textarea>

                    <small>

                        Satu baris akan otomatis menjadi
                        satu nomor misi.

                    </small>

                </div>


            </div>

        </div>



        {{-- ==================================================
            KEPALA SEKOLAH
        ================================================== --}}

        <div class="admin-card">

            <div class="admin-card-title">

                <div class="admin-card-icon">

                    <i class="fa-solid fa-user-tie"></i>

                </div>

                <div>

                    <h2>
                        Kepala Sekolah
                    </h2>

                    <p>
                        Atur foto, identitas dan sambutan kepala sekolah.
                    </p>

                </div>

            </div>


            <div class="admin-form-grid">


                <div class="admin-form-group full">

                    <label>
                        Foto Kepala Sekolah
                    </label>


                    @if($beranda?->kepsek_foto)

                        <div class="admin-kepsek-preview">

                            <img
                                src="{{ asset(
                                    'storage/'
                                    . $beranda->kepsek_foto
                                ) }}"
                                alt="Kepala Sekolah"
                            >

                        </div>

                    @endif


                    <input
                        type="file"
                        name="kepsek_foto"
                        accept=".jpg,.jpeg,.png,.webp"
                    >

                </div>



                <div class="admin-form-group">

                    <label>
                        Nama Kepala Sekolah
                    </label>

                    <input
                        type="text"
                        name="kepsek_nama"
                        value="{{ old(
                            'kepsek_nama',
                            $beranda?->kepsek_nama
                            ?? "Maghfirotun Na'imah, S.Pd."
                        ) }}"
                    >

                </div>



                <div class="admin-form-group">

                    <label>
                        Jabatan
                    </label>

                    <input
                        type="text"
                        name="kepsek_jabatan"
                        value="{{ old(
                            'kepsek_jabatan',
                            $beranda?->kepsek_jabatan
                            ?? 'Kepala SD Muhammadiyah 16 Karangasem'
                        ) }}"
                    >

                </div>



                <div class="admin-form-group full">

                    <label>
                        Salam Pembuka
                    </label>

                    <input
                        type="text"
                        name="kepsek_pembuka"
                        value="{{ old(
                            'kepsek_pembuka',
                            $beranda?->kepsek_pembuka
                            ?? "Assalamu'alaikum Wr. Wb."
                        ) }}"
                    >

                </div>



                <div class="admin-form-group full">

                    <label>
                        Isi Sambutan
                    </label>

                    <textarea
                        name="kepsek_sambutan"
                        rows="14"
                        placeholder="Tuliskan sambutan kepala sekolah..."
                    >{{ old(
                        'kepsek_sambutan',
                        $beranda?->kepsek_sambutan
                    ) }}</textarea>

                    <small>
                        Gunakan satu baris kosong untuk memisahkan paragraf.
                    </small>

                </div>



                <div class="admin-form-group full">

                    <label>
                        Salam Penutup
                    </label>

                    <input
                        type="text"
                        name="kepsek_penutup"
                        value="{{ old(
                            'kepsek_penutup',
                            $beranda?->kepsek_penutup
                            ?? "Wassalamu'alaikum Wr. Wb."
                        ) }}"
                    >

                </div>


            </div>

        </div>



        {{-- ==================================================
            VIDEO PROFIL
        ================================================== --}}

        <div class="admin-card">

            <div class="admin-card-title">

                <div class="admin-card-icon">

                    <i class="fa-brands fa-youtube"></i>

                </div>

                <div>

                    <h2>
                        Video Profil Sekolah
                    </h2>

                    <p>
                        Masukkan video profil sekolah dari YouTube.
                    </p>

                </div>

            </div>


            <div class="admin-form-grid">


                <div class="admin-form-group">

                    <label>
                        Judul Video
                    </label>

                    <input
                        type="text"
                        name="video_judul"
                        value="{{ old(
                            'video_judul',
                            $beranda?->video_judul
                            ?? 'Profil Sekolah'
                        ) }}"
                    >

                </div>



                <div class="admin-form-group">

                    <label>
                        URL Video YouTube
                    </label>

                    <input
                        type="text"
                        name="video_url"
                        placeholder="https://www.youtube.com/watch?v=..."
                        value="{{ old(
                            'video_url',
                            $beranda?->video_url
                        ) }}"
                    >

                </div>



                <div class="admin-form-group full">

                    <label>
                        Deskripsi Video
                    </label>

                    <textarea
                        name="video_deskripsi"
                        rows="5"
                    >{{ old(
                        'video_deskripsi',
                        $beranda?->video_deskripsi
                    ) }}</textarea>

                </div>


            </div>

        </div>



        {{-- ==================================================
            SAVE
        ================================================== --}}

        <div class="admin-save-area">

            <button
                type="submit"
                class="admin-save-btn"
            >

                <i class="fa-solid fa-floppy-disk"></i>

                Simpan Perubahan

            </button>

        </div>


    </form>


</div>


</body>

</html>