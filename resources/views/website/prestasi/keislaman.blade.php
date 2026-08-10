@extends('layouts.website')

@section('content')

<!-- ================= HERO ================= -->

<section class="prestasi-hero prestasi-hero-keislaman">

    <div class="prestasi-hero-overlay">

        <span class="prestasi-hero-label">
            <i class="fa-solid fa-mosque"></i>
            Prestasi Siswa
        </span>

        <h1>Prestasi Keislaman</h1>

        <p>
            Prestasi siswa SD Muhammadiyah 16 Karangasem
            dalam bidang keislaman.
        </p>

    </div>

</section>


<!-- ================= PRESTASI ================= -->

<section class="prestasi-section">

    <div class="prestasi-container">

        <div class="prestasi-section-heading">

            <div>

            <span class="prestasi-section-label keislaman-label">
                Keislaman
            </span>

                <h2>Daftar Prestasi</h2>

                <p>
                    Pencapaian siswa dalam berbagai kegiatan
                    dan perlombaan keislaman.
                </p>

            </div>

        </div>


        <div class="prestasi-grid">

            @forelse($prestasi as $item)

    @include('website.prestasi._card', [
        'item' => $item,
        'kategoriNama' => 'Keislaman',
        'kategoriClass' => 'keislaman',
        'kategoriIcon' => 'fa-solid fa-mosque',
    ])

    @empty

                <div class="prestasi-empty">

                    <i class="fa-solid fa-award"></i>

                    <h3>Belum Ada Prestasi</h3>

                    <p>
                        Data prestasi keislaman belum tersedia.
                    </p>

                </div>

            @endforelse

        </div>

    </div>

</section>
@include('website.prestasi._scripts')
@endsection