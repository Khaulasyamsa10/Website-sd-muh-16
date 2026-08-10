@extends('layouts.website')

@section('content')

@php
    $judulPpdb = $ppdb?->judul
        ?: 'Penerimaan Peserta Didik Baru';

    $tahunAjaran = $ppdb?->tahun_ajaran
        ?: 'Belum ditentukan';

    $jenjang = $ppdb?->jenjang
        ?: 'Sekolah Dasar';

    $statusPendaftaran = $ppdb?->status
        ? \Illuminate\Support\Str::headline($ppdb->status)
        : 'Belum dibuka';

    $kuota = $ppdb?->kuota;

    $linkPendaftaran = $ppdb?->link_pendaftaran;

    $brosurGambar = $ppdb?->brosur_gambar;

    $brosurPdf = $ppdb?->brosur_pdf;
@endphp


{{-- ==================================================
     HERO PPDB
================================================== --}}

<section class="ppdb-hero">

    <div class="ppdb-hero-overlay">

        <div class="ppdb-container">

            <div class="ppdb-hero-content">

                <span class="ppdb-hero-label">

                    <i class="fa-solid fa-user-graduate"></i>

                    Informasi PPDB

                </span>


                <h1>
                    {{ $judulPpdb }}
                </h1>


                <p>
                    SD Muhammadiyah 16 Karangasem
                    Tahun Ajaran {{ $tahunAjaran }}
                </p>


                <div class="ppdb-hero-actions">

                    @if($linkPendaftaran)

                        <a
                            href="{{ $linkPendaftaran }}"
                            class="ppdb-primary-button"
                            target="_blank"
                            rel="noopener noreferrer">

                            <i class="fa-solid fa-pen-to-square"></i>

                            Daftar Sekarang

                        </a>

                    @else

                        <span class="ppdb-button-disabled">

                            <i class="fa-solid fa-link"></i>

                            Pendaftaran Belum Tersedia

                        </span>

                    @endif


                    <a
                        href="#informasi-ppdb"
                        class="ppdb-outline-button">

                        <i class="fa-solid fa-circle-info"></i>

                        Lihat Informasi

                    </a>

                </div>

            </div>

        </div>

    </div>

</section>



{{-- ==================================================
     BROSUR PPDB
================================================== --}}

<section class="ppdb-brochure-section">

    <div class="ppdb-container">

        <div class="ppdb-section-heading">

            <span class="ppdb-section-label">
                Informasi Pendaftaran
            </span>

            <h2>
                Brosur PPDB
            </h2>

            <p>
                Lihat informasi lengkap mengenai pendaftaran,
                persyaratan, jadwal, dan program sekolah melalui
                brosur berikut.
            </p>

        </div>


        <div class="ppdb-brochure-card">

            @if($brosurGambar)

                <a
                    href="{{ asset('storage/' . $brosurGambar) }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="ppdb-brochure-image-link"
                    title="Klik untuk melihat brosur ukuran penuh">

                    <img
                        src="{{ asset('storage/' . $brosurGambar) }}"
                        alt="Brosur {{ $judulPpdb }}"
                        loading="lazy">

                </a>


                <div class="ppdb-brochure-hint">

                    <i class="fa-solid fa-magnifying-glass-plus"></i>

                    <span>
                        Klik brosur untuk melihat gambar ukuran penuh
                    </span>

                </div>

            @else

                <div class="ppdb-brochure-empty">

                    <i class="fa-regular fa-image"></i>

                    <h3>
                        Brosur Belum Tersedia
                    </h3>

                    <p>
                        Gambar brosur PPDB belum diunggah
                        melalui halaman admin.
                    </p>

                </div>

            @endif

        </div>

    </div>

</section>



{{-- ==================================================
     INFORMASI PPDB
================================================== --}}

