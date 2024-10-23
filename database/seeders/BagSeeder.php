<?php

namespace Database\Seeders;

use App\Models\Bag;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // make 4 bags
        for ($i = 0; $i < 4; $i++) {
            Bag::create(
                ['status' => 'aktif']
            );
        }
    }
}
