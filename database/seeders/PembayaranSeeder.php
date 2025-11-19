<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Pembayaran;
use App\Models\Warga;
use App\Models\User;
use App\Models\JenisIuran;

class PembayaranSeeder extends Seeder
{
    public function run(): void
    {
        $adminUser = User::where('username', 'admin')->first();
        // PERBAIKAN 1: Mengubah 'warga1' menjadi 'budi' sesuai dengan UserSeeder.php
        $wargaUser1 = User::where('username', 'budi')->first();

        // Mencari Warga yang berelasi dengan User ID 'budi'
        $warga1 = Warga::where('id_user', $wargaUser1->id_user ?? 0)->first();

        $iuranKeamanan = JenisIuran::where('nama_iuran', 'Iuran Keamanan')->first();
        $iuranKebersihan = JenisIuran::where('nama_iuran', 'Iuran Kebersihan')->first();

        // Menggunakan nilai tetap (fix) untuk jumlah bayar, sesuai dengan data awal yang Anda inginkan
        $hargaKeamanan = 50000;
        $hargaKebersihan = 30000;


        if ($warga1 && $iuranKeamanan && $adminUser) {
            Pembayaran::firstOrCreate(
                ['id_warga' => $warga1->id_warga, 'id_iuran' => $iuranKeamanan->id_iuran, 'periode_tahun' => 2025, 'periode_bulan' => 11],
                [
                    'dicatat_oleh' => $adminUser->id_user,
                    'tanggal_bayar' => '2025-11-10 09:00:00',
                    // PERBAIKAN 2: Ganti $iuranKeamanan->default_jumlah dengan nilai tetap
                    'jumlah_bayar' => $hargaKeamanan
                ]
            );
        }
        if ($warga1 && $iuranKebersihan && $adminUser) {
            Pembayaran::firstOrCreate(
                ['id_warga' => $warga1->id_warga, 'id_iuran' => $iuranKebersihan->id_iuran, 'periode_tahun' => 2025, 'periode_bulan' => 11],
                [
                    'dicatat_oleh' => $adminUser->id_user,
                    'tanggal_bayar' => '2025-11-11 10:00:00',
                    // PERBAIKAN 2: Ganti $iuranKebersihan->default_jumlah dengan nilai tetap
                    'jumlah_bayar' => $hargaKebersihan
                ]
            );
        }
    }
}
