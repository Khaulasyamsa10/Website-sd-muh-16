<header class="admin-navbar">

    <div class="admin-navbar-left">

        <button type="button"
                class="admin-menu-toggle"
                id="adminMenuToggle">

            <i class="fa-solid fa-bars"></i>

        </button>

        <div>

            <h3>@yield('page-title', 'Dashboard')</h3>

            <span>Pengelolaan Website Sekolah</span>

        </div>

    </div>

    <div class="admin-user">

        <div class="admin-user-avatar">

            {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}

        </div>

        <div class="admin-user-info">

            <strong>
                {{ auth()->user()->name ?? 'Administrator' }}
            </strong>

            <span>Administrator</span>

        </div>

    </div>

</header>