<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Uji Coba Otorisasi - Acara 24</title>
    <style>
        body { font-family: sans-serif; padding: 40px; background-color: #f8fafc; }
        .card { max-width: 600px; margin: 0 auto 20px; padding: 20px; background: #fff; border-radius: 8px; border: 1px solid #e2e8f0; }
        .btn { padding: 6px 12px; background: #3b82f6; color: white; border: none; border-radius: 4px; text-decoration: none; cursor: pointer; }
        .badge { background: #e0f2fe; color: #0369a1; padding: 3px 8px; border-radius: 4px; font-size: 12px; }
        .text-muted { color: #64748b; font-size: 14px; }
    </style>
</head>
<body>
    <div class="card">
        <h2>Simulasi Otorisasi Gate & Blade Directive (Acara 24)</h2>
        <p>Login sebagai: <strong>{{ Auth::user()->name }}</strong> (ID: {{ Auth::id() }})</p>
    </div>

    <!-- Skenario 1: Post Milik Pengguna Sendiri -->
    <div class="card">
        <h3>1. {{ $postMilikDella->title }}</h3>
        <p class="text-muted">Author ID: {{ $postMilikDella->user_id }} <span class="badge">Milik Pengguna Sendiri</span></p>
        @can('edit-post', $postMilikDella)
            <button class="btn">Edit Postingan Ini</button>
            <span style="color: green; margin-left: 10px;">✓ Tombol Edit Muncul (Otorisasi Diberikan)</span>
        @else
            <span style="color: red;">✗ Akses Ditolak</span>
        @endcan
    </div>

    <!-- Skenario 2: Post Milik Orang Lain -->
    <div class="card">
        <h3>2. {{ $postMilikOrangLain->title }}</h3>
        <p class="text-muted">Author ID: {{ $postMilikOrangLain->user_id }} <span class="badge">Milik User Lain</span></p>
        @can('edit-post', $postMilikOrangLain)
            <button class="btn">Edit Postingan Ini</button>
        @else
            <span style="color: #ef4444; font-weight: bold;">✗ Tombol Edit Disembunyikan (Anda bukan pemilik postingan ini)</span>
        @endcan
    </div>
</body>
</html>
