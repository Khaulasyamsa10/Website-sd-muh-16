@extends('layouts.website')

@section('content')

<!-- ==================================================
     HERO BERITA
================================================== -->

<section class="news-hero">

    <div class="news-hero-content">

        <span class="news-hero-label">

            <i class="fa-solid fa-newspaper"></i>

            Informasi Sekolah

        </span>

        <h1>Berita Sekolah</h1>

        <p>
            Informasi terbaru mengenai kegiatan, prestasi,
            pengumuman, dan perkembangan
            SD Muhammadiyah 16 Karangasem.
        </p>

    </div>

</section>


<!-- ==================================================
     DAFTAR BERITA
================================================== -->

<section class="news-page-section">

    <div class="news-container">

        <!-- Pencarian -->

        <form action="{{ route('berita') }}"
              method="GET"
              class="news-search-form">

            <div class="news-search-input">

                <i class="fa-solid fa-magnifying-glass"></i>

                <input type="search"
                       name="cari"
                       value="{{ $cari }}"
                       placeholder="Cari judul atau isi berita...">

            </div>

            <button type="submit">

                <i class="fa-solid fa-magnifying-glass"></i>

                Cari Berita

            </button>

            @if($cari !== '')

                <a href="{{ route('berita') }}"
                   class="news-search-reset">

                    <i class="fa-solid fa-xmark"></i>

                    Hapus Pencarian

                </a>

            @endif

        </form>


        @if($cari !== '')

            <div class="news-search-result">

                Hasil pencarian untuk:

                <strong>
                    “{{ $cari }}”
                </strong>

            </div>

        @endif


        <!-- Berita Utama -->

        @if($beritaUtama && $cari === '')

            <article class="news-featured-card">

                <a href="{{ route(
                        'berita.show',
                        $beritaUtama
                    ) }}"
                   class="news-featured-image">

                    @if($beritaUtama->gambar)

                        <img src="{{ asset(
                                'storage/' .
                                $beritaUtama->gambar
                            ) }}"
                             alt="{{ $beritaUtama->judul }}">

                    @else

                        <div class="news-image-placeholder">

                            <i class="fa-regular fa-image"></i>

                        </div>

                    @endif

                </a>


                <div class="news-featured-content">

                    <span class="news-featured-badge">

                        <i class="fa-solid fa-star"></i>

                        Berita Utama

                    </span>

                    <div class="news-meta">

                        <span>

                            <i class="fa-regular fa-calendar"></i>

                            {{ $beritaUtama->tanggal
                                ->translatedFormat('d F Y')
                            }}

                        </span>

                        <span>

                            <i class="fa-regular fa-folder"></i>

                            {{ $beritaUtama->kategori }}

                        </span>

                    </div>

                    <h2>
                        {{ $beritaUtama->judul }}
                    </h2>

                    <p>
                        {{ $beritaUtama->ringkasan
                            ?: \Illuminate\Support\Str::limit(
                                strip_tags($beritaUtama->isi),
                                180
                            )
                        }}
                    </p>

                    <a href="{{ route(
                            'berita.show',
                            $beritaUtama
                        ) }}"
                       class="news-read-button">

                        Baca Selengkapnya

                        <i class="fa-solid fa-arrow-right"></i>

                    </a>

                </div>

            </article>

        @endif


        <div class="news-section-heading">

            <div>

                <span>Informasi Terkini</span>

                <h2>
                    {{ $cari !== ''
                        ? 'Hasil Pencarian'
                        : 'Berita Terbaru'
                    }}
                </h2>

            </div>

        </div>


        <!-- Grid Berita -->

        <div class="news-grid">

            @forelse($beritaList as $item)

                <article class="news-card">

                    <a href="{{ route('berita.show', $item) }}"
                       class="news-card-image">

                        @if($item->gambar)

                            <img src="{{ asset(
                                    'storage/' .
                                    $item->gambar
                                ) }}"
                                 alt="{{ $item->judul }}">

                        @else

                            <div class="news-image-placeholder">

                                <i class="fa-regular fa-image"></i>

                            </div>

                        @endif

                        <span class="news-category">
                            {{ $item->kategori }}
                        </span>

                    </a>


                    <div class="news-card-content">

                        <div class="news-meta">

                            <span>

                                <i class="fa-regular fa-calendar"></i>

                                {{ $item->tanggal
                                    ->translatedFormat('d F Y')
                                }}

                            </span>

                            @if($item->penulis)

                                <span>

                                    <i class="fa-regular fa-user"></i>

                                    {{ $item->penulis }}

                                </span>

                            @endif

                        </div>

                        <h3>

                            <a href="{{ route(
                                    'berita.show',
                                    $item
                                ) }}">

                                {{ $item->judul }}

                            </a>

                        </h3>

                        <p>
                            {{ $item->ringkasan
                                ?: \Illuminate\Support\Str::limit(
                                    strip_tags($item->isi),
                                    125
                                )
                            }}
                        </p>

                        <a href="{{ route(
                                'berita.show',
                                $item
                            ) }}"
                           class="news-card-link">

                            Baca Selengkapnya

                            <i class="fa-solid fa-arrow-right"></i>

                        </a>

                    </div>

                </article>

            @empty

                <div class="news-empty">

                    <i class="fa-regular fa-newspaper"></i>

                    <h3>
                        {{ $cari !== ''
                            ? 'Berita Tidak Ditemukan'
                            : 'Belum Ada Berita'
                        }}
                    </h3>

                    <p>
                        {{ $cari !== ''
                            ? 'Coba gunakan kata pencarian yang berbeda.'
                            : 'Berita sekolah belum ditambahkan melalui halaman admin.'
                        }}
                    </p>

                </div>

            @endforelse

        </div>


        <!-- Pagination -->

        @if($beritaList->hasPages())

            <div class="news-pagination">

                @if($beritaList->onFirstPage())

                    <span class="disabled">

                        <i class="fa-solid fa-arrow-left"></i>

                        Sebelumnya

                    </span>

                @else

                    <a href="{{ $beritaList->previousPageUrl() }}">

                        <i class="fa-solid fa-arrow-left"></i>

                        Sebelumnya

                    </a>

                @endif


                <span class="news-page-info">

                    Halaman {{ $beritaList->currentPage() }}
                    dari {{ $beritaList->lastPage() }}

                </span>


                @if($beritaList->hasMorePages())

                    <a href="{{ $beritaList->nextPageUrl() }}">

                        Selanjutnya

                        <i class="fa-solid fa-arrow-right"></i>

                    </a>

                @else

                    <span class="disabled">

                        Selanjutnya

                        <i class="fa-solid fa-arrow-right"></i>

                    </span>

                @endif

            </div>

        @endif

    </div>

</section>

@endsection