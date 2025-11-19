<?php

namespace Database\Seeders;

use App\Models\JenisIuran;
use Illuminate\Database\Seeder;

class JenisIuranSeeder extends Seeder
{
    /**
     * Jalankan seeder database.
     */
    public function run(): void
    {
        // Iuran ID 1 (digunakan di Pembayaran 2)
        JenisIuran::create([
            'id_iuran' => 1,
            'nama_iuran' => 'Iuran Kebersihan',
            // Hapus 'nominal_iuran' karena kolom ini tidak ada di tabel jenis_iurans Anda
        ]);

        // Iuran ID 2 (digunakan di Pembayaran 1)
        JenisIuran::create([
            'id_iuran' => 2,
            'nama_iuran' => 'Iuran Keamanan',
            // Hapus 'nominal_iuran' karena kolom ini tidak ada di tabel jenis_iurans Anda
        ]);

        JenisIuran::create([
            'id_iuran' => 3,
            'nama_iuran' => 'Iuran Pembangunan',
            // Hapus 'nominal_iuran' karena kolom ini tidak ada di tabel jenis_iurans Anda
        ]);

        JenisIuran::create([
            'id_iuran' => 4,
            'nama_iuran' => 'Iuran Sosial',
            // Hapus 'nominal_iuran' karena kolom ini tidak ada di tabel jenis_iurans Anda
        ]);
    }
}
