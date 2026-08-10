@extends('layouts.website')

@section('content')

<!-- ================= HERO ================= -->

<section class="prestasi-hero prestasi-hero-seni">

    <div class="prestasi-hero-overlay">

        <span class="prestasi-hero-label">

            <i class="fa-solid fa-palette"></i>

            Prestasi Siswa

        </span>

        <h1>Prestasi Seni</h1>

        <p>
            Prestasi siswa SD Muhammadiyah 16 Karangasem
            dalam bidang seni.
        </p>

    </div>

</section>


<!-- ================= DAFTAR PRESTASI ================= -->

<section class="prestasi-section">

    <div class="prestasi-container">

        <div class="prestasi-section-heading">

            <div>

                <span class="prestasi-section-label seni-label">
                    Seni
                </span>

                <h2>Daftar Prestasi</h2>

                <p>
                    Pencapaian siswa dalam berbagai kegiatan
                    dan perlombaan seni.
                </p>

            </div>

        </div>


        <div class="prestasi-grid">

            @forelse($prestasi as $item)

    @include('website.prestasi._card', [
        'item' => $item,
        'kategoriNama' => 'Seni',
        'kategoriClass' => 'seni',
        'kategoriIcon' => 'fa-solid fa-palette',
    ])

    @empty

                <div class="prestasi-empty">

                    <i class="fa-solid fa-palette"></i>

                    <h3>Belum Ada Prestasi</h3>

                    <p>
                        Data prestasi seni belum tersedia.
                    </p>

                </div>

            @endforelse

        </div>

    </div>

</section>
@include('website.prestasi._scripts')
@endsection