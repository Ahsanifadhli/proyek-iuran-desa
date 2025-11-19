<?php

namespace Database\Seeders;

use App\Models\Warga;
use App\Models\Rt;
use Illuminate\Database\Seeder;

class WargaSeeder extends Seeder
{
    /**
     * Jalankan seeder database.
     */
    public function run(): void
    {
        // 1. Warga Budi (User ID 2)
        Warga::create([
            'id_warga' => 3,
            'id_user' => 2, // Relasi ke User Budi
            'id_rt' => 1,
        ]);

        // 2. Warga Hanako (User ID 3)
        Warga::create([
            'id_warga' => 4, // ID Warga baru
            'id_user' => 3,  // Relasi ke User Hanako
            'id_rt' => 1,    // Masukkan ke RT yang sama
        ]);

        // 3. Warga Ogura (User ID 4)
        Warga::create([
            'id_warga' => 5, // ID Warga baru
            'id_user' => 4,  // Relasi ke User Ogura
            'id_rt' => 1,    // Masukkan ke RT yang sama
        ]);
    }
}
