<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Default Administrator
        User::updateOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Administrator Asset',
                'password' => Hash::make('password123'),
                'is_admin' => true,
            ]
        );

        // 2. Seed Realistic Catalog Items
        $items = [
            [
                'name' => 'Kamera DSLR Canon EOS 80D + Lensa 18-135mm',
                'code' => 'CMR-001',
                'category' => 'Multimedia',
                'description' => 'Kamera semi-profesional resolusi 24.2 MP dengan Dual Pixel CMOS AF. Cocok untuk liputan acara, dokumentasi, dan video pembuatan konten.',
                'total_stock' => 4,
                'available_stock' => 3,
                'icon' => 'camera',
                'status' => 'available',
            ],
            [
                'name' => 'Laptop ASUS ROG Strix G15 (Ryzen 7 / RTX 3060)',
                'code' => 'LPT-002',
                'category' => 'Elektronik',
                'description' => 'Laptop performa tinggi dengan RAM 16GB dan SSD 1TB. Siap digunakan untuk rendering video, desain 3D, dan komputasi berat kegiatan.',
                'total_stock' => 5,
                'available_stock' => 4,
                'icon' => 'laptop',
                'status' => 'available',
            ],
            [
                'name' => 'Proyektor Epson EB-X500 3600 Lumens HDMI',
                'code' => 'PRJ-003',
                'category' => 'Presentasi',
                'description' => 'Proyektor ruang rapat & aula dengan kecerahan tinggi 3600 ANSI lumens, resolusi XGA, dan konektivitas HDMI / VGA lengkap.',
                'total_stock' => 6,
                'available_stock' => 5,
                'icon' => 'projector',
                'status' => 'available',
            ],
            [
                'name' => 'Wireless Microphone RÃ˜DE Wireless GO II Dual',
                'code' => 'MIC-004',
                'category' => 'Audio',
                'description' => 'Set mic wireless 2 pemancar + 1 receiver, jangkauan 200 meter, output audio jernih langsung ke kamera atau smartphone.',
                'total_stock' => 6,
                'available_stock' => 6,
                'icon' => 'microphone',
                'status' => 'available',
            ],
            [
                'name' => 'Drone DJI Mini 3 Pro 4K HDR + Smart Controller',
                'code' => 'DRN-005',
                'category' => 'Multimedia',
                'description' => 'Drone lipat portabel dengan sensor rintangan 3 arah, durasi terbang hingga 34 menit, perekaman vertikal murni 4K.',
                'total_stock' => 2,
                'available_stock' => 1,
                'icon' => 'drone',
                'status' => 'available',
            ],
            [
                'name' => 'Portable Party Speaker JBL PartyBox 110 (160W)',
                'code' => 'SPK-006',
                'category' => 'Audio',
                'description' => 'Speaker outdoor bertenaga dengan dynamic light show, baterai tahan 12 jam, bass mendalam, dan input gitar/mic.',
                'total_stock' => 3,
                'available_stock' => 3,
                'icon' => 'speaker',
                'status' => 'available',
            ],
            [
                'name' => 'Tripod Fluid Head Manfrotto Video Professional',
                'code' => 'ACC-007',
                'category' => 'Aksesoris',
                'description' => 'Tripod kokoh berbahan aluminium dengan fluid head untuk pergerakan pan dan tilt yang sangat halus dan stabil.',
                'total_stock' => 8,
                'available_stock' => 7,
                'icon' => 'tripod',
                'status' => 'available',
            ],
            [
                'name' => 'Kabel Roll Sambungan Listrik Uticon 25 Meter',
                'code' => 'KBL-008',
                'category' => 'Kelengkapan',
                'description' => 'Kabel gulung industri tebal dengan 4 soket arde tembaga dan sekring pengaman otomatis panas berlebih.',
                'total_stock' => 10,
                'available_stock' => 10,
                'icon' => 'cable',
                'status' => 'available',
            ],
        ];

        foreach ($items as $itemData) {
            Item::updateOrCreate(['code' => $itemData['code']], $itemData);
        }

        // 3. Seed Sample Loans for immediate demonstration
        $canon = Item::where('code', 'CMR-001')->first();
        $laptop = Item::where('code', 'LPT-002')->first();
        $tripod = Item::where('code', 'ACC-007')->first();

        if ($canon) {
            Loan::updateOrCreate(
                ['loan_code' => 'PJ-10293'],
                [
                    'item_id' => $canon->id,
                    'nickname' => 'Budi',
                    'borrower_name' => 'Budi Santoso',
                    'phone_number' => '081234567890',
                    'email' => 'budi.santoso@gmail.com',
                    'quantity' => 1,
                    'borrow_date' => now()->toDateString(),
                    'return_date' => now()->addDays(3)->toDateString(),
                    'purpose' => 'Dokumentasi kegiatan seminar nasional mahasiswa di aula utama.',
                    'status' => 'approved',
                    'admin_notes' => 'Disetujui. Harap menjaga kelengkapan lensa dan tas kamera.',
                ]
            );
        }

        if ($laptop) {
            Loan::updateOrCreate(
                ['loan_code' => 'PJ-45812'],
                [
                    'item_id' => $laptop->id,
                    'nickname' => 'Siti',
                    'borrower_name' => 'Siti Rahmawati',
                    'phone_number' => '085712349988',
                    'email' => 'siti.rahma@gmail.com',
                    'quantity' => 1,
                    'borrow_date' => now()->addDay()->toDateString(),
                    'return_date' => now()->addDays(4)->toDateString(),
                    'purpose' => 'Presentasi lomba karya tulis ilmiah dan demo software aplikasi.',
                    'status' => 'pending',
                    'admin_notes' => null,
                ]
            );
        }

        if ($tripod) {
            Loan::updateOrCreate(
                ['loan_code' => 'PJ-88321'],
                [
                    'item_id' => $tripod->id,
                    'nickname' => 'Rizky',
                    'borrower_name' => 'Rizky Pratama',
                    'phone_number' => '082198765432',
                    'email' => 'rizky.pratama@gmail.com',
                    'quantity' => 1,
                    'borrow_date' => now()->subDays(5)->toDateString(),
                    'return_date' => now()->subDay()->toDateString(),
                    'purpose' => 'Shooting video teaser promosi Dies Natalis.',
                    'status' => 'returned',
                    'admin_notes' => 'Barang telah dikembalikan dalam kondisi bersih dan lengkap.',
                ]
            );
        }
    }
}