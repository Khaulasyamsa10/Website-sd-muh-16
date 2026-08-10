@extends('layouts.website')

@section('content')

@php
    $daftarBagian = [
        [
            'judul' => 'Ekstrakurikuler Wajib',
            'label' => 'Kegiatan Wajib',
            'subjudul' => 'Kegiatan yang wajib diikuti peserta didik sebagai bagian dari pembentukan karakter, kedisiplinan, dan kebersamaan.',
            'data' => $wajib,
            'class' => 'wajib',
            'icon' => 'fa-solid fa-star',
        ],
        [
            'judul' => 'Ekstrakurikuler Pilihan',
            'label' => 'Sesuai Minat & Bakat',
            'subjudul' => 'Peserta didik dapat memilih kegiatan sesuai dengan minat, bakat, kreativitas, dan potensi yang dimiliki.',
            'data' => $pilihan,
            'class' => 'pilihan',
            'icon' => 'fa-solid fa-palette',
        ],
        [
            'judul' => 'Bimbingan Prestasi',
            'label' => 'Pembinaan Prestasi',
            'subjudul' => 'Program pembinaan khusus untuk mengembangkan kemampuan siswa dan mempersiapkan berbagai kompetisi.',
            'data' => $bimpres,
            'class' => 'bimpres',
            'icon' => 'fa-solid fa-trophy',
        ],
    ];
@endphp


<!-- ==================================================
     HERO
================================================== -->

<section class="extra-hero">

    <div class="extra-hero-content">

        <span class="extra-hero-label">

            <i class="fa-solid fa-person-running"></i>

            Pengembangan Potensi Siswa

        </span>

        <h1>Ekstrakurikuler</h1>

        <p>
            Wadah untuk mengembangkan potensi, karakter,
            kreativitas, keterampilan, serta bakat peserta didik
            SD Muhammadiyah 16 Karangasem.
        </p>

        <a href="#daftar-ekstrakurikuler"
           class="extra-hero-button">

            <i class="fa-solid fa-arrow-down"></i>

            Lihat Kegiatan

        </a>

    </div>

</section>


<!-- ==================================================
     INFORMASI SINGKAT
================================================== -->

<section class="extra-summary-section">

    <div class="extra-container">

        <div class="extra-summary-grid">

            <article class="extra-summary-card">

                <div class="extra-summary-icon">

                    <i class="fa-solid fa-lightbulb"></i>

                </div>

                <div>

                    <strong>Mengembangkan Potensi</strong>

                    <span>
                        Membantu siswa menemukan dan mengembangkan
                        kemampuan terbaiknya.
                    </span>

                </div>

            </article>


            <article class="extra-summary-card">

                <div class="extra-summary-icon">

                    <i class="fa-solid fa-people-group"></i>

                </div>

                <div>

                    <strong>Membangun Karakter</strong>

                    <span>
                        Melatih kedisiplinan, tanggung jawab,
                        kerja sama, dan percaya diri.
                    </span>

                </div>

            </article>


            <article class="extra-summary-card">

                <div class="extra-summary-icon">

                    <i class="fa-solid fa-medal"></i>

                </div>

                <div>

                    <strong>Mendorong Prestasi</strong>

                    <span>
                        Memberikan ruang bagi siswa untuk berkembang
                        dan meraih prestasi.
                    </span>

                </div>

            </article>

        </div>

    </div>

</section>


<!-- ==================================================
     DAFTAR EKSTRAKURIKULER
================================================== -->

<div id="daftar-ekstrakurikuler">

    @foreach($daftarBagian as $index => $bagian)

        <section class="extra-section extra-section-{{ $bagian['class'] }}">

            <div class="extra-container">

                <!-- Heading -->

                <div class="extra-section-heading">

                    <div class="extra-heading-icon {{ $bagian['class'] }}">

                        <i class="{{ $bagian['icon'] }}"></i>

                    </div>

                    <span class="extra-section-label">
                        {{ $bagian['label'] }}
                    </span>

                    <h2>
                        {{ $bagian['judul'] }}
                    </h2>

                    <p>
                        {{ $bagian['subjudul'] }}
                    </p>

                </div>


                <!-- Grid -->

                <div class="extra-grid">

                    @forelse($bagian['data'] as $item)

                        <article class="extra-card">

                            <!-- Gambar -->

                            <div class="extra-card-image">

                                @if($item->gambar)

                                    <img
                                        src="{{ asset('storage/' . $item->gambar) }}"
                                        alt="{{ $item->nama }}"
                                        loading="lazy">

                                @else

                                    <div class="extra-image-placeholder">

                                        <i class="fa-regular fa-image"></i>

                                        <span>
                                            Foto belum tersedia
                                        </span>

                                    </div>

                                @endif


                                <span class="extra-card-badge {{ $bagian['class'] }}">

                                    {{ $bagian['label'] }}

                                </span>

                            </div>


                            <!-- Konten -->

                            <div class="extra-card-content">

                                <h3>
                                    {{ $item->nama }}
                                </h3>


                                <div class="extra-information">

                                    @if($item->kelas)

                                        <div class="extra-info-item">

                                            <i class="fa-solid fa-users"></i>

                                            <div>

                                                <span>Kelas</span>

                                                <strong>
                                                    {{ $item->kelas }}
                                                </strong>

                                            </div>

                                        </div>

                                    @endif


                                    @if($item->jadwal)

                                        <div class="extra-info-item">

                                            <i class="fa-regular fa-calendar"></i>

                                            <div>

                                                <span>Jadwal</span>

                                                <strong>
                                                    {{ $item->jadwal }}
                                                </strong>

                                            </div>

                                        </div>

                                    @endif

                                </div>


                                @if($item->keterangan)

                                    <p class="extra-card-description">

                                        {{ \Illuminate\Support\Str::limit(
                                            $item->keterangan,
                                            150
                                        ) }}

                                    </p>

                                @endif


                                <button type="button"
                                        class="extra-detail-button"
                                        onclick="openExtraModal(
                                            {{ Js::from($item->nama) }},
                                            {{ Js::from($item->gambar ? asset('storage/' . $item->gambar) : null) }},
                                            {{ Js::from($item->kelas) }},
                                            {{ Js::from($item->jadwal) }},
                                            {{ Js::from($item->keterangan) }},
                                            {{ Js::from($bagian['label']) }}
                                        )">

                                    Lihat Detail

                                    <i class="fa-solid fa-arrow-right"></i>

                                </button>

                            </div>

                        </article>

                    @empty

                        <div class="extra-empty">

                            <div class="extra-empty-icon">

                                <i class="{{ $bagian['icon'] }}"></i>

                            </div>

                            <h3>
                                Belum Ada Data
                            </h3>

                            <p>
                                Data {{ strtolower($bagian['judul']) }}
                                belum ditambahkan.
                            </p>

                        </div>

                    @endforelse

                </div>

            </div>

        </section>

    @endforeach

