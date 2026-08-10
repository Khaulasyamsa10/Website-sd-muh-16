@extends('layouts.website')

@section('content')

<section class="news-detail-hero">

    <div class="news-detail-container">

        <a href="{{ route('berita') }}"
           class="news-detail-back">

            <i class="fa-solid fa-arrow-left"></i>

            Kembali ke Berita

        </a>

        <span class="news-detail-category">
            {{ $berita->kategori }}
        </span>

        <h1>
            {{ $berita->judul }}
        </h1>

        <div class="news-detail-meta">

            <span>

                <i class="fa-regular fa-calendar"></i>

                {{ $berita->tanggal
                    ->translatedFormat('d F Y')
                }}

            </span>

            @if($berita->penulis)

                <span>

                    <i class="fa-regular fa-user"></i>

                    {{ $berita->penulis }}

                </span>

            @endif

        </div>

    </div>

</section>


<section class="news-detail-section">

    <div class="news-detail-container">

        <article class="news-detail-article">

            @if($berita->gambar)

                <img src="{{ asset(
                        'storage/' . $berita->gambar
                    ) }}"
                     class="news-detail-image"
                     alt="{{ $berita->judul }}">

            @endif


            @if($berita->ringkasan)

                <p class="news-detail-summary">
                    {{ $berita->ringkasan }}
                </p>

            @endif


            <div class="news-detail-body">

                {!! nl2br(e($berita->isi)) !!}

            </div>

        </article>


        @if($beritaLain->isNotEmpty())

            <div class="news-related">

                <div class="news-section-heading">

                    <div>
                        <span>Baca Juga</span>
                        <h2>Berita Lainnya</h2>
                    </div>

                </div>

                <div class="news-grid">

                    @foreach($beritaLain as $item)

                        <article class="news-card">

                            <a href="{{ route(
                                    'berita.show',
                                    $item
                                ) }}"
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

                            </a>

                            <div class="news-card-content">

                                <div class="news-meta">

                                    <span>

                                        <i class="fa-regular fa-calendar"></i>

                                        {{ $item->tanggal
                                            ->translatedFormat('d F Y')
                                        }}

                                    </span>

                                </div>

                                <h3>

                                    <a href="{{ route(
                                            'berita.show',
                                            $item
                                        ) }}">

                                        {{ $item->judul }}

                                    </a>

                                </h3>

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

                    @endforeach

                </div>

            </div>

        @endif

    </div>

</section>

@endsection