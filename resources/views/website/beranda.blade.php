@extends('layouts.website')

@section('content')

@php
    /*
    |--------------------------------------------------------------------------
    | DATA BAWAAN
    |--------------------------------------------------------------------------
    | Data ini akan digunakan jika admin belum mengisi database.
    */

    $defaultMisi = [
        'Menyelenggarakan pendidikan yang terintegrasi dengan nilai-nilai Al-Islam dan Kemuhammadiyahan dalam seluruh aspek pembelajaran dan kehidupan sekolah.',

        'Mengembangkan karakter siswa yang unggul, berkemajuan, dan berakhlak mulia melalui pembiasaan ibadah, kegiatan keagamaan, serta keteladanan dalam keseharian.',

        'Mendorong budaya belajar yang aktif, kreatif, inovatif, dan kolaboratif guna menumbuhkan semangat belajar sepanjang hayat melalui pembelajaran mendalam.',

        'Menanamkan kepedulian cinta lingkungan hidup melalui pendidikan dengan praktik nyata yang berkelanjutan dan ramah lingkungan.',

        'Mempersiapkan lulusan yang mampu bersaing di tingkat global dengan penguasaan literasi digital dan keterampilan abad ke-21.',

        'Mewujudkan lingkungan belajar yang inklusif dan ramah anak dengan menjunjung tinggi kesetaraan, keberagaman, serta menghargai potensi unik setiap siswa.',

        'Membangun kemitraan strategis dengan orang tua, masyarakat, dan lembaga lain untuk mendukung peningkatan mutu pendidikan secara berkelanjutan.',
    ];


    /*
    |--------------------------------------------------------------------------
    | MISI DARI DATABASE
    |--------------------------------------------------------------------------
    */

    if (!empty($beranda?->misi)) {

        $daftarMisi = preg_split(
            '/\r\n|\r|\n/',
            $beranda->misi
        );

        $daftarMisi = array_filter(
            $daftarMisi,
            fn ($item) => trim($item) !== ''
        );

    } else {

        $daftarMisi = $defaultMisi;

    }


    /*
    |--------------------------------------------------------------------------
    | VIDEO YOUTUBE
    |--------------------------------------------------------------------------
    */

    $videoEmbed = null;

    if (!empty($beranda?->video_url)) {

        $videoUrl = $beranda->video_url;

        // Jika sudah menggunakan embed
        if (str_contains($videoUrl, 'youtube.com/embed/')) {

            $videoEmbed = $videoUrl;

        }

        // Link YouTube biasa, youtu.be, shorts
        elseif (
            preg_match(
                '~(?:youtube\.com/(?:watch\?v=|shorts/)|youtu\.be/)([A-Za-z0-9_-]+)~',
                $videoUrl,
                $hasilVideo
            )
        ) {

            $videoEmbed = 'https://www.youtube.com/embed/' . $hasilVideo[1];

        }

    }


    /*
    |--------------------------------------------------------------------------
    | SAMBUTAN KEPALA SEKOLAH
    |--------------------------------------------------------------------------
    */

    $defaultSambutan = [
        'Selamat datang di website resmi SD Muhammadiyah 16 Karangasem Surakarta. Puji syukur kehadirat Allah SWT, akhirnya SD Muhammadiyah 16 Karangasem memiliki rumah digital sebagai jembatan informasi antara sekolah, guru, siswa, orang tua dan masyarakat luas.',

        'Website ini kami hadirkan sebagai wujud transparansi dan komitmen kami dalam memberikan layanan pendidikan terbaik. Melalui website ini, kita akan berbagi cerita tentang kegiatan belajar, prestasi siswa, dan program-program unggulan dari SD Muhammadiyah 16 Karangasem.',

        'Komitmen kami adalah mendidik dengan hati, melayani dengan ikhlas dan berprestasi dengan karya. Kami mengajak seluruh orang tua dan masyarakat luas untuk bersama-sama mewujudkan sekolah yang nyaman, aman, serta melahirkan berbagai prestasi yang membanggakan. Terima kasih kepada masyarakat luas yang telah memberikan kepercayaan kepada kami, SD Muhammadiyah 16 Karangasem, Sekolah Unggul dan Berkemajuan.',
    ];


    if (!empty($beranda?->kepsek_sambutan)) {

        $sambutanKepsek = preg_split(
            '/\r\n\r\n|\r\r|\n\n/',
            $beranda->kepsek_sambutan
        );

        $sambutanKepsek = array_filter(
            $sambutanKepsek,
            fn ($item) => trim($item) !== ''
        );

    } else {

        $sambutanKepsek = $defaultSambutan;

    }

@endphp


{{-- ============================================================
    HERO / HALAMAN UTAMA
============================================================ --}}

