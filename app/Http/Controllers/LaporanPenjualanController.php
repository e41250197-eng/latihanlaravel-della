<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanPenjualanController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        // Data array statis untuk rekap statistik
        $statistik = [
            'total_transaksi' => 128,
            'total_pendapatan' => 18750000,
            'produk_terlaris' => 'Laptop ThinkPad',
            'pelanggan_baru' => 34,
        ];

        return view('laporan_penjualan', compact('statistik'));
    }
}
