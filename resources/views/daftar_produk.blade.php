<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk Toko Kelontong Della</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
            background-color: #f4f4f4;
            color: #333;
        }
        h2 {
            margin-bottom: 5px;
            color: #1e293b;
        }
        p {
            color: #64748b;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            max-width: 850px;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border-radius: 6px;
            overflow: hidden;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
            vertical-align: middle;
        }
        th {
            background-color: #1e293b;
            font-weight: 600;
            color: #fff;
        }
        .img-product {
            width: 55px;
            height: 55px;
            object-fit: cover;
            border-radius: 4px;
            border: 1px solid #ddd;
        }
        .badge-stok {
            display: inline-block;
            padding: 4px 8px;
            background-color: #1e293b;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
            color: #fff;
        }
    </style>
</head>
<body>
    <h2>Daftar Produk Toko Kelontong Della</h2>
    <p>Berikut adalah daftar produk yang tersedia di toko kelontong Della:</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>SKU</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Gambar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($produk as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td><strong>{{ $item['nama'] }}</strong></td>
                <td><code>{{ $item['sku'] }}</code></td>
                <td>Rp {{ number_format($item['harga'], 0, ',', '.') }}</td>
                <td><span class="badge-stok">{{ $item['stok'] }} unit</span></td>
                <td>
                    <img src="{{ $item['gambar'] }}" alt="{{ $item['nama'] }}" class="img-product">
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
