<nav class="navbar">
    <div class="container">

        <div class="logo">
            <img src="{{ asset('images//logo/BrightSchool.png') }}" alt="Logo">
            <span>SD Muhammadiyah 16 Karangasem Surakarta</span>
        </div>

        <ul class="menu">

            <!-- Beranda -->
            <li>
                <a href="/">Beranda</a>
            </li>

<!-- Prestasi -->
<li class="dropdown {{ request()->routeIs('prestasi.*') ? 'active' : '' }}">

    <a href="#"
       class="dropdown-toggle"
       aria-haspopup="true"
       aria-expanded="false">

        <span>Prestasi</span>

        <i class="fa-solid fa-chevron-down"></i>

    </a>

    <ul class="dropdown-menu">

        <li>
            <a href="{{ route('prestasi.akademik') }}"
               class="{{ request()->routeIs('prestasi.akademik') ? 'active' : '' }}">

                

                <span>Akademik</span>

            </a>
        </li>

        <li>
            <a href="{{ route('prestasi.olahraga') }}"
               class="{{ request()->routeIs('prestasi.olahraga') ? 'active' : '' }}">

                

                <span>Olahraga</span>

            </a>
        </li>

        <li>
            <a href="{{ route('prestasi.keislaman') }}"
               class="{{ request()->routeIs('prestasi.keislaman') ? 'active' : '' }}">

                

                <span>Keislaman</span>

            </a>
        </li>

        <li>
            <a href="{{ route('prestasi.seni') }}"
               class="{{ request()->routeIs('prestasi.seni') ? 'active' : '' }}">

                

                <span>Seni</span>

            </a>
        </li>

    </ul>

</li>
            <!-- Agenda -->
            <li>
                <a href="{{ url('/agenda') }}">Agenda</a>
            </li>

            <!-- Berita -->
            <li>
                <a href="{{ url('/berita') }}">Berita</a>
            </li>

            <!-- Layanan -->
            <li class="dropdown">

            <a href="#">Layanan</a>

            <ul class="dropdown-menu">

            <li>
            <a href="{{ url('/layanan/ppdb') }}">
            PPDB
            </a>
            </li>

            <li>
            <a href="{{ url('/layanan/antar-jemput') }}">
            Antar Jemput
            </a>
            </li>

            </ul>

            </li>

            <!-- Galeri -->
            <li class="dropdown">

            <a href="#">Galeri</a>

            <ul class="dropdown-menu">

            <li>
            <a href="{{ url('/galeri/foto') }}">
            Foto
            </a>
            </li>

            <li>
            <a href="{{ url('/galeri/video') }}">
            Video
            </a>
            </li>

            </ul>

            </li>
            <!-- Ekstrakurikuler -->
            <li>
                <a href="{{ url('/ekstrakurikuler') }}">Ekstrakurikuler</a>
            </li>
            <!-- Alumni -->
            <li>
                <a href="{{ url('/alumni') }}">Alumni</a>
            </li>
        </ul>

    </div>
</nav>