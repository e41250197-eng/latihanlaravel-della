<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
