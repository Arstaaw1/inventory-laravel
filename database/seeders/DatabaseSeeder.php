<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Buat User Admin
        User::factory()->create([
            'name' => 'Admin Inventory',
            'email' => 'admin@gmail.com',
        ]);

        // Kategori Realistis
        $categories = ['Elektronik', 'Pakaian', 'Makanan & Minuman', 'Aksesori'];
        foreach ($categories as $cat) {
            Category::create(['name' => $cat]);
        }

        // Contoh Produk Realistis
        $products = [
            ['category_id' => 1, 'sku' => 'ELK-001', 'name' => 'Laptop Asus Vivobook 14', 'price' => 8500000, 'stock' => 15, 'minimum_stock' => 5],
            ['category_id' => 1, 'sku' => 'ELK-002', 'name' => 'Mouse Wireless Logitech', 'price' => 150000, 'stock' => 3, 'minimum_stock' => 5],
            ['category_id' => 2, 'sku' => 'PAK-001', 'name' => 'Kemeja Polos Hitam XL', 'price' => 120000, 'stock' => 50, 'minimum_stock' => 10],
            ['category_id' => 3, 'sku' => 'MKN-001', 'name' => 'Kopi Arabika 250g', 'price' => 65000, 'stock' => 2, 'minimum_stock' => 5],
            ['category_id' => 4, 'sku' => 'AKS-001', 'name' => 'Tas BackPack Canvas', 'price' => 210000, 'stock' => 20, 'minimum_stock' => 5],
        ];

        foreach ($products as $prod) {
            Product::create($prod);
        }
    }
}