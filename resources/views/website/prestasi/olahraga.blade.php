@extends('layouts.website')

@section('content')

<!-- ================= HERO ================= -->

<section class="prestasi-hero prestasi-hero-olahraga">

    <div class="prestasi-hero-overlay">

        <span class="prestasi-hero-label">

            <i class="fa-solid fa-medal"></i>

            Prestasi Siswa

        </span>

        <h1>Prestasi Olahraga</h1>

        <p>
            Prestasi siswa SD Muhammadiyah 16 Karangasem
            dalam bidang olahraga.
        </p>

    </div>

</section>


<!-- ================= DAFTAR PRESTASI ================= -->

<section class="prestasi-section">

    <div class="prestasi-container">

        <div class="prestasi-section-heading">

            <div>

                <span class="prestasi-section-label olahraga-label">
                    Olahraga
                </span>

                <h2>Daftar Prestasi</h2>

                <p>
                    Pencapaian siswa dalam berbagai kegiatan
                    dan perlombaan olahraga.
                </p>

            </div>

        </div>


        <div class="prestasi-grid">

            @forelse($prestasi as $item)

    @include('website.prestasi._card', [
        'item' => $item,
        'kategoriNama' => 'Olahraga',
        'kategoriClass' => 'olahraga',
        'kategoriIcon' => 'fa-solid fa-medal',
    ])

    @empty

                <div class="prestasi-empty">

                    <i class="fa-solid fa-medal"></i>

                    <h3>Belum Ada Prestasi</h3>

                    <p>
                        Data prestasi olahraga belum tersedia.
                    </p>

                </div>

            @endforelse

        </div>

    </div>

</section>
@include('website.prestasi._scripts')
@endsection