<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;
use Illuminate\Support\Str;

class ItemSeeder extends Seeder
{
    public function run()
    {
        Item::truncate();

        $itemNames = [
            'Proyektor Epson',
            'Kamera DSLR Canon',
            'Tripod Takara',
            'Kabel Roll 10m',
            'Microphone Wireless',
            'Gimbal Stabilizer',
            'Laptop Lenovo Thinkpad',
            'Monitor Dell 24 inch',
            'Ring Light',
            'Green Screen',
            'Audio Mixer',
            'Kabel HDMI 5m',
            'Kabel VGA',
            'Mouse Wireless',
            'Keyboard Mekanikal',
            'Pointer Presentasi',
            'Speaker Aktif',
            'Headset Gaming',
            'Flashdisk 64GB',
            'Hardisk Eksternal 1TB',
            'Kipas Angin Portabel',
            'Lighting Studio',
            'Stand Mic',
            'Layar Proyektor',
            'Tablet Wacom'
        ];

        $categories = ['Elektronik & Laptop', 'Perlengkapan Multimedia', 'Kabel & Adaptor', 'Ruangan'];
        $items = [];

        foreach ($itemNames as $index => $name) {
            $stock = rand(0, 15);
            
            // Buat kode otomatis dari singkatan nama barang
            $words = explode(' ', $name);
            $prefix = strtoupper(substr($words[0], 0, 3));
            $code = $prefix . '-' . str_pad($index + 1, 3, '0', STR_PAD_LEFT);

            $items[] = [
                'name' => $name,
                'code' => $code,
                'category' => $categories[array_rand($categories)],
                'description' => 'Kondisi: Baik. Barang siap digunakan untuk keperluan praktek PPLG.',
                'total_stock' => $stock,
                'available_stock' => $stock,
                'icon' => '📦',
                'status' => 'Tersedia',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        foreach (array_chunk($items, 50) as $chunk) {
            Item::insert($chunk);
        }
    }
}
