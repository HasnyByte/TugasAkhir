<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Fresh Fruit
        $freshFruits = [
            [
                'name' => 'Apel Malang',
                'description' => 'Apel segar dari Malang dengan rasa manis dan tekstur renyah',
                'price' => 25000,
                'category' => 'Fresh Fruit',
                'quality' => 'Premium',
                'origin' => 'Malang, Jawa Timur',
                'status' => 'Available',
                'unit' => 'kg',
                'image' => 'apel_malang.jpg',
                'stock_quantity' => 50
            ],
            [
                'name' => 'Jeruk Pontianak',
                'description' => 'Jeruk manis khas Pontianak dengan kandungan vitamin C tinggi',
                'price' => 20000,
                'category' => 'Fresh Fruit',
                'quality' => 'Fresh',
                'origin' => 'Pontianak, Kalimantan Barat',
                'status' => 'Available',
                'unit' => 'kg',
                'image' => 'jeruk_pontianak.jpg',
                'stock_quantity' => 75
            ],
            [
                'name' => 'Pisang Cavendish',
                'description' => 'Pisang cavendish matang sempurna, cocok untuk konsumsi langsung',
                'price' => 15000,
                'category' => 'Fresh Fruit',
                'quality' => 'Fresh',
                'origin' => 'Lampung',
                'status' => 'Available',
                'unit' => 'sisir',
                'image' => 'pisang_cavendish.jpg',
                'stock_quantity' => 100
            ],
            [
                'name' => 'Mangga Harum Manis',
                'description' => 'Mangga harum manis dengan daging buah tebal dan manis',
                'price' => 35000,
                'category' => 'Fresh Fruit',
                'quality' => 'Premium',
                'origin' => 'Cirebon, Jawa Barat',
                'status' => 'Available',
                'unit' => 'kg',
                'image' => 'mangga_harum_manis.jpg',
                'stock_quantity' => 30
            ],
            [
                'name' => 'Anggur Hijau',
                'description' => 'Anggur hijau segar tanpa biji, rasa manis dan segar',
                'price' => 45000,
                'category' => 'Fresh Fruit',
                'quality' => 'Premium',
                'origin' => 'Import',
                'status' => 'Available',
                'unit' => 'kg',
                'image' => 'anggur_hijau.jpg',
                'stock_quantity' => 25
            ]
        ];

        // Fresh Vegetables
        $freshVegetables = [
            [
                'name' => 'Bayam Hijau',
                'description' => 'Bayam segar kaya akan zat besi dan vitamin A',
                'price' => 8000,
                'category' => 'Fresh Vegetables',
                'quality' => 'Fresh',
                'origin' => 'Bandung, Jawa Barat',
                'status' => 'Available',
                'unit' => 'ikat',
                'image' => 'bayam_hijau.jpg',
                'stock_quantity' => 80
            ],
            [
                'name' => 'Kangkung',
                'description' => 'Kangkung segar untuk tumisan dan berbagai masakan',
                'price' => 6000,
                'category' => 'Fresh Vegetables',
                'quality' => 'Fresh',
                'origin' => 'Bogor, Jawa Barat',
                'status' => 'Available',
                'unit' => 'ikat',
                'image' => 'kangkung.jpg',
                'stock_quantity' => 90
            ],
            [
                'name' => 'Wortel',
                'description' => 'Wortel segar kaya beta karoten untuk kesehatan mata',
                'price' => 12000,
                'category' => 'Fresh Vegetables',
                'quality' => 'Fresh',
                'origin' => 'Dieng, Jawa Tengah',
                'status' => 'Available',
                'unit' => 'kg',
                'image' => 'wortel.jpg',
                'stock_quantity' => 60
            ],
            [
                'name' => 'Tomat Segar',
                'description' => 'Tomat merah segar untuk masakan dan salad',
                'price' => 18000,
                'category' => 'Fresh Vegetables',
                'quality' => 'Premium',
                'origin' => 'Berastagi, Sumatera Utara',
                'status' => 'Available',
                'unit' => 'kg',
                'image' => 'tomat_segar.jpg',
                'stock_quantity' => 70
            ],
            [
                'name' => 'Brokoli',
                'description' => 'Brokoli segar kaya akan vitamin C dan serat',
                'price' => 22000,
                'category' => 'Fresh Vegetables',
                'quality' => 'Premium',
                'origin' => 'Lembang, Jawa Barat',
                'status' => 'Available',
                'unit' => 'kg',
                'image' => 'brokoli.jpg',
                'stock_quantity' => 40
            ]
        ];

        // Meat & Fish
        $meatFish = [
            [
                'name' => 'Daging Sapi Segar',
                'description' => 'Daging sapi pilihan tanpa lemak, cocok untuk rendang dan steak',
                'price' => 120000,
                'category' => 'Meat & Fish',
                'quality' => 'Premium',
                'origin' => 'Lokal',
                'status' => 'Available',
                'unit' => 'kg',
                'image' => 'daging_sapi.jpg',
                'stock_quantity' => 20
            ],
            [
                'name' => 'Ayam Kampung',
                'description' => 'Ayam kampung segar tanpa bahan kimia',
                'price' => 45000,
                'category' => 'Meat & Fish',
                'quality' => 'Premium',
                'origin' => 'Lokal',
                'status' => 'Available',
                'unit' => 'ekor',
                'image' => 'ayam_kampung.jpg',
                'stock_quantity' => 15
            ],
            [
                'name' => 'Ikan Salmon',
                'description' => 'Ikan salmon segar kaya omega 3',
                'price' => 85000,
                'category' => 'Meat & Fish',
                'quality' => 'Premium',
                'origin' => 'Import',
                'status' => 'Available',
                'unit' => 'kg',
                'image' => 'ikan_salmon.jpg',
                'stock_quantity' => 12
            ],
            [
                'name' => 'Udang Segar',
                'description' => 'Udang segar ukuran sedang untuk berbagai masakan',
                'price' => 65000,
                'category' => 'Meat & Fish',
                'quality' => 'Fresh',
                'origin' => 'Situbondo, Jawa Timur',
                'status' => 'Available',
                'unit' => 'kg',
                'image' => 'udang_segar.jpg',
                'stock_quantity' => 25
            ]
        ];

        // Insert semua data
        foreach ([$freshFruits, $freshVegetables, $meatFish] as $categoryData) {
            foreach ($categoryData as $productData) {
                Product::create($productData);
            }
        }

        // Tambahan produk untuk kategori lainnya
        $otherProducts = [
            // Snacks
            [
                'name' => 'Keripik Singkong',
                'description' => 'Keripik singkong renyah dengan berbagai rasa',
                'price' => 15000,
                'category' => 'Snacks',
                'quality' => 'Fresh',
                'origin' => 'Malang, Jawa Timur',
                'status' => 'Available',
                'unit' => 'pack',
                'image' => 'keripik_singkong.jpg',
                'stock_quantity' => 50
            ],
            [
                'name' => 'Kacang Atom',
                'description' => 'Kacang atom pedas manis untuk cemilan',
                'price' => 12000,
                'category' => 'Snacks',
                'quality' => 'Fresh',
                'origin' => 'Garut, Jawa Barat',
                'status' => 'Available',
                'unit' => 'pack',
                'image' => 'kacang_atom.jpg',
                'stock_quantity' => 60
            ],

            // Eggs & Dairy
            [
                'name' => 'Telur Ayam Kampung',
                'description' => 'Telur ayam kampung organik dengan kandungan protein tinggi',
                'price' => 35000,
                'category' => 'Eggs & Dairy',
                'quality' => 'Premium',
                'origin' => 'Lokal',
                'status' => 'Available',
                'unit' => 'kg',
                'image' => 'telur_kampung.jpg',
                'stock_quantity' => 80
            ],
            [
                'name' => 'Susu Sapi Murni',
                'description' => 'Susu sapi segar tanpa pengawet dan pewarna',
                'price' => 15000,
                'category' => 'Eggs & Dairy',
                'quality' => 'Fresh',
                'origin' => 'Boyolali, Jawa Tengah',
                'status' => 'Available',
                'unit' => 'liter',
                'image' => 'susu_sapi.jpg',
                'stock_quantity' => 30
            ],

            // Bakery & Pastry
            [
                'name' => 'Roti Tawar Gandum',
                'description' => 'Roti tawar gandum sehat tanpa pengawet',
                'price' => 18000,
                'category' => 'Bakery & Pastry',
                'quality' => 'Fresh',
                'origin' => 'Lokal',
                'status' => 'Available',
                'unit' => 'pack',
                'image' => 'roti_gandum.jpg',
                'stock_quantity' => 50
            ],
            [
                'name' => 'Croissant Butter',
                'description' => 'Croissant butter segar dengan lapisan mentega',
                'price' => 8000,
                'category' => 'Bakery & Pastry',
                'quality' => 'Fresh',
                'origin' => 'Lokal',
                'status' => 'Available',
                'unit' => 'pcs',
                'image' => 'croissant_butter.jpg',
                'stock_quantity' => 30
            ],

            // Beverages
            [
                'name' => 'Kopi Arabika Toraja',
                'description' => 'Kopi arabika toraja dengan cita rasa khas',
                'price' => 85000,
                'category' => 'Beverages',
                'quality' => 'Premium',
                'origin' => 'Toraja, Sulawesi Selatan',
                'status' => 'Available',
                'unit' => 'pack',
                'image' => 'kopi_toraja.jpg',
                'stock_quantity' => 30
            ],
            [
                'name' => 'Teh Hijau Organik',
                'description' => 'Teh hijau organik tanpa pestisida',
                'price' => 45000,
                'category' => 'Beverages',
                'quality' => 'Premium',
                'origin' => 'Puncak, Jawa Barat',
                'status' => 'Available',
                'unit' => 'pack',
                'image' => 'teh_hijau.jpg',
                'stock_quantity' => 40
            ],
            [
                'name' => 'Susu Kedelai',
                'description' => 'Susu kedelai segar tanpa gula tambahan',
                'price' => 12000,
                'category' => 'Beverages',
                'quality' => 'Fresh',
                'origin' => 'Lokal',
                'status' => 'Available',
                'unit' => 'botol',
                'image' => 'susu_kedelai.jpg',
                'stock_quantity' => 60
            ],
            [
                'name' => 'Jus Lidah Buaya',
                'description' => 'Jus lidah buaya segar dengan manfaat kesehatan',
                'price' => 18000,
                'category' => 'Beverages',
                'quality' => 'Fresh',
                'origin' => 'Lokal',
                'status' => 'Available',
                'unit' => 'botol',
                'image' => 'jus_lidah_buaya.jpg',
                'stock_quantity' => 45
            ],
        ];
            foreach ($otherProducts as $productData) {
                Product::create($productData);
            }
    }
}

