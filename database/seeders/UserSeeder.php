<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Yoga Prastyo',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin'),
                'role' => 'owner',
            ],
            [
                'name' => 'Haydar Amru',
                'email' => 'haydar@gmail.com',
                'password' => Hash::make('haydaramru'),
                'role' => 'manager',
            ],
            [
                'name' => 'Wildan Ardi',
                'email' => 'ardi@gmail.com',
                'password' => Hash::make('ardi'),
                'role' => 'cashier',
            ],
        ];

        foreach ($users as $user) {
            User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => $user['password'],
                'role' => $user['role'],
            ]);
        }
    }
}
