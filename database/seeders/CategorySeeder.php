<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::insert([
            [
                'name' => 'Sepakbola',
                'icon' => 'sports_soccer',
                'description' => 'Peralatan sepakbola',
                'status' => 'aktif',
            ],
            [
                'name' => 'Renang',
                'icon' => 'pool',
                'description' => 'Peralatan renang',
                'status' => 'aktif',
            ],
            [
                'name' => 'Basket',
                'icon' => 'sports_basketball',
                'description' => 'Peralatan basket',
                'status' => 'aktif',
            ],
            [
                'name' => 'Skate',
                'icon' => 'skateboarding',
                'description' => 'Peralatan skate',
                'status' => 'non-aktif',
            ],
            [
                'name' => 'Rugby',
                'icon' => 'sports_football',
                'description' => 'Peralatan rugby',
                'status' => 'aktif',
            ]
        ]);
    }
}