<section
    class="ppdb-information-section"
    id="informasi-ppdb">

    <div class="ppdb-container">

        <div class="ppdb-section-heading">

            <span class="ppdb-section-label">
                Informasi Utama
            </span>

            <h2>
                Informasi PPDB
            </h2>

            <p>
                Informasi utama mengenai penerimaan
                peserta didik baru SD Muhammadiyah 16 Karangasem.
            </p>

        </div>


        <div class="ppdb-information-grid">


            {{-- Tahun Ajaran --}}

            <article class="ppdb-information-card">

                <div class="ppdb-information-icon">

                    <i class="fa-solid fa-calendar-days"></i>

                </div>


                <div>

                    <span>
                        Tahun Ajaran
                    </span>

                    <h3>
                        {{ $tahunAjaran }}
                    </h3>

                </div>

            </article>



            {{-- Jenjang Pendidikan --}}

            <article class="ppdb-information-card">

                <div class="ppdb-information-icon">

                    <i class="fa-solid fa-school"></i>

                </div>


                <div>

                    <span>
                        Jenjang Pendidikan
                    </span>

                    <h3>
                        {{ $jenjang }}
                    </h3>

                </div>

            </article>



            {{-- Status Pendaftaran --}}

            <article class="ppdb-information-card">

                <div class="ppdb-information-icon">

                    <i class="fa-solid fa-clipboard-check"></i>

                </div>


                <div>

                    <span>
                        Status Pendaftaran
                    </span>

                    <h3>
                        {{ $statusPendaftaran }}
                    </h3>

                </div>

            </article>



            {{-- Kuota Siswa --}}

            <article class="ppdb-information-card">

                <div class="ppdb-information-icon">

                    <i class="fa-solid fa-users"></i>

                </div>


                <div>

                    <span>
                        Kuota Siswa
                    </span>

                    <h3>

                        @if($kuota !== null)

                            {{ $kuota }} Siswa

                        @else

                            Belum ditentukan

                        @endif

                    </h3>

                </div>

            </article>

        </div>

    </div>

</section>



{{-- ==================================================
     AJAKAN PENDAFTARAN
================================================== --}}

<section class="ppdb-action-section">

    <div class="ppdb-container">

        <div class="ppdb-action-card">

            <div class="ppdb-action-content">

                <span class="ppdb-action-icon">

                    <i class="fa-solid fa-user-graduate"></i>

                </span>


                <div>

                    <h2>
                        Mari Bergabung Bersama Kami
                    </h2>

                    <p>
                        Daftarkan putra dan putri Anda menjadi bagian
                        dari keluarga besar SD Muhammadiyah 16 Karangasem.
                    </p>

                </div>

            </div>


            <div class="ppdb-action-buttons">

                {{-- Download PDF Brosur --}}

                @if($brosurPdf)

                    <a
                        href="{{ asset('storage/' . $brosurPdf) }}"
                        class="ppdb-download-button"
                        target="_blank"
                        rel="noopener noreferrer">

                        <i class="fa-solid fa-file-pdf"></i>

                        Download Brosur

                    </a>

                @else

                    <span class="ppdb-button-disabled">

                        <i class="fa-solid fa-file-pdf"></i>

                        PDF Belum Tersedia

                    </span>

                @endif


                {{-- Link Pendaftaran --}}

                @if($linkPendaftaran)

                    <a
                        href="{{ $linkPendaftaran }}"
                        class="ppdb-register-button"
                        target="_blank"
                        rel="noopener noreferrer">

                        <i class="fa-solid fa-pen-to-square"></i>

                        Daftar Sekarang

                    </a>

                @else

                    <span class="ppdb-button-disabled">

                        <i class="fa-solid fa-link"></i>

                        Link Belum Tersedia

                    </span>

                @endif

            </div>

        </div>

    </div>

</section>



{{-- ==================================================
     DATA PPDB BELUM ADA
================================================== --}}

@if(!$ppdb)

    <section class="ppdb-admin-notice">

        <div class="ppdb-container">

            <div class="ppdb-empty-database">

                <i class="fa-solid fa-circle-info"></i>


                <div>

                    <h3>
                        Data PPDB Belum Ditambahkan
                    </h3>

                    <p>
                        Halaman saat ini menggunakan informasi bawaan.
                        Silakan tambahkan informasi PPDB melalui
                        halaman admin.
                    </p>

                </div>

            </div>

        </div>

    </section>

@endif

@endsection