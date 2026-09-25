<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acara 20 - Form, Validation & Custom Rule Uppercase</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f1f5f9; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; padding: 20px; box-sizing: border-box; }
        .card { background: #ffffff; border-radius: 10px; padding: 28px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); width: 100%; max-width: 480px; }
        h3 { margin-top: 0; color: #1e293b; text-align: center; border-bottom: 2px solid #e2e8f0; padding-bottom: 12px; }
        .form-group { margin-bottom: 16px; }
        label { display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 14px; }
        input[type="text"], input[type="email"], input[type="password"] { width: 100%; padding: 10px 12px; border: 1.5px solid #cbd5e1; border-radius: 6px; box-sizing: border-box; font-size: 14px; }
        input:focus { border-color: #2563eb; outline: none; }
        .password-wrapper { position: relative; display: flex; align-items: center; }
        .password-wrapper input { padding-right: 55px; }
        .toggle-btn { position: absolute; right: 10px; background: none; border: none; cursor: pointer; color: #64748b; font-size: 12px; font-weight: 600; padding: 4px; }
        .toggle-btn:hover { color: #1e293b; }
        .btn-submit { width: 100%; background-color: #2563eb; color: #ffffff; border: none; padding: 12px; font-size: 15px; font-weight: bold; border-radius: 6px; cursor: pointer; margin-top: 8px; }
        .btn-submit:hover { background-color: #1d4ed8; }
        .alert-error { background-color: #fef2f2; border: 1px solid #f87171; color: #b91c1c; padding: 12px 16px; border-radius: 6px; margin-bottom: 20px; font-size: 14px; }
        .alert-success { background-color: #f0fdf4; border: 1px solid #4ade80; color: #15803d; padding: 12px 16px; border-radius: 6px; margin-bottom: 20px; font-size: 14px; font-weight: 600; text-align: center; }
        .hint { font-size: 12px; color: #64748b; margin-top: 4px; display: block; }
    </style>
</head>
<body>

<div class="card">
    <h3>Pendaftaran Akun (Acara 20)</h3>

    {{-- Alert Berhasil --}}
    @if (session('success'))
        <div class="alert-success">
            ✓ {{ session('success') }}
        </div>
    @endif

    {{-- 2. Alert Kumpulan Error ($errors->any()) --}}
    @if ($errors->any())
        <div class="alert-error">
            <strong>Terjadi Kesalahan Validasi:</strong>
            <ul style="margin: 6px 0 0 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ url('/acara20-proses') }}" method="POST">
        {{-- Proteksi Wajib CSRF --}}
        @csrf

        {{-- Input Nama: Blokir angka di level keyboard + Custom Rule Uppercase di server --}}
        <div class="form-group">
            <label for="name">Nama Lengkap (Huruf Kapital Semua):</label>
            <input
                type="text"
                name="name"
                id="name"
                value="{{ old('name') }}"
                placeholder="Contoh: DELLA GITA PERMATA"
                oninput="this.value = this.value.replace(/[0-9]/g, '')"
            >
            <span class="hint">*Tidak bisa diketik angka & wajib huruf besar semua.</span>
        </div>

        <div class="form-group">
            <label for="email">Alamat Email:</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="nama@domain.com">
        </div>

        {{-- Input Password Hidden + Fitur Toggle Intip --}}
        <div class="form-group">
            <label for="password">Password (Hidden):</label>
            <div class="password-wrapper">
                <input type="password" name="password" id="password" placeholder="Minimal 6 karakter">
                <button type="button" class="toggle-btn" onclick="togglePass('password', this)">Lihat</button>
            </div>
        </div>

        <div class="form-group">
            <label for="password_confirmation">Konfirmasi Password:</label>
            <div class="password-wrapper">
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Ulangi password">
                <button type="button" class="toggle-btn" onclick="togglePass('password_confirmation', this)">Lihat</button>
            </div>
        </div>

        <button type="submit" class="btn-submit">Daftar Sekarang</button>
    </form>
</div>

<script>
    function togglePass(fieldId, btn) {
        const input = document.getElementById(fieldId);
        if (input.type === 'password') {
            input.type = 'text';
            btn.textContent = 'Tutup';
        } else {
            input.type = 'password';
            btn.textContent = 'Lihat';
        }
    }
</script>

</body>
</html>
