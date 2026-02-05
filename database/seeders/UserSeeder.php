<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin
        User::create([
            'name' => 'Admin Toko',
            'email' => 'admin@toko.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create Regular User
        User::create([
            'name' => 'Pelanggan Setia',
            'email' => 'user@toko.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        // Create another User
        User::create([
            'name' => 'Pelanggan Baru',
            'email' => 'user2@toko.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);
    }
}
