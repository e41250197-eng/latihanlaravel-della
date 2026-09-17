<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Statistik Penjualan</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background-color: #f9f9f9; }
        .card { background: #fff; padding: 24px; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); max-width: 500px; }
        h2 { margin-top: 0; color: #333; }
        table { width: 100%; border-collapse: collapse; margin-top: 16px; }
        td, th { padding: 10px; border-bottom: 1px solid #ddd; text-align: left; }
    </style>
</head>
<body>

    <div class="card">
        <h2>Rekap Statistik Penjualan</h2>
        <table>
            <tr>
                <th>Total Transaksi</th>
                <td>{{ $statistik['total_transaksi'] }} Transaksi</td>
            </tr>
            <tr>
                <th>Total Pendapatan</th>
                <td>Rp {{ number_format($statistik['total_pendapatan'], 0, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Produk Terlaris</th>
                <td>{{ $statistik['produk_terlaris'] }}</td>
            </tr>
            <tr>
                <th>Pelanggan Baru</th>
                <td>{{ $statistik['pelanggan_baru'] }} Orang</td>
            </tr>
        </table>
    </div>

</body>
</html>
