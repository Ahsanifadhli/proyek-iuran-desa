<?php

namespace Database\Seeders;

use App\Models\Rt;
use Illuminate\Database\Seeder;

class RtSeeder extends Seeder
{
    /**
     * Jalankan seeder database.
     */
    public function run(): void
    {
        Rt::create([
            'id_rt' => 1,
            'id_rw' => 1, // Mengacu ke RW ID 1
            'no_rt' => '002',
            // Hapus 'deskripsi' karena kolom tidak ditemukan di tabel RT
        ]);
    }
}
