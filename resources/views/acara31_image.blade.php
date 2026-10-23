<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Acara 31 - Laravel Image Manipulation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light py-5">
    <div class="container" style="max-width: 900px;">
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Acara 31: Uji Manipulasi Gambar (Intervention Image)</h5>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form action="{{ route('acara31.process') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-bold">Pilih Gambar untuk Dimanipulasi (JPG/PNG)</label>
                        <input type="file" name="photo" class="form-control" accept="image/*" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Proses (Resize, Crop, Rotate)</button>
                </form>
            </div>
        </div>

        @if(session('results'))
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">Hasil Perbandingan Manipulasi Citra</h5>
            </div>
            <div class="card-body">
                <div class="row text-center g-3">
                    <div class="col-md-3">
                        <div class="border p-2 rounded bg-white h-100">
                            <span class="badge bg-secondary mb-2">Original</span>
                            <img src="{{ asset('storage/' . session('results')['original']) }}" class="img-fluid rounded" style="max-height: 180px;">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="border p-2 rounded bg-white h-100">
                            <span class="badge bg-info text-dark mb-2">Resize (300x200)</span>
                            <img src="{{ asset('storage/' . session('results')['resized']) }}" class="img-fluid rounded" style="max-height: 180px;">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="border p-2 rounded bg-white h-100">
                            <span class="badge bg-success mb-2">Crop / Square (250x250)</span>
                            <img src="{{ asset('storage/' . session('results')['cropped']) }}" class="img-fluid rounded" style="max-height: 180px;">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="border p-2 rounded bg-white h-100">
                            <span class="badge bg-warning text-dark mb-2">Rotate (45°)</span>
                            <img src="{{ asset('storage/' . session('results')['rotated']) }}" class="img-fluid rounded" style="max-height: 180px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</body>
</html>
