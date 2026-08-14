<nav class="navbar">
    <div class="container navbar-container">

        {{-- LOGO --}}
        <a href="{{ url('/') }}" class="logo">
            <img src="{{ asset('images/logo/BrightSchool.png') }}" alt="Logo SD Muhammadiyah 16 Karangasem">

            <span>
                SD Muhammadiyah 16 Karangasem Surakarta
            </span>
        </a>


        {{-- TOMBOL HAMBURGER --}}
        <button
            type="button"
            class="mobile-menu-button"
            id="mobileMenuButton"
            aria-label="Buka menu"
            aria-expanded="false"
            aria-controls="mainMenu"
        >
            <i class="fa-solid fa-bars"></i>
        </button>


        {{-- MENU --}}
        <ul class="menu" id="mainMenu">

            {{-- BERANDA --}}
            <li>
                <a href="{{ url('/') }}">
                    Beranda
                </a>
            </li>


            {{-- PRESTASI --}}
            <li class="dropdown {{ request()->routeIs('prestasi.*') ? 'active' : '' }}">

                <button
                    type="button"
                    class="dropdown-toggle"
                    aria-expanded="false"
                >
                    <span>Prestasi</span>

                    <i class="fa-solid fa-chevron-down"></i>
                </button>

                <ul class="dropdown-menu">

                    <li>
                        <a
                            href="{{ route('prestasi.akademik') }}"
                            class="{{ request()->routeIs('prestasi.akademik') ? 'active' : '' }}"
                        >
                            Akademik
                        </a>
                    </li>

                    <li>
                        <a
                            href="{{ route('prestasi.olahraga') }}"
                            class="{{ request()->routeIs('prestasi.olahraga') ? 'active' : '' }}"
                        >
                            Olahraga
                        </a>
                    </li>

                    <li>
                        <a
                            href="{{ route('prestasi.keislaman') }}"
                            class="{{ request()->routeIs('prestasi.keislaman') ? 'active' : '' }}"
                        >
                            Keislaman
                        </a>
                    </li>

                    <li>
                        <a
                            href="{{ route('prestasi.seni') }}"
                            class="{{ request()->routeIs('prestasi.seni') ? 'active' : '' }}"
                        >
                            Seni
                        </a>
                    </li>

                </ul>
            </li>


            {{-- AGENDA --}}
            <li>
                <a href="{{ route('agenda') }}">
                    Agenda
                </a>
            </li>


            {{-- BERITA --}}
            <li>
                <a href="{{ route('berita') }}">
                    Berita
                </a>
            </li>


            {{-- LAYANAN --}}
            <li class="dropdown {{ request()->routeIs('layanan.*') ? 'active' : '' }}">

                <button
                    type="button"
                    class="dropdown-toggle"
                    aria-expanded="false"
                >
                    <span>Layanan</span>

                    <i class="fa-solid fa-chevron-down"></i>
                </button>

                <ul class="dropdown-menu">

                    <li>
                        <a href="{{ route('layanan.ppdb') }}">
                            PPDB
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('layanan.antarjemput') }}">
                            Antar Jemput
                        </a>
                    </li>

                </ul>
            </li>


            {{-- GALERI --}}
            <li class="dropdown {{ request()->routeIs('galeri.*') ? 'active' : '' }}">

                <button
                    type="button"
                    class="dropdown-toggle"
                    aria-expanded="false"
                >
                    <span>Galeri</span>

                    <i class="fa-solid fa-chevron-down"></i>
                </button>

                <ul class="dropdown-menu">

                    <li>
                        <a href="{{ route('galeri.foto') }}">
                            Foto
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('galeri.video') }}">
                            Video
                        </a>
                    </li>

                </ul>
            </li>


            {{-- EKSTRAKURIKULER --}}
            <li>
                <a href="{{ route('ekstrakurikuler') }}">
                    Ekstrakurikuler
                </a>
            </li>


            {{-- ALUMNI --}}
            <li>
                <a href="{{ route('alumni') }}">
                    Alumni
                </a>
            </li>

        </ul>

    </div>
</nav>