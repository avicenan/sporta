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
                'name' => 'Admin1',
                'email' => 'admin1@sporta.com',
                'role_id' => 1,
                'bag_id' => 1,
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'Admin2',
                'email' => 'admin2@sporta.com',
                'role_id' => 1,
                'bag_id' => 2,
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'User1',
                'email' => 'user1@sporta.com',
                'role_id' => 2,
                'bag_id' => 3,
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'User2',
                'email' => 'user2@sporta.com',
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
