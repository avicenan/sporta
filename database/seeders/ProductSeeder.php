<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Adidas Bola Lapangan - Hitam',
                'category_id' => 1,
                'stock' => 25,
                'price' => 210000,
                'photo' => 'uploads/adidas_bola_lapangan.jpg',
                'description' => 'Bola lapangan berkualitas tinggi dari Adidas.',
                'status' => 'aktif',
            ],
            [
                'name' => 'Nike Sepatu Olahraga - Putih',
                'category_id' => 2,
                'stock' => 50,
                'price' => 750000,
                'photo' => 'uploads/nike_sepatu_olahraga.jpg',
                'description' => 'Sepatu olahraga ringan dan nyaman dari Nike.',
                'status' => 'aktif',
            ],
            [
                'name' => 'Jersey Timnas Indonesia - Merah',
                'category_id' => 3,
                'stock' => 100,
                'price' => 150000,
                'photo' => 'uploads/jersey_timnas.jpg',
                'description' => 'Jersey resmi tim nasional Indonesia.',
                'status' => 'aktif',
            ],
            // Add more products here...
            [
                'name' => 'Spalding Bola Basket - Oranye',
                'category_id' => 4,
                'stock' => 30,
                'price' => 320000,
                'photo' => 'uploads/spalding_basket.jpg',
                'description' => 'Bola basket standar FIBA dari Spalding.',
                'status' => 'aktif',
            ],
            [
                'name' => 'Yonex Raket Badminton - Biru',
                'category_id' => 5,
                'stock' => 40,
                'price' => 450000,
                'photo' => 'uploads/yonex_raket.jpg',
                'description' => 'Raket badminton berkualitas tinggi dari Yonex.',
                'status' => 'aktif',
            ],
            // Add 10 more products to reach a total of 15
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
