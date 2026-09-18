<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Panggil Seeder bawaan & Supplier
        $this->call([
            UsersTableSeeder::class,
            SupplierSeeder::class,
        ]);

        // 2. Data Kategori & Produk
        $sembako = Category::create([
            'name' => 'Sembako',
            'slug' => 'sembako',
        ]);

        Product::create([
            'category_id' => $sembako->id,
            'name' => 'Beras Pandan Wangi 5kg',
            'sku' => 'BRS-001',
            'price' => 75000,
            'stock' => 20,
        ]);

        Product::create([
            'category_id' => $sembako->id,
            'name' => 'Minyak Goreng Bimoli 2L',
            'sku' => 'MYK-002',
            'price' => 38000,
            'stock' => 15,
        ]);
    }
}
