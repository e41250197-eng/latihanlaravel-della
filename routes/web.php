<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FormValidationController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LaporanPenjualanController;
use App\Http\Controllers\ProdukController;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

// ==========================================
// HALAMAN UTAMA & ROUTING DASAR
// ==========================================
Route::get('/', function () {
    return view('welcome');
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
Route::get('/tes-dashboard', function () {
    $url = route('dashboard');
    return 'URL dari route yang bernama Dashboard adalah: ' . $url;
});

Route::get('/admin/dashboard', function () {
    return "<h1>Halaman Dashboard Admin</h1><p>Berhasil diakses menggunakan Named Route.</p>";
});

// 4. Route Groups & Prefix
Route::prefix('admin')->group(function () {
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
Route::get('/produk', [ProdukController::class, 'index']);
Route::get('/produk/{id}', [ProdukController::class, 'show']);

// ==========================================
// ACARA 17: QUERY BUILDER
// ==========================================
Route::get('/qb-insert', function () {
    $id = DB::table('users')->insertGetId([
        'name' => 'Jane Doe',
        'email' => 'janedoe' . rand(1, 999) . '@example.com',
        'password' => bcrypt('password123'),
        'created_at' => now(),
        'updated_at' => now(),
    ]);
    return "Data user berhasil ditambahkan dengan ID: " . $id;
});

Route::get('/qb-get', function () {
    $users = DB::table('users')->select('id', 'name', 'email')->get();
    return response()->json($users);
});

Route::get('/qb-update', function () {
    DB::table('users')
        ->where('name', 'Jane Doe')
        ->update(['name' => 'Jane Doe Updated']);
    return "Data user Jane Doe berhasil diperbarui.";
});

Route::get('/qb-delete', function () {
    DB::table('users')
        ->where('name', 'Jane Doe Updated')
        ->delete();
    return "Data user berhasil dihapus.";
});

Route::get('/qb-agregat', function () {
    $totalUsers = DB::table('users')->count();
    $daftarNama = DB::table('users')->pluck('name');
    return response()->json([
        'total_users' => $totalUsers,
        'daftar_nama' => $daftarNama,
    ]);
});

// ==========================================
// ACARA 18: ELOQUENT ORM (PART 1)
// ==========================================
Route::get('/eloquent-create', function () {
    $user = User::create([
        'name' => 'John Doe',
        'email' => 'johndoe' . rand(1, 999) . '@example.com',
        'password' => bcrypt('password'),
    ]);
    return "User berhasil dibuat via create() dengan ID: " . $user->id;
});

Route::get('/eloquent-save', function () {
    $user = new User;
    $user->name = 'Jane Doe Eloquent';
    $user->email = 'janedoe_eloquent' . rand(1, 999) . '@example.com';
    $user->password = bcrypt('password');
    $user->save();
    return "User berhasil dibuat via save() dengan ID: " . $user->id;
});

Route::get('/eloquent-all', function () {
    $users = User::all();
    return response()->json($users);
});

Route::get('/eloquent-find/{id?}', function ($id = 1) {
    $user = User::find($id);
    if (!$user) {
        return "User dengan ID: $id tidak ditemukan.";
    }
    return response()->json($user);
});

Route::get('/eloquent-where', function () {
    $users = User::where('name', 'like', '%John%')->get();
    return response()->json($users);
});

Route::get('/eloquent-first-or-fail', function () {
    $user = User::where('email', 'email_tidak_ada@example.com')->firstOrFail();
    return response()->json($user);
});

Route::get('/eloquent-update', function () {
    User::where('name', 'John Doe')->update(['name' => 'John Updated']);
    return "Data user John Doe berhasil diperbarui via update().";
});

Route::get('/eloquent-save-update/{id?}', function ($id = 1) {
    $user = User::find($id);
    if ($user) {
        $user->name = 'Nama Diperbarui via Save';
        $user->save();
        return "User ID: $id berhasil diperbarui via save().";
    }
    return "User tidak ditemukan.";
});

Route::get('/eloquent-delete/{id?}', function ($id = 51) {
    $user = User::find($id);
    if ($user) {
        $user->delete();
        return "User dengan ID: $id berhasil dihapus via delete().";
    }
    return "User ID: $id tidak ditemukan.";
});

Route::get('/eloquent-destroy/{id?}', function ($id = 50) {
    $deleted = User::destroy($id);
    if ($deleted) {
        return "User dengan ID: $id berhasil dihapus via destroy().";
    }
    return "User ID: $id gagal dihapus / tidak ditemukan.";
});

// ==========================================
// ACARA 19: ELOQUENT ORM (PART 2)
// ==========================================
Route::get('/eloquent2-where', function () {
    $users = User::where('name', 'like', '%a%')->limit(5)->get(['id', 'name', 'email']);
    return response()->json($users);
});

Route::get('/eloquent2-or-where', function () {
    $users = User::where('id', 1)->orWhere('id', 2)->get(['id', 'name', 'email']);
    return response()->json($users);
});

Route::get('/eloquent2-where-between', function () {
    $users = User::whereBetween('id', [1, 5])->get(['id', 'name', 'email']);
    return response()->json($users);
});

Route::get('/eloquent2-where-in', function () {
    $users = User::whereIn('id', [1, 3, 5])->get(['id', 'name', 'email']);
    return response()->json($users);
});

Route::get('/eloquent2-where-null', function () {
    $users = User::whereNull('email_verified_at')->limit(3)->get(['id', 'name', 'email_verified_at']);
    return response()->json($users);
});

Route::get('/eloquent2-when', function () {
    $role = 'user';
    $users = User::when($role, function ($query, $role) {
        return $query->where('id', '>', 0);
    })->limit(3)->get(['id', 'name', 'email']);
    return response()->json($users);
});

Route::get('/eloquent2-accessor/{id?}', function ($id = 1) {
    $user = User::findOrFail($id);
    return "Nama asli diubah Accessor menjadi kapital: " . $user->name;
});

Route::get('/eloquent2-scope', function () {
    $activeUsers = User::active()->limit(5)->get(['id', 'name', 'email_verified_at']);
    return response()->json($activeUsers);
});

// ==========================================
// ACARA 20: FORM VALIDATION
// ==========================================
Route::get('/acara20', [FormValidationController::class, 'index']);
Route::post('/acara20-proses', [FormValidationController::class, 'store']);

// ==========================================
// ACARA 21: MIDDLEWARE
// ==========================================
Route::get('/acara21/dashboard', function () {
    return response()->json([
        'status' => 'Berhasil',
        'pesan' => 'Selamat datang di Halaman Dashboard Admin!'
    ]);
})->middleware('admin:admin');

// ==========================================
// ACARA 22: LARAVEL BREEZE & AUTHENTICATION
// ==========================================
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// ==========================================
// FALLBACK ROUTE
// ==========================================
Route::fallback(function () {
    return "404 - Not Found";
});
