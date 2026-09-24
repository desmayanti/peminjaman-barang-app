<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemSeeder extends Seeder
{
    public function run()
    {
        Item::truncate();

        $categories = ['Elektronik & Laptop', 'Perlengkapan Multimedia', 'IoT & Robotika', 'Kabel & Adaptor', 'Ruangan'];
        $items = [];

        for ($i = 1; $i <= 250; $i++) {
            $stock = rand(0, 15);
            $items[] = [
                'name' => 'Barang Dummy ' . $i,
                'code' => 'DUM-' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'category' => $categories[array_rand($categories)],
                'description' => 'Kondisi: Baik. Deskripsi barang dummy ke-' . $i,
                'total_stock' => $stock,
                'available_stock' => $stock,
                'icon' => '📦',
                'status' => 'Tersedia',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Chunk insert to avoid too many bindings error in SQLite
        foreach (array_chunk($items, 50) as $chunk) {
            Item::insert($chunk);
        }
    }
}
