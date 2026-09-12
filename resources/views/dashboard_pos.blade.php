<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi POS toko kelontong Della</title>
</head>
<body>
    <header>
        <h2>Sistem Point of Sale - Toko Kelontong Della</h2>
        <hr>
    </header>

    <main>
        <h3>Selamat datang, {{$nama_pegawai}}!</h3>
        <p>Status shift Anda hari ini: <strong>{{$shift}}</strong></p>

        <h4>Menu Cepat</h4>
        <ul>
            <li>Kasir Aktif: Jam Operasional Terpantau</li>
            <li>Transaksi Hari Ini: 0</li>
        </ul>
    </main>

    <footer>
        <hr>
        <p>&copy; 2024 Toko Kelontong Della. All rights reserved.</p>
    </footer>
</body>
</html>
