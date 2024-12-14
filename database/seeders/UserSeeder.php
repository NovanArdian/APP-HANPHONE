<?php

namespace Database\Seeders;
use App\Models\User;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('admin123'),
        ]);

        User::create([
            'name' => 'Kasir 1',
            'email' => 'kasir@gmail.com',
            'role' => 'kasir',
            'password' => Hash::make('kasir123'),
        ]);
        
    }
}
