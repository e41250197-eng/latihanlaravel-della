<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Upload & Manipulasi Gambar Produk - Acara 29</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-5 bg-light">
    <div class="container" style="max-width: 600px;">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Form Upload Gambar Produk (Intervention Image)</h5>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    <div class="text-center mb-3">
                        <p class="fw-bold">Hasil Gambar (800x800 px):</p>
                        <img src="{{ asset('storage/' . session('image')) }}" class="img-fluid rounded border" style="max-height: 250px;">
                    </div>
                @endif

                <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nama Produk</label>
                        <input type="text" name="nama_produk" class="form-control" required placeholder="Contoh: Kopi Bubuk">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Pilih Gambar Produk</label>
                        <input type="file" name="image" class="form-control" accept="image/*" required>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Upload & Resize Gambar</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
