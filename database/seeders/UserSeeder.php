<?php

namespace Database\Seeders;

use App\Models\Bag;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Hakim - admin',
                'email' => 'admin1@sporta.com',
                'role_id' => 1,
                'bag_id' => 1,
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'Ratna - admin',
                'email' => 'admin2@sporta.com',
                'role_id' => 1,
                'bag_id' => 2,
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'Nina - cashier',
                'email' => 'cashier1@sporta.com',
                'role_id' => 2,
                'bag_id' => 3,
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'Abdul - cashier',
                'email' => 'cashier2@sporta.com',
                'role_id' => 2,
                'bag_id' => 4,
                'password' => bcrypt('password'),
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
