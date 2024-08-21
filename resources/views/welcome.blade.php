<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Selamat Datang di Sate Maranggi</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: 'Nunito', sans-serif;
            background-color: #f7f9fc;
            color: #333;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            text-align: center;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            padding: 40px;
            max-width: 800px;
            width: 100%;
        }

        .logo img {
            width: 250px;
            height: auto;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .title {
            font-size: 36px;
            font-weight: 600;
            margin: 20px 0;
            color: #2c3e50;
        }

        .description {
            font-size: 18px;
            margin: 20px 0;
            color: #555;
        }

        .links {
            margin: 20px 0;
        }

        .links a {
            color: #ffffff;
            background-color: #3498db;
            padding: 10px 20px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s, transform 0.3s;
        }

        .links a:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
        }

        .auth-links {
            position: absolute;
            top: 20px;
            right: 20px;
        }

        .auth-links a {
            color: #3498db;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            margin-left: 15px;
        }

        .auth-links a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="logo">
            <img src="{{ asset('asset/img/sate.png') }}" alt="Sate Maranggi Logo">
        </div>

        <div class="title">
            Sate Maranggi Si Bungsu
        </div>

        <div class="description">
           Sebuah sistem untuk mengatur transaksi dalam satu aplikasi
        </div>

        <div class="links">
            <!-- Link untuk informasi lebih lanjut atau fitur tambahan -->
            @if (Route::has('login'))
            @auth
                <a href="{{ url('/home') }}">Dashboard</a>
            @else
                <a href="{{ route('login') }}">Masuk</a>
            @endauth
        @endif
          
        </div>
    </div>
</body>

</html>
