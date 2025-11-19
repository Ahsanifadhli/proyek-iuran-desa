<?php

namespace Database\Seeders;

use App\Models\Rw;
use Illuminate\Database\Seeder;

class RwSeeder extends Seeder
{
    /**
     * Jalankan seeder database.
     */
    public function run(): void
    {
        Rw::create([
            'id_rw' => 1,
            'no_rw' => '01'
        ]);
    }
}
