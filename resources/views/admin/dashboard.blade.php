@extends('admin.layouts.app')

@section('title', 'Dashboard Admin')

@section('page-title', 'Dashboard')

@section('content')

<div class="dashboard-heading">

    <div>

        <h1>Dashboard Admin</h1>

        <p>
            Selamat datang,
            <strong>{{ auth()->user()->name ?? 'Administrator' }}</strong>.
            Kelola seluruh informasi website sekolah melalui halaman ini.
        </p>

    </div>

    <div class="dashboard-date">

        <i class="fa-solid fa-calendar"></i>

        <span>
            {{ now()->locale('id')->translatedFormat('d F Y') }}
        </span>

    </div>

</div>


<div class="dashboard-grid">

{{-- ================= BERANDA ================= --}}

    <a href="{{ route('admin.beranda.edit') }}"
        class="dashboard-card dashboard-card-link">

            <div class="dashboard-card-icon beranda-icon">

                <i class="fa-solid fa-house"></i>

            </div>

            <div class="dashboard-card-content">

                <h3>Beranda</h3>

                <p>
                    Kelola tampilan utama, visi misi,
                    kepala sekolah, dan video profil sekolah.
                </p>

                <span class="dashboard-card-action">

                    Kelola data

                    <i class="fa-solid fa-arrow-right"></i>

                </span>

            </div>

        </a>

    {{-- ================= AGENDA ================= --}}

    <a href="{{ route('admin.agenda.index') }}"
       class="dashboard-card dashboard-card-link">

        <div class="dashboard-card-icon agenda-icon">

            <i class="fa-solid fa-calendar-days"></i>

        </div>

        <div class="dashboard-card-content">

            <h3>Agenda</h3>

            <p>
                Kelola jadwal dan kegiatan sekolah.
            </p>

            <span class="dashboard-card-action">

                Kelola data

                <i class="fa-solid fa-arrow-right"></i>

            </span>

        </div>

    </a>


    {{-- ================= BERITA ================= --}}

    <a href="{{ route('admin.berita.index') }}"
        class="dashboard-card dashboard-card-link">

            <div class="dashboard-card-icon berita-icon">

                <i class="fa-solid fa-newspaper"></i>

            </div>

            <div class="dashboard-card-content">

                <h3>Berita</h3>

                <p>
                    Kelola berita dan informasi terbaru sekolah.
                </p>

                <span class="dashboard-card-action">

                    Kelola data

                    <i class="fa-solid fa-arrow-right"></i>

                </span>

            </div>

        </a>

    {{-- ================= PRESTASI ================= --}}

    <a href="{{ route('admin.prestasi.index') }}"
        class="dashboard-card dashboard-card-link">

            <div class="dashboard-card-icon prestasi-icon">

                <i class="fa-solid fa-trophy"></i>

            </div>

            <div class="dashboard-card-content">

                <h3>Prestasi</h3>

                <p>
                    Kelola prestasi siswa dan sekolah.
                </p>

                <span class="dashboard-card-action">

                    Kelola data

                    <i class="fa-solid fa-arrow-right"></i>

                </span>

            </div>

    </a>


    {{-- ================= GALERI ================= --}}

    <a href="{{ route('admin.galeri.index') }}"
        class="dashboard-card dashboard-card-link">

            <div class="dashboard-card-icon galeri-icon">

                <i class="fa-solid fa-images"></i>

            </div>

            <div class="dashboard-card-content">

                <h3>Galeri</h3>

                <p>
                    Kelola dokumentasi foto dan video sekolah.
                </p>

                <span class="dashboard-card-action">

                    Kelola data

                    <i class="fa-solid fa-arrow-right"></i>

                </span>

            </div>

        </a>

        


    {{-- ================= EKSTRAKURIKULER ================= --}}

    <a href="{{ route('admin.ekstrakurikuler.index') }}"
        class="dashboard-card dashboard-card-link">

            <div class="dashboard-card-icon ekstrakurikuler-icon">

                <i class="fa-solid fa-person-running"></i>

            </div>

            <div class="dashboard-card-content">

                <h3>Ekstrakurikuler</h3>

                <p>
                    Kelola kegiatan dan jadwal ekstrakurikuler.
                </p>

                <span class="dashboard-card-action">

                    Kelola data

                    <i class="fa-solid fa-arrow-right"></i>

                </span>

            </div>

        </a>


        {{-- ================= PPDB ================= --}}

    <a href="{{ route('admin.ppdb.index') }}"
        class="dashboard-card dashboard-card-link">

            <div class="dashboard-card-icon ppdb-icon">

                <i class="fa-solid fa-user-graduate"></i>

            </div>

            <div class="dashboard-card-content">

                <h3>PPDB</h3>

                <p>
                    Kelola informasi penerimaan peserta didik baru.
                </p>

                <span class="dashboard-card-action">

                    Kelola data

                    <i class="fa-solid fa-arrow-right"></i>

                </span>

            </div>

        </a>
        {{-- ================= ALUMNI ================= --}}
    <a href="{{ route('admin.alumni.index') }}"
        class="dashboard-card dashboard-card-link">

            <div class="dashboard-card-icon alumni-icon">

                <i class="fa-solid fa-user-graduate"></i>

            </div>

            <div class="dashboard-card-content">

                <h3>Alumni</h3>

                <p>
                    Lihat dan kelola data alumni sekolah.
                </p>

                <span class="dashboard-card-action">

                    Kelola data

                    <i class="fa-solid fa-arrow-right"></i>

                </span>

            </div>

        </a>
{{-- ================= ANTAR JEMPUT ================= --}}

    <a href="{{ route('admin.antar-jemput.index') }}"
        class="dashboard-card dashboard-card-link">

            <div class="dashboard-card-icon antar-icon">

                <i class="fa-solid fa-bus"></i>

            </div>

            <div class="dashboard-card-content">

                <h3>Antar Jemput</h3>

                <p>
                    Kelola pamflet dan informasi layanan transportasi.
                </p>

                <span class="dashboard-card-action">

                    Kelola data

                    <i class="fa-solid fa-arrow-right"></i>

                </span>

            </div>

        </a>
        

</div>

@endsection