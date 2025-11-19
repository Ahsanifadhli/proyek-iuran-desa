<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Jalankan seeder database.
     */
    public function run(): void
    {
        // 1. User Admin/Pencatat (ID: 1) - Digunakan sebagai 'Dicatat Oleh' di pembayaran
        User::create([
            'id_user' => 1,
            'nama_lengkap' => 'Admin Pencatat',
            'username' => 'admin',
            'email' => 'admin@rtku.id',
            'password' => Hash::make('password'),
            'role' => 'Admin',
            'is_active' => true,
        ]);

        // 2. User Biasa (ID: 2) - Untuk Warga yang tidak menjadi pencatat/admin
        User::create([
            'id_user' => 2,
            'nama_lengkap' => 'Budi Setiawan',
            'username' => 'budi',
            'email' => 'budi@rtku.id',
            'password' => Hash::make('password'),
            'role' => 'Warga',
            'is_active' => true,
        ]);

        User::create([
            'id_user' => 3,
            'nama_lengkap' => 'Hanako Suzuka',
            'username' => 'hanako',
            'email' => 'hanako@rtku.id',
            'password' => Hash::make('password'),
            'role' => 'Warga',
            'is_active' => true,
        ]);

        User::create([
            'id_user' => 4,
            'nama_lengkap' => 'Ogura Tatsumi',
            'username' => 'ogura',
            'email' => 'ogura@rtku.id',
            'password' => Hash::make('password'),
            'role' => 'Warga',
            'is_active' => true,
        ]);




    }
}
