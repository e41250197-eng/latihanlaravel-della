<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ProdukController extends Controller
{
    // Menampilkan daftar produk
    public function index()
    {
        $kategori = "Elektronik";
        $daftarProduk = [
            ['id' => 1, 'nama' => 'Laptop Dell Latitude 5320', 'harga' => 5000000],
            ['id' => 2, 'nama' => 'Mouse Wireless', 'harga' => 300000],
            ['id' => 3, 'nama' => 'Keyboard', 'harga' => 850000],
        ];

        return view('produk.index', compact('kategori', 'daftarProduk'));
    }

    // Menampilkan detail produk berdasarkan parameter ID
    public function show($id)
    {
        return view('produk.detail', ['id' => $id]);
    }

    // Form upload gambar produk (Acara 29)
    public function create()
    {
        return view('produk.upload');
    }

    // Proses upload dan manipulasi gambar menggunakan Intervention Image
    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'image'       => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $file = $request->file('image');

        if ($file) {
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $ext = strtolower($file->getClientOriginalExtension());
            $filename = time() . '_' . preg_replace('/[^A-Za-z0-9_\-]/', '_', $originalName) . '.' . $ext;
            $path = 'products/' . $filename;

            // Inisialisasi Intervention Image Manager dengan GD Driver
            $manager = new ImageManager(Driver::class);

            // Manipulasi: decode file gambar dan ubah ukuran (cover 800x800)
            $image = $manager->decodePath($file->getRealPath())
                             ->cover(800, 800);

            // Encoding sesuai ekstensi (png atau jpg)
            if ($ext === 'png') {
                $encoded = $image->encodeUsingFileExtension('png', quality: 90);
            } else {
                $encoded = $image->encodeUsingFileExtension('jpg', quality: 85);
            }

            // Simpan file hasil manipulasi ke disk public
            Storage::disk('public')->put($path, $encoded->toString());

            return back()->with('success', 'Gambar berhasil dimanipulasi (800x800) dan diunggah!')->with('image', $path);
        }

        return back()->with('error', 'Gagal mengunggah gambar.');
    }
}