</div>


<!-- ==================================================
     CTA
================================================== -->

<section class="extra-cta-section">

    <div class="extra-container">

        <div class="extra-cta-card">

            <div class="extra-cta-icon">

                <i class="fa-solid fa-rocket"></i>

            </div>

            <div class="extra-cta-content">

                <span>
                    Ayo Berkembang Bersama
                </span>

                <h2>
                    Pilih dan Kembangkan Potensimu!
                </h2>

                <p>
                    Temukan kegiatan yang sesuai dengan minat,
                    bakat, serta potensi terbaikmu dan jadilah
                    generasi yang aktif, kreatif, dan berprestasi.
                </p>

            </div>

        </div>

    </div>

</section>


<!-- ==================================================
     MODAL DETAIL
================================================== -->

<div class="extra-modal"
     id="extraModal"
     aria-hidden="true">

    <div class="extra-modal-overlay"
         onclick="closeExtraModal()">
    </div>


    <div class="extra-modal-box">

        <button type="button"
                class="extra-modal-close"
                onclick="closeExtraModal()"
                aria-label="Tutup">

            <i class="fa-solid fa-xmark"></i>

        </button>


        <div class="extra-modal-image"
             id="extraModalImageWrapper">

            <img id="extraModalImage"
                 src=""
                 alt="">

        </div>


        <div class="extra-modal-content">

            <span class="extra-modal-category"
                  id="extraModalCategory">
            </span>

            <h2 id="extraModalTitle"></h2>


            <div class="extra-modal-information">

                <div id="extraModalClassWrapper">

                    <i class="fa-solid fa-users"></i>

                    <div>

                        <span>Kelas</span>

                        <strong id="extraModalClass"></strong>

                    </div>

                </div>


                <div id="extraModalScheduleWrapper">

                    <i class="fa-regular fa-calendar"></i>

                    <div>

                        <span>Jadwal</span>

                        <strong id="extraModalSchedule"></strong>

                    </div>

                </div>

            </div>


            <div class="extra-modal-description">

                <h3>Tentang Kegiatan</h3>

                <p id="extraModalDescription"></p>

            </div>

        </div>

    </div>

</div>


<script>
    function openExtraModal(
        nama,
        gambar,
        kelas,
        jadwal,
        keterangan,
        kategori
    ) {
        const modal = document.getElementById('extraModal');

        const imageWrapper = document.getElementById(
            'extraModalImageWrapper'
        );

        const image = document.getElementById(
            'extraModalImage'
        );

        const classWrapper = document.getElementById(
            'extraModalClassWrapper'
        );

        const scheduleWrapper = document.getElementById(
            'extraModalScheduleWrapper'
        );


        document.getElementById(
            'extraModalTitle'
        ).textContent = nama || 'Ekstrakurikuler';


        document.getElementById(
            'extraModalCategory'
        ).textContent = kategori || 'Ekstrakurikuler';


        if (gambar) {

            image.src = gambar;
            image.alt = nama || 'Ekstrakurikuler';

            imageWrapper.style.display = 'block';

        } else {

            image.src = '';

            imageWrapper.style.display = 'none';

        }


        if (kelas) {

            document.getElementById(
                'extraModalClass'
            ).textContent = kelas;

            classWrapper.style.display = 'flex';

        } else {

            classWrapper.style.display = 'none';

        }


        if (jadwal) {

            document.getElementById(
                'extraModalSchedule'
            ).textContent = jadwal;

            scheduleWrapper.style.display = 'flex';

        } else {

            scheduleWrapper.style.display = 'none';

        }


        document.getElementById(
            'extraModalDescription'
        ).textContent =
            keterangan ||
            'Informasi kegiatan belum tersedia.';


        modal.classList.add('show');

        modal.setAttribute(
            'aria-hidden',
            'false'
        );

        document.body.classList.add(
            'extra-modal-open'
        );
    }


    function closeExtraModal() {

        const modal = document.getElementById(
            'extraModal'
        );

        modal.classList.remove('show');

        modal.setAttribute(
            'aria-hidden',
            'true'
        );

        document.body.classList.remove(
            'extra-modal-open'
        );
    }


    document.addEventListener(
        'keydown',
        function (event) {

            if (event.key === 'Escape') {
                closeExtraModal();
            }

        }
    );
</script>

@endsection