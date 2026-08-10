<aside class="admin-sidebar">

    <!-- ================= BRAND ================= -->

    <div class="admin-brand">

        <div class="admin-brand-logo">
            <i class="fa-solid fa-school"></i>
        </div>

        <div class="admin-brand-text">

            <h2>Admin Sekolah</h2>

            <span>SD Muhammadiyah 16</span>

        </div>

    </div>


    <!-- ================= MENU UTAMA ================= -->

    <nav class="admin-menu">

        <!-- Dashboard -->

        <a href="{{ route('dashboard') }}"
           class="admin-menu-link
           {{ request()->routeIs('dashboard') ? 'active' : '' }}">

            <i class="fa-solid fa-house"></i>

            <span>Dashboard</span>

        </a>

        {{-- BERANDA --}}

        <a href="{{ route('admin.beranda.edit') }}"
            class="admin-menu-link
            {{ request()->routeIs('admin.beranda.*') ? 'active' : '' }}">

                <i class="fa-solid fa-house"></i>

                <span>Beranda</span>

            </a>

        <!-- Agenda -->

        <a href="{{ route('admin.agenda.index') }}"
           class="admin-menu-link
           {{ request()->routeIs('admin.agenda.*') ? 'active' : '' }}">

            <i class="fa-solid fa-calendar-days"></i>

            <span>Agenda</span>

        </a>


        <!-- Berita -->

        <a href="{{ route('admin.berita.index') }}"
            class="admin-menu-link
            {{ request()->routeIs('admin.berita.*') ? 'active' : '' }}">

                <i class="fa-solid fa-newspaper"></i>

                <span>Berita</span>

            </a>


        <!-- Prestasi -->

        <a href="{{ route('admin.prestasi.index') }}"
           class="admin-menu-link
           {{ request()->routeIs('admin.prestasi.*') ? 'active' : '' }}">

            <i class="fa-solid fa-trophy"></i>

            <span>Prestasi</span>

        </a>


        <!-- Galeri -->

        <a href="{{ route('admin.galeri.index') }}"
            class="admin-menu-link
            {{ request()->routeIs('admin.galeri.*')
                    ? 'active'
                    : ''
            }}">

                <i class="fa-solid fa-images"></i>

                <span>Galeri</span>

        </a>



        <!-- Ekstrakurikuler -->

        <a href="{{ route('admin.ekstrakurikuler.index') }}"
            class="admin-menu-link
            {{ request()->routeIs('admin.ekstrakurikuler.*')
                    ? 'active'
                    : ''
            }}">

                <i class="fa-solid fa-person-running"></i>

                <span>Ekstrakurikuler</span>

        </a>


        <!-- PPDB -->

        <a href="{{ route('admin.ppdb.index') }}"
           class="admin-menu-link
           {{ request()->routeIs('admin.ppdb.*') ? 'active' : '' }}">

            <i class="fa-solid fa-user-graduate"></i>

            <span>PPDB</span>

        </a>


        <!-- Antar Jemput -->

        <a href="{{ route('admin.antar-jemput.index') }}"
        class="admin-menu-link
        {{ request()->routeIs('admin.antar-jemput.*') ? 'active' : '' }}">

            <i class="fa-solid fa-bus"></i>

            <span>Antar Jemput</span>

        </a>

    </nav>

    <!-- Alumni -->

        <a href="{{ route('admin.alumni.index') }}"
        class="admin-menu-link
        {{ request()->routeIs('admin.alumni.*')
                ? 'active'
                : ''
        }}">

            <i class="fa-solid fa-user-graduate"></i>

            <span>Alumni</span>

        </a>


    <!-- ================= MENU BAWAH ================= -->

    <div class="admin-sidebar-bottom">

        <a href="{{ route('beranda') }}"
           class="admin-menu-link"
           target="_blank">

            <i class="fa-solid fa-globe"></i>

            <span>Lihat Website</span>

        </a>


        <form action="{{ route('logout') }}"
              method="POST">

            @csrf

            <button type="submit"
                    class="admin-menu-link admin-logout">

                <i class="fa-solid fa-right-from-bracket"></i>

                <span>Logout</span>

            </button>

        </form>

    </div>

</aside>