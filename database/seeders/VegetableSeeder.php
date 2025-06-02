<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vegetable;

class VegetableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vegetables = [
            [
                'name' => 'Tomat Segar',
                'price' => 15.00,
                'description' => 'Tomat segar berkualitas tinggi, cocok untuk masakan sehari-hari.',
                'quality' => 'Grade A',
                'image' => 'tomato.jpg',
                'category' => 'Sayuran Buah',
                'origin' => 'Bandung',
                'status' => 'Fresh',
                'unit' => 'kg'
            ],
            [
                'name' => 'Bayam Hijau',
                'price' => 8.00,
                'description' => 'Bayam hijau segar kaya akan zat besi dan vitamin.',
                'quality' => 'Premium',
                'image' => 'spinach.jpg',
                'category' => 'Sayuran Hijau',
                'origin' => 'Bogor',
                'status' => 'Fresh',
                'unit' => 'kg'
            ],
            [
                'name' => 'Wortel Orange',
                'price' => 12.00,
                'description' => 'Wortel segar dengan kandungan vitamin A tinggi.',
                'quality' => 'Grade A',
                'image' => 'carrot.jpg',
                'category' => 'Sayuran Akar',
                'origin' => 'Dieng',
                'status' => 'Fresh',
                'unit' => 'kg'
            ],
            [
                'name' => 'Brokoli Hijau',
                'price' => 25.00,
                'description' => 'Brokoli segar dengan nutrisi lengkap untuk kesehatan keluarga.',
                'quality' => 'Premium',
                'image' => 'broccoli.jpg',
                'category' => 'Sayuran Hijau',
                'origin' => 'Lembang',
                'status' => 'Fresh',
                'unit' => 'kg'
            ],
            [
                'name' => 'Kentang Lokal',
                'price' => 10.00,
                'description' => 'Kentang lokal berkualitas, cocok untuk berbagai olahan.',
                'quality' => 'Grade B',
                'image' => 'potato.jpg',
                'category' => 'Sayuran Akar',
                'origin' => 'Garut',
                'status' => 'Fresh',
                'unit' => 'kg'
            ],
            [
                'name' => 'Cabai Rawit',
                'price' => 45.00,
                'description' => 'Cabai rawit segar dengan tingkat kepedasan tinggi.',
                'quality' => 'Premium',
                'image' => 'chili.jpg',
                'category' => 'Sayuran Buah',
                'origin' => 'Lombok',
                'status' => 'Fresh',
                'unit' => 'kg'
            ],
            [
                'name' => 'Kangkung Darat',
                'price' => 6.00,
                'description' => 'Kangkung darat segar, mudah diolah untuk tumisan.',
                'quality' => 'Grade A',
                'image' => 'kangkung.jpg',
                'category' => 'Sayuran Hijau',
                'origin' => 'Tangerang',
                'status' => 'Fresh',
                'unit' => 'kg'
            ],
            [
                'name' => 'Bawang Merah',
                'price' => 30.00,
                'description' => 'Bawang merah segar dengan aroma khas dan rasa yang tajam.',
                'quality' => 'Premium',
                'image' => 'onion.jpg',
                'category' => 'Sayuran Bumbu',
                'origin' => 'Brebes',
                'status' => 'Fresh',
                'unit' => 'kg'
            ],
        ];

        foreach ($vegetables as $vegetable) {
            Vegetable::create($vegetable);
        }
    }
}
