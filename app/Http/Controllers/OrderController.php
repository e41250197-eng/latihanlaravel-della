<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    public function invoice($id = 1)
    {
        // Simulasi data invoice agar langsung bisa dicetak tanpa error relasi database
        $invoice = (object) [
            'id' => $id,
            'created_at' => now(),
            'items' => [
                (object) [
                    'name' => 'Laptop Dell Latitude 5320',
                    'price' => 5000000,
                    'quantity' => 1,
                    'total' => 5000000
                ],
                (object) [
                    'name' => 'Mouse Wireless',
                    'price' => 300000,
                    'quantity' => 2,
                    'total' => 600000
                ]
            ],
            'total' => 5600000
        ];

        // Generate dokumen PDF dari Blade View
        $pdf = Pdf::loadView('invoices.invoice', ['invoice' => $invoice]);

        // Mengunduh / menampilkan file PDF invoice
        return $pdf->stream('invoice_' . $invoice->id . '.pdf');
    }
}
