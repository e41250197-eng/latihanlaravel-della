<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Uji Coba Directive Auth - Acara 23</title>
    <style>
        body { font-family: sans-serif; padding: 40px; line-height: 1.6; }
        .card { max-width: 500px; margin: auto; padding: 25px; border: 1px solid #ddd; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .btn { display: inline-block; padding: 8px 16px; background: #e3342f; color: #fff; border: none; border-radius: 4px; cursor: pointer; text-decoration: none; }
        .btn-login { background: #3490dc; }
    </style>
</head>
<body>
    <div class="card">
        <h2>Status Autentikasi Pengguna</h2>

        @auth
            <p>Selamat datang, <strong>{{ Auth::user()->name }}</strong>!</p>
            <p>Email: {{ Auth::user()->email }} (User ID: {{ Auth::id() }})</p>

            <form action="{{ route('logout') }}" method="POST" style="margin-top: 15px;">
                @csrf
                <button type="submit" class="btn">Logout dari Aplikasi</button>
            </form>
        @endauth

        @guest
            <p style="color: #666;">Silakan login terlebih dahulu untuk mengakses fitur ini.</p>
            <a href="{{ route('login') }}" class="btn btn-login">Menuju Halaman Login</a>
        @endguest
    </div>
</body>
</html>
