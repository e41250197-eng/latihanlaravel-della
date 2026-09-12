<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Beranda Della</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        .btn {
            display: inline-block;
            padding: 10px 18px;
            background-color: #0284c7;
            color: #ffffff;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Selamat Datang di Halaman Beranda Della</h1>
    <p>Ini adalah beranda utama aplikasi praktikum della</p>

    <p>
        <a href="{{ route('dashboard') }}" class="btn">Ke Dashboard Admin</a>
    </p>

    <p><a href="/about">Lihat Profil Pengembang &rarr;</a></p>
</body>
</html>
