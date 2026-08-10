@extends('layouts.website')

@section('content')

<!-- ================= HEADER ================= -->

<section class="agenda-header">

    <div class="agenda-overlay">

        <div class="agenda-header-content">

            <span class="agenda-label">
                Agenda Sekolah
            </span>

            <h1>Agenda & Kegiatan Terbaru</h1>

            <p>
                Informasi kegiatan SD Muhammadiyah 16 Karangasem.
                Klik tombol <strong>Selengkapnya</strong> untuk melihat
                informasi lengkap.
            </p>

        </div>

    </div>

</section>


<!-- ================= LIST AGENDA ================= -->

<section class="agenda-section">

    <div class="agenda-container">

        <div class="agenda-section-heading">

            <div class="agenda-heading-left">

                <div class="agenda-heading-icon">
                    <i class="fa-solid fa-calendar-days"></i>
                </div>

                <div>
                    <h2>Agenda Terbaru</h2>

                    <p>
                        Informasi kegiatan, peringatan, dan pengumuman sekolah.
                    </p>
                </div>

            </div>

        </div>


        <div class="agenda-grid">

            @forelse($agenda as $item)

                <article
                    class="agenda-card-modern"
                    id="agenda-{{ $item->id }}">

                    <!-- ================= GAMBAR ================= -->

                    <div class="agenda-card-image">

                        @if($item->gambar)

                            <img
                                src="{{ asset('storage/' . $item->gambar) }}"
                                alt="{{ $item->judul }}"
                                loading="lazy">

                        @else

                            <div class="agenda-no-image-box">

                                <i class="fa-regular fa-image"></i>

                                <span>Tidak ada gambar</span>

                            </div>

                        @endif

                        <span class="agenda-badge-top">
                            Agenda Sekolah
                        </span>

                    </div>


                    <!-- ================= ISI KARTU ================= -->

                    <div class="agenda-card-body">

                        <!-- Tanggal hanya muncul apabila diisi -->

                        @if($item->tanggal)

                            <div class="agenda-card-top">

                                <div class="agenda-date-modern">

                                    <span class="date-number">
                                        {{ $item->tanggal->format('d') }}
                                    </span>

                                    <span class="date-month">

                                        {{ strtoupper(
                                            $item->tanggal
                                                ->locale('id')
                                                ->translatedFormat('M')
                                        ) }}

                                    </span>

                                </div>


                                <div class="agenda-day-year">

                                    <h4>

                                        {{ $item->tanggal
                                            ->locale('id')
                                            ->translatedFormat('l') }}

                                    </h4>

                                    <span>

                                        <i class="fa-regular fa-calendar"></i>

                                        {{ $item->tanggal->format('Y') }}

                                    </span>

                                </div>

                            </div>

                        @else

                            <div class="agenda-card-label-only">

                                <i class="fa-solid fa-bullhorn"></i>

                                <span>
                                    Informasi atau peringatan sekolah
                                </span>

                            </div>

                        @endif


                        <!-- Judul -->

                        <h3>
                            {{ $item->judul }}
                        </h3>


                        <!-- Deskripsi singkat -->

                        <p class="agenda-short-desc">

                            {{ \Illuminate\Support\Str::limit(
                                $item->deskripsi
                                    ?: 'Belum ada deskripsi agenda.',
                                110
                            ) }}

                        </p>


                        <!-- Waktu dan lokasi hanya muncul apabila diisi -->

                        @if($item->jam_mulai || $item->lokasi)

                            <div class="agenda-meta">

                                @if($item->jam_mulai)

                                    <span>

                                        <i class="fa-regular fa-clock"></i>

                                        {{ \Carbon\Carbon::parse(
                                            $item->jam_mulai
                                        )->format('H.i') }}

                                        @if($item->jam_selesai)

                                            -

                                            {{ \Carbon\Carbon::parse(
                                                $item->jam_selesai
                                            )->format('H.i') }}

                                        @endif

                                        WIB

                                    </span>

                                @endif


                                @if($item->lokasi)

                                    <span>

                                        <i class="fa-solid fa-location-dot"></i>

                                        {{ $item->lokasi }}

                                    </span>

                                @endif

                            </div>

                        @endif


                        <!-- Tombol -->

                        <div class="agenda-card-actions">

                            <button
                                type="button"
                                class="agenda-detail-btn"
                                onclick="openAgendaModal(
                                    'agenda-modal-{{ $item->id }}'
                                )">

                                <i class="fa-regular fa-eye"></i>

                                Selengkapnya

                            </button>


                            <button
                                type="button"
                                class="agenda-share-btn"
                                onclick='bagikanAgenda(
                                    @json($item->judul),
                                    @json(
                                        url("/agenda")
                                        . "#agenda-"
                                        . $item->id
                                    )
                                )'>

                                <i class="fa-solid fa-share-nodes"></i>

                                Bagikan

                            </button>

                        </div>

                    </div>

                </article>


                <!-- ================= MODAL DETAIL ================= -->

                <div
                    class="agenda-modal"
                    id="agenda-modal-{{ $item->id }}"
                    role="dialog"
                    aria-modal="true"
                    aria-labelledby="agenda-modal-title-{{ $item->id }}">

                    <!-- Area gelap -->

                    <div
                        class="agenda-modal-overlay"
                        onclick="closeAgendaModal(
                            'agenda-modal-{{ $item->id }}'
                        )">
                    </div>


                    <!-- Kotak modal -->

                    <div class="agenda-modal-content">

                        <button
                            type="button"
                            class="agenda-modal-close"
                            onclick="closeAgendaModal(
                                'agenda-modal-{{ $item->id }}'
                            )"
                            aria-label="Tutup">

                            <i class="fa-solid fa-xmark"></i>

                        </button>


                        <div class="agenda-modal-grid">

                            <!-- Poster -->

                            <div class="agenda-modal-image">

                                @if($item->gambar)

                                    <a
                                        href="{{ asset(
                                            'storage/' . $item->gambar
                                        ) }}"
                                        target="_blank"
                                        class="agenda-modal-image-link"
                                        title="Buka gambar ukuran penuh">

                                        <img
                                            src="{{ asset(
                                                'storage/' . $item->gambar
                                            ) }}"
                                            alt="{{ $item->judul }}">

                                    </a>

                                    <small class="agenda-image-hint">

                                        <i class="fa-solid fa-magnifying-glass-plus"></i>

                                        Klik gambar untuk melihat ukuran penuh

                                    </small>

                                @else

                                    <div class="agenda-no-image-box large">

                                        <i class="fa-regular fa-image"></i>

                                        <span>
                                            Tidak ada gambar agenda
                                        </span>

                                    </div>

                                @endif

                            </div>


                            <!-- Informasi -->

                            <div class="agenda-modal-info">

                                <span class="agenda-modal-badge">
                                    Detail Agenda
                                </span>

                                <h2 id="agenda-modal-title-{{ $item->id }}">

                                    {{ $item->judul }}

                                </h2>


                                <!-- Informasi opsional -->

                                @if(
                                    $item->tanggal ||
                                    $item->jam_mulai ||
                                    $item->lokasi
                                )

                                    <div class="agenda-modal-meta">

                                        @if($item->tanggal)

                                            <div class="agenda-modal-meta-item">

                                                <i class="fa-regular fa-calendar-days"></i>

                                                <div>

                                                    <strong>Tanggal</strong>

                                                    <span>

                                                        {{ $item->tanggal
                                                            ->locale('id')
                                                            ->translatedFormat(
                                                                'l, d F Y'
                                                            ) }}

                                                    </span>

                                                </div>

                                            </div>

                                        @endif


                                        @if($item->jam_mulai)

                                            <div class="agenda-modal-meta-item">

                                                <i class="fa-regular fa-clock"></i>

                                                <div>

                                                    <strong>Waktu</strong>

                                                    <span>

                                                        {{ \Carbon\Carbon::parse(
                                                            $item->jam_mulai
                                                        )->format('H.i') }}

                                                        @if($item->jam_selesai)

                                                            -

                                                            {{ \Carbon\Carbon::parse(
                                                                $item->jam_selesai
                                                            )->format('H.i') }}

                                                        @endif

                                                        WIB

                                                    </span>

                                                </div>

                                            </div>

                                        @endif


                                        @if($item->lokasi)

                                            <div class="agenda-modal-meta-item">

                                                <i class="fa-solid fa-location-dot"></i>

                                                <div>

                                                    <strong>Lokasi</strong>

                                                    <span>
                                                        {{ $item->lokasi }}
                                                    </span>

                                                </div>

                                            </div>

                                        @endif

                                    </div>

                                @endif


                                <!-- Deskripsi -->

                                <div class="agenda-modal-description">

                                    <h4>Deskripsi Kegiatan</h4>

                                    <p>

                                        {{ $item->deskripsi
                                            ?: 'Belum ada deskripsi agenda.' }}

                                    </p>

                                </div>


                                <div class="agenda-modal-actions">

                                    <button
                                        type="button"
                                        class="agenda-modal-share-button"
                                        onclick='bagikanAgenda(
                                            @json($item->judul),
                                            @json(
                                                url("/agenda")
                                                . "#agenda-"
                                                . $item->id
                                            )
                                        )'>

                                        <i class="fa-solid fa-share-nodes"></i>

                                        Bagikan Agenda

                                    </button>


                                    <button
                                        type="button"
                                        class="agenda-modal-close-button"
                                        onclick="closeAgendaModal(
                                            'agenda-modal-{{ $item->id }}'
                                        )">

                                        Tutup

                                    </button>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            @empty

                <div class="agenda-empty-modern">

                    <i class="fa-solid fa-calendar-xmark"></i>

                    <h3>Belum Ada Agenda</h3>

                    <p>
                        Saat ini belum ada agenda yang ditampilkan.
                        Silakan tambahkan agenda melalui halaman admin.
                    </p>

                </div>

            @endforelse

        </div>

    </div>

</section>


<!-- ================= JAVASCRIPT ================= -->

<script>
    function openAgendaModal(id) {
        const modal = document.getElementById(id);

        if (!modal) {
            return;
        }

        modal.classList.add('show');
        document.body.classList.add('agenda-modal-open');
    }


    function closeAgendaModal(id) {
        const modal = document.getElementById(id);

        if (!modal) {
            return;
        }

        modal.classList.remove('show');
        document.body.classList.remove('agenda-modal-open');
    }


    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            const modalAktif = document.querySelector(
                '.agenda-modal.show'
            );

            if (modalAktif) {
                modalAktif.classList.remove('show');
                document.body.classList.remove(
                    'agenda-modal-open'
                );
            }
        }
    });


    function bagikanAgenda(judul, url) {
        if (navigator.share) {
            navigator.share({
                title: judul,
                text: 'Agenda SD Muhammadiyah 16 Karangasem',
                url: url
            }).catch(function () {
                // Pengguna membatalkan proses berbagi.
            });

            return;
        }

        if (navigator.clipboard) {
            navigator.clipboard.writeText(url)
                .then(function () {
                    alert('Link agenda berhasil disalin.');
                });

            return;
        }

        alert(url);
    }
</script>

@endsection