<section class="hero">

    {{-- Background Gedung --}}
    <img
        src="{{
            $beranda?->hero_background
                ? asset('storage/' . $beranda->hero_background)
                : asset('images/FotoHalamanSekolah.jpeg')
        }}"
        class="hero-bg"
        alt="SD Muhammadiyah 16 Karangasem Surakarta"
    >


    {{-- Overlay --}}
    <div class="hero-overlay">

        <div class="hero-content">


            {{-- ================= KIRI ================= --}}

            <div class="hero-text">

                <h1>
                    {{
                        $beranda?->hero_judul
                        ?? 'Selamat Datang di'
                    }}
                </h1>


                <h2>
                    {{
                        $beranda?->hero_nama_sekolah
                        ?? 'SD Muhammadiyah 16 Karangasem Surakarta'
                    }}
                </h2>


                <p>
                    "{{
                        $beranda?->hero_tagline
                        ?? 'Bersih, Religius, Inovatif, Gigih, Humanis, Talenta'
                    }}"
                </p>

            </div>


            {{-- ================= KANAN ================= --}}

            <div class="hero-image">

                <img
                    src="{{
                        $beranda?->hero_image
                            ? asset('storage/' . $beranda->hero_image)
                            : asset('images/fotosiswa.png')
                    }}"
                    alt="Siswa SD Muhammadiyah 16 Karangasem"
                >

            </div>


        </div>

    </div>

</section>



{{-- ============================================================
    VISI MISI
============================================================ --}}

<section class="visi-misi">

    <div class="visi-container">


        {{-- ================= FOTO SISWA ================= --}}

        <div class="visi-image">

            <img
                src="{{
                    $beranda?->visi_image
                        ? asset('storage/' . $beranda->visi_image)
                        : asset('images/siswa-visi.png')
                }}"
                alt="Siswa SD Muhammadiyah"
            >


            <div class="image-caption">

                <h3>
                    {{
                        $beranda?->visi_caption
                        ?? 'Membangun Generasi Islami'
                    }}
                </h3>


                <p>
                    {{
                        $beranda?->visi_tagline
                        ?? 'Bersih • Religius • Inovatif • Gigih • Humanis • Talenta'
                    }}
                </p>

            </div>

        </div>



        {{-- ================= KONTEN ================= --}}

        <div class="visi-content">


            {{-- ================= VISI ================= --}}

            <div class="visi-box drop-animation">

                <h2>

                    <i class="fa-solid fa-eye"></i>

                    Visi Sekolah

                </h2>


                <p>
                    {{
                        $beranda?->visi
                        ?? 'Terwujudnya Pendidikan Dasar berbasis Al-Islam dan Kemuhammadiyahan, mencetak lulusan yang berkemajuan, cinta lingkungan, pembelajar sepanjang hayat, berdaya saing global, dan inklusif.'
                    }}
                </p>

            </div>



            {{-- ================= MISI ================= --}}

            <div class="misi-box drop-animation">

                <h2>

                    <i class="fa-solid fa-bullseye"></i>

                    Misi Sekolah

                </h2>


                <ol>

                    @foreach($daftarMisi as $misi)

                        <li>
                            {{ trim($misi) }}
                        </li>

                    @endforeach

                </ol>

            </div>


        </div>

    </div>

</section>



{{-- ============================================================
    SAMBUTAN KEPALA SEKOLAH
============================================================ --}}

<section class="kepsek">

    <div class="kepsek-container">


        <h2 class="kepsek-title">
            Sambutan Kepala Sekolah
        </h2>



        {{-- ================= FOTO KEPALA SEKOLAH ================= --}}

        <div class="kepsek-foto">

            <img
                src="{{
                    $beranda?->kepsek_foto
                        ? asset('storage/' . $beranda->kepsek_foto)
                        : asset('images/fotokepsek.jpeg')
                }}"
                alt="Kepala SD Muhammadiyah 16 Karangasem"
            >


            <h3>
                {{
                    $beranda?->kepsek_nama
                    ?? "Maghfirotun Na'imah, S.Pd."
                }}
            </h3>


            <span>
                {{
                    $beranda?->kepsek_jabatan
                    ?? 'Kepala SD Muhammadiyah 16 Karangasem'
                }}
            </span>

        </div>



        {{-- ================= ISI SAMBUTAN ================= --}}

        <div class="kepsek-content">

            <i class="fa-solid fa-quote-left quote-icon"></i>


            <h3>
                {{
                    $beranda?->kepsek_pembuka
                    ?? "Assalamu'alaikum Wr. Wb."
                }}
            </h3>


            @foreach($sambutanKepsek as $paragraf)

                <p>
                    {{ trim($paragraf) }}
                </p>

            @endforeach


            <h3>
                {{
                    $beranda?->kepsek_penutup
                    ?? "Wassalamu'alaikum Wr. Wb."
                }}
            </h3>

        </div>


    </div>

</section>



{{-- ============================================================
    VIDEO PROFIL SEKOLAH
============================================================ --}}

<section class="profil-video">

    <div class="profil-video-container">


        {{-- ================= JUDUL ================= --}}

        <div class="profil-video-header">

            <h2>
                {{
                    $beranda?->video_judul
                    ?? 'Profil Sekolah'
                }}
            </h2>


            <p>
                {{
                    $beranda?->video_deskripsi
                    ?? 'Kenali lebih dekat SD Muhammadiyah 16 Karangasem Surakarta melalui video profil sekolah.'
                }}
            </p>

        </div>



        {{-- ================= VIDEO ================= --}}

        @if($videoEmbed)

            <div class="video-wrapper">

                <iframe
                    src="{{ $videoEmbed }}"
                    title="Video Profil SD Muhammadiyah 16 Karangasem"
                    loading="lazy"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen>
                </iframe>

            </div>

        @else

            {{-- Jika admin belum memasukkan video --}}

            <div class="video-empty">

                <i class="fa-solid fa-video"></i>

                <p>
                    Video profil sekolah belum tersedia.
                </p>

            </div>

        @endif


    </div>

</section>


@endsection