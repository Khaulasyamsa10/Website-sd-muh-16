<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Dashboard Admin')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body class="admin-body">

<div class="admin-wrapper">

    {{-- Sidebar --}}
    @include('admin.partials.sidebar')

    <div class="admin-main">

        {{-- Navbar admin --}}
        @include('admin.partials.navbar')

        <main class="admin-content">

            @yield('content')

        </main>

    </div>

</div>

</body>

</html>