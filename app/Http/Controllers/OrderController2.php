<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\OrderPlaced;

class OrderController2 extends Controller
{
    // Menampilkan halaman antarmuka penerima notifikasi real-time
    public function index()
    {
        return view('acara32_reverb');
    }

    // Trigger event broadcast saat transaksi dibuat
    public function store(Request $request)
    {
        $order = (object) [
            'id'    => rand(100, 999),
            'total' => 2500000
        ];

        $user = (object) [
            'id'   => 1,
            'name' => 'Della Gita Permata'
        ];

        // Memicu Event Broadcast ke Reverb
        event(new OrderPlaced($order,$user));

        return response()->json([
            'status'  => 'Sukses',
            'pesan'   => 'Pesanan #' . $order->id . ' berhasil dibuat & event dibroadcast!',
            'data'    => $order
        ]);
    }
}
