<?php

namespace App\Imports;

use App\Models\JenisIuran;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow; // <-- 1. Tambahkan ini

class JenisIuranImport implements ToModel, WithHeadingRow // <-- 2. Tambahkan ini
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // 3. Ini adalah logikanya.
        // File Excel-mu HARUS punya judul kolom 'nama_iuran' dan 'default_jumlah'

        // Kita pakai firstOrCreate (seperti di Seeder-mu) agar aman,
        // tidak ada data iuran yang duplikat.
        return JenisIuran::firstOrCreate(
            ['nama_iuran' => $row['nama_iuran']], // Cek berdasarkan nama iuran
            ['default_jumlah' => $row['default_jumlah'] ?? 0] // Buat baru jika belum ada
        );
    }
}
