<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('suppliers')->insert([
            [
                'name' => 'PT Indofood Sukses Makmur',
                'phone' => '081234567890',
                'address' => 'Jl. Sudirman Kav. 10, Jakarta Selatan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'PT Unilever Indonesia',
                'phone' => '081298765432',
                'address' => 'Green Office Park BSD City, Tangerang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'PT Mayora Indah',
                'phone' => '081311223344',
                'address' => 'Jl. Tomang Raya No. 21, Jakarta Barat',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
