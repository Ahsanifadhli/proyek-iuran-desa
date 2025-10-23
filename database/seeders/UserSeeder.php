<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // <-- 1. Panggil Model User
use Illuminate\Support\Facades\Hash; // <-- 2. Panggil Hash untuk enkripsi password

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Kita akan menggunakan 'firstOrCreate'
        // Ini akan mengecek apakah user dgn 'username' tsb sudah ada.
        // Jika belum, baru akan dibuat. Ini mencegah duplikat.

        // 1. Buat User Admin
        User::firstOrCreate(
            ['username' => 'admin'], // Kunci untuk mengecek
            [
                'nama_lengkap' => 'Administrator Web',
                'password' => Hash::make('123456'), // Password: 123456
                'role' => 'Admin',
                'email' => 'admin@iuran.com',
                'is_active' => 1
            ]
        );

        // 2. Buat User RT
        User::firstOrCreate(
            ['username' => 'rt01'], // Kunci untuk mengecek
            [
                'nama_lengkap' => 'Bapak RT 01',
                'password' => Hash::make('123456'), // Password: 123456
                'role' => 'RT',
                'email' => 'rt01@iuran.com',
                'is_active' => 1
            ]
        );

        // 3. Buat User RW
        User::firstOrCreate(
            ['username' => 'rw01'], // Kunci untuk mengecek
            [
                'nama_lengkap' => 'Bapak RW 01',
                'password' => Hash::make('123456'), // Password: 123456
                'role' => 'RW',
                'email' => 'rw01@iuran.com',
                'is_active' => 1
            ]
        );

        // 4. Buat User Warga
        User::firstOrCreate(
            ['username' => 'warga1'], // Kunci untuk mengecek
            [
                'nama_lengkap' => 'Warga Biasa 1',
                'password' => Hash::make('123456'), // Password: 123456
                'role' => 'Warga',
                'email' => 'warga1@iuran.com',
                'is_active' => 1
            ]
        );

        // Anda bisa tambahkan data dummy lainnya di sini
    }
}
