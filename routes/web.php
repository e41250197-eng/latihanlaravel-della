<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LaporanPenjualanController;
use App\Http\Controllers\ProdukController;

// Halaman Utama
Route::get('/', function () {
    return view('dashboard_pos', [
        'nama_pegawai' => 'Della',
        'shift' => 'Pagi (08.00 - 16.00)',
    ]);
});

// 1. Basic Routing
Route::get('/hello', function () {
    return 'Hello World';
});

// 2. Route Parameters
Route::get('/user/{id}', function ($id) {
    return 'User ID: ' . $id;
});

Route::get('/user-name/{name?}', function ($name = 'Guest') {
    return 'Hello, ' . $name;
});

Route::get('/profile/{name?}', function ($name = 'Tamu') {
    return "Halo, " . $name . "!";
});

Route::get('/product/{id}', function ($id) {
    return "Detail Produk dengan ID: " . $id;
})->whereNumber('id');

// 3. Named Routes
Route::get('/Dashboard', function () {
    return 'Ini Halaman Dashboard';
})->name('Dashboard');

Route::get('/tes-dashboard', function () {
    $url = route('Dashboard');
    return 'URL dari route yang bernama Dashboard adalah: ' . $url;
});

Route::get('/admin/dashboard', function () {
    return "<h1>Halaman Dashboard Admin</h1><p>Berhasil diakses menggunakan Named Route.</p>";
})->name('dashboard');

// 4. Route Groups & Prefix
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return 'Ini Halaman Dashboard Della';
    });
    Route::get('/users', function () {
        return 'Ini Halaman Users Della';
    });
    Route::get('/produk', function () {
        return "Halaman Produk Della (Hanya Admin)";
    })->name('admin.produk');
    Route::get('/kategori', function () {
        return "Halaman Kategori Della (Hanya Admin)";
    })->name('admin.kategori');
});

Route::prefix('kasir')->group(function () {
    Route::get('/transaksi', function () {
        return "Halaman Input Transaksi Della (Hanya Kasir)";
    })->name('kasir.transaksi');
});

Route::prefix('member')->group(function () {
    Route::get('/profile', function () {
        return "Profil Member";
    });
    Route::get('/settings', function () {
        return "Pengaturan Member";
    });
});

// Request Methods
Route::get('/data', function () { return "GET Request"; });
Route::post('/data', function () { return "POST Request"; });
Route::put('/data', function () { return "PUT Request"; });
Route::delete('/data', function () { return "DELETE Request"; });
Route::patch('/data', function () { return "PATCH Request"; });

// Views Sederhana
Route::get('/greeting', function () {
    return view('greeting', [
        'name' => 'Della',
        'isAdmin' => true
    ]);
});

Route::get('/home', function () {
    return view('home', [
        'role' => 'admin',
        'status' => 'completed'
    ]);
});

Route::get('/beranda', function () {
    return view('beranda');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/produk/cari/{nama?}', function ($nama = null) {
    if ($nama) {
        return "Hasil pencarian produk: " . $nama;
    }
    return "Silakan masukkan kata kunci pencarian pada URL (contoh: /produk/cari/sabun)";
});

Route::get('/produk-toko', function () {
    $produk = [
        [
            'nama' => 'Beras Pandan Wangi 5kg',
            'sku' => 'BRS-001',
            'harga' => 75000,
            'stok' => 20,
            'gambar' => 'https://cdn-klik.klikindomaret.com/klik-catalog/product/20002897_meta.jpg'
        ],
        [
            'nama' => 'Minyak Goreng Bimoli 2L',
            'sku' => 'MYK-002',
            'harga' => 38000,
            'stok' => 15,
            'gambar' => 'https://placehold.co/100'
        ],
        [
            'nama' => 'Gula Pasir Gulaku 1kg',
            'sku' => 'GLA-003',
            'harga' => 17500,
            'stok' => 30,
            'gambar' => 'https://placehold.co/100'
        ],
        [
            'nama' => 'Sabun Mandi Lifebuoy',
            'sku' => 'SBN-004',
            'harga' => 4500,
            'stok' => 50,
            'gambar' => 'https://placehold.co/100'
        ],
    ];

    return view('daftar_produk', ['produk' => $produk]);
});

// Controllers & Resources
Route::resource('book', BookController::class);
Route::get('/laporan', LaporanPenjualanController::class);

// Routing menuju ProdukController (Acara Controller)
Route::get('/produk', [ProdukController::class, 'index']);
Route::get('/produk/{id}', [ProdukController::class, 'show']);

// Fallback Route (Cukup 1)
Route::fallback(function () {
    return "404 - Not Found";
});
