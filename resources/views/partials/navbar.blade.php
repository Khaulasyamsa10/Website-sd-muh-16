<nav class="navbar">
    <div class="container">

        <div class="logo">
            <img src="{{ asset('images//logo/logosdnew.png') }}" alt="Logo">
            <span>SD Muhammadiyah 16 Karangasem</span>
        </div>

        <ul class="menu">

            <!-- Beranda -->
            <li>
                <a href="/">Beranda</a>
            </li>

            <!-- Prestasi -->
            <li class="dropdown">
    <a href="#">Prestasi</a>

    <ul class="dropdown-menu">

        <li>
            <a href="{{ url('/prestasi/keislaman') }}">
                Keislaman
            </a>
        </li>

        <li>
            <a href="{{ url('/prestasi/olahraga') }}">
                Olahraga
            </a>
        </li>

        <li>
            <a href="{{ url('/prestasi/akademik') }}">
                Akademik
            </a>
        </li>

        <li>
            <a href="{{ url('/prestasi/seni') }}">
                Seni
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