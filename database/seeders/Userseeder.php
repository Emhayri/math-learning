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
        User::create([
            'name' => 'Admin',
            'email' => 'Admin@example.com',
            'password' => Hash::make('admin123'), // ganti 'password' dengan password yang Anda inginkan
            'role' => 'Admin', // pastikan kolom 'role' ada di tabel users, atau sesuaikan dengan struktur Anda
        ]);
    }
}
