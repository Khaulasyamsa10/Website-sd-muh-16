@extends('layouts.website')

@section('content')

<!-- ================= HERO ================= -->

<section class="prestasi-hero prestasi-hero-akademik">

    <div class="prestasi-hero-overlay">

        <span class="prestasi-hero-label">

            <i class="fa-solid fa-graduation-cap"></i>

            Prestasi Siswa

        </span>

        <h1>Prestasi Akademik</h1>

        <p>
            Prestasi siswa SD Muhammadiyah 16 Karangasem
            dalam bidang akademik.
        </p>

    </div>

</section>


<!-- ================= DAFTAR PRESTASI ================= -->

<section class="prestasi-section">

    <div class="prestasi-container">

        <div class="prestasi-section-heading">

            <div>

                <span class="prestasi-section-label akademik-label">
                    Akademik
                </span>

                <h2>Daftar Prestasi</h2>

                <p>
                    Pencapaian siswa dalam berbagai kegiatan
                    dan perlombaan akademik.
                </p>

            </div>

        </div>


        <div class="prestasi-grid">

            @forelse($prestasi as $item)

    @include('website.prestasi._card', [
        'item' => $item,
        'kategoriNama' => 'Akademik',
        'kategoriClass' => 'akademik',
        'kategoriIcon' => 'fa-solid fa-graduation-cap',
    ])

    @empty
                <div class="prestasi-empty">

                    <i class="fa-solid fa-graduation-cap"></i>

                    <h3>Belum Ada Prestasi</h3>

                    <p>
                        Data prestasi akademik belum tersedia.
                    </p>

                </div>

            @endforelse

        </div>

    </div>

</section>
@include('website.prestasi._scripts')
@endsection