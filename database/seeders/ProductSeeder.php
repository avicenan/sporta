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
                'code' => date('YmdHis') . '1',
                'name' => 'Adidas Bola Lapangan - Hitam',
                'category_id' => 1,
                'stock' => 25,
                'price' => 210000,
                'photo' => 'uploads/adidas_bola_lapangan.jpg',
                'description' => 'Bola lapangan berkualitas tinggi dari Adidas.',
                'status' => 'aktif',
            ],
            [
                'code' => date('YmdHis') . '2',
                'name' => 'Nike Sepatu Olahraga - Putih',
                'category_id' => 2,
                'stock' => 50,
                'price' => 750000,
                'photo' => 'uploads/nike_sepatu_olahraga.jpg',
                'description' => 'Sepatu olahraga ringan dan nyaman dari Nike.',
                'status' => 'aktif',
            ],
            // Add more products here...
            [
                'code' => date('YmdHis') . '3',
                'name' => 'Jersey Timnas Indonesia - Merah',
                'category_id' => 3,
                'stock' => 100,
                'price' => 150000,
                'photo' => 'uploads/jersey_timnas.jpg',
                'description' => 'Jersey resmi tim nasional Indonesia.',
                'status' => 'aktif',
            ],
            [
                'code' => date('YmdHis') . '4',
                'name' => 'Spalding Bola Basket - Oranye',
                'category_id' => 4,
                'stock' => 30,
                'price' => 320000,
                'photo' => 'uploads/spalding_basket.jpg',
                'description' => 'Bola basket standar FIBA dari Spalding.',
                'status' => 'aktif',
            ],
            [
                'code' => date('YmdHis') . '5',
                'name' => 'Yonex Raket Badminton - Biru',
                'category_id' => 5,
                'stock' => 40,
                'price' => 450000,
                'photo' => 'uploads/yonex_raket.jpg',
                'description' => 'Raket badminton berkualitas tinggi dari Yonex.',
                'status' => 'aktif',
            ],
            // Add 10 more products to reach a total of 15
            [
                'code' => date('YmdHis') . '6',
                'name' => 'Adidas Bola Lapangan - Hitam',
                'category_id' => 1,
                'stock' => 25,
                'price' => 210000,
                'photo' => 'uploads/adidas_bola_lapangan.jpg',
                'description' => 'Bola lapangan berkualitas tinggi dari Adidas.',
                'status' => 'aktif',
            ],
            [
                'code' => date('YmdHis') . '7',
                'name' => 'Nike Sepatu Olahraga - Putih',
                'category_id' => 2,
                'stock' => 50,
                'price' => 750000,
                'photo' => 'uploads/nike_sepatu_olahraga.jpg',
                'description' => 'Sepatu olahraga ringan dan nyaman dari Nick.',
                'status' => 'aktif',
            ],
            [
                'code' => date('YmdHis') . '8',
                'name' => 'Jersey Timnas Indonesia - Merah',
                'category_id' => 3,
                'stock' => 100,
                'price' => 150000,
                'photo' => 'uploads/jersey_timnas.jpg',
                'description' => 'Jersey resmi tim nasional Indonesia.',
                'status' => 'aktif',
            ],
            [
                'code' => date('YmdHis') . '9',
                'name' => 'Spalding Bola Basket - Oranye',
                'category_id' => 4,
                'stock' => 30,
                'price' => 320000,
                'photo' => 'uploads/spalding_basket.jpg',
                'description' => 'Bola basket standar FIBA dari Spalding.',
                'status' => 'aktif',
            ],
            [
                'code' => date('YmdHis') . '10',
                'name' => 'Yonex Raket Badminton - Biru',
                'category_id' => 5,
                'stock' => 40,
                'price' => 450000,
                'photo' => 'uploads/yonex_raket.jpg',
                'description' => 'Raket badminton berkualitas tinggi dari Yonex.',
                'status' => 'aktif',
            ],
            [
                'code' => date('YmdHis') . '11',
                'name' => 'Adidas Bola Lapangan - Hitam',
                'category_id' => 1,
                'stock' => 25,
                'price' => 210000,
                'photo' => 'uploads/adidas_bola_lapangan.jpg',
                'description' => 'Bola lapangan berkualitas tinggi dari Adidas.',
                'status' => 'aktif',
            ],
            [
                'code' => date('YmdHis') . '12',
                'name' => 'Nike Sepatu Olahraga - Putih',
                'category_id' => 2,
                'stock' => 50,
                'price' => 750000,
                'photo' => 'uploads/nike_sepatu_olahraga.jpg',
                'description' => 'Sepatu olahraga ringan dan nyaman dari Nike.',
                'status' => 'aktif',
            ],
            [
                'code' => date('YmdHis') . '13',
                'name' => 'Jersey Timnas Indonesia - Merah',
                'category_id' => 3,
                'stock' => 100,
                'price' => 150000,
                'photo' => 'uploads/jersey_timnas.jpg',
                'description' => 'Jersey resmi tim nasional Indonesia.',
                'status' => 'aktif',
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
