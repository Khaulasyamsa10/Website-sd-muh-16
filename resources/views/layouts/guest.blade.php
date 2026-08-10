<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Login Admin - SD Muhammadiyah 16 Karangasem</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: linear-gradient(135deg, #005bac, #0b74d8);
            min-height: 100vh;
        }

        .guest-wrapper {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 25px;
        }

        .guest-container {
            width: 100%;
            max-width: 430px;
        }

        .guest-logo {
            text-align: center;
            color: white;
            margin-bottom: 25px;
        }

        .guest-logo h1 {
            margin: 0 0 8px;
            font-size: 27px;
        }

        .guest-logo p {
            margin: 0;
            color: #e8f2ff;
            font-size: 15px;
        }

        .guest-card {
            background: white;
            border-radius: 18px;
            padding: 35px;
            box-shadow: 0 18px 45px rgba(0, 0, 0, 0.22);
        }

        .guest-home {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: white;
            text-decoration: none;
            font-size: 15px;
        }

        .guest-home:hover {
            text-decoration: underline;
        }

        @media (max-width: 576px) {
            .guest-card {
                padding: 25px;
            }

            .guest-logo h1 {
                font-size: 22px;
            }
        }
    </style>
</head>

<body>

<div class="guest-wrapper">

    <div class="guest-container">

        <div class="guest-logo">

            <h1>SD Muhammadiyah 16 Karangasem</h1>

            <p>Halaman Admin Sekolah</p>

        </div>

        <div class="guest-card">

            {{ $slot }}

        </div>

        <a href="{{ url('/') }}" class="guest-home">
            ← Kembali ke halaman website
        </a>

    </div>

</div>

</body>

</html>