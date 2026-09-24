<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['Komputasi & IT', 'Broadcast & Media', 'Ruang & Riset', 'Audio Visual & Acara', 'Perkakas & Pendukung'];
        $itemsData = [];

        for ($i = 1; $i <= 250; $i++) {
            $cat = $categories[array_rand($categories)];
            
            // Randomize stock between 0 and 15 to test closed-loop logic
            $stock = rand(0, 15);
            
            $itemsData[] = [
                'name' => 'Sarpras Unit ' . $cat . ' #' . $i,
                'code' => 'SRP-' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'category' => $cat,
                'description' => 'Aset inventaris untuk ' . $cat . ' nomor ' . $i,
                'total_stock' => $stock,
                'available_stock' => $stock,
                'condition' => 'Baik',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Item::insert($itemsData);
    }
}
