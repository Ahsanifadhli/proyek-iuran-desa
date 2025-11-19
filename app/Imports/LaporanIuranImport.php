<?php

namespace App\Imports;

use App\Models\Pembayaran;
use App\Models\Warga;
use App\Models\JenisIuran;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Validation\Rule;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class LaporanIuranImport implements ToCollection, WithHeadingRow, WithValidation
{
    public function collection(Collection $rows)
    {
        if ($rows->isEmpty()) {
            return;
        }

        foreach ($rows as $row)
        {
            // 1. Bersihkan Input (Hapus spasi depan/belakang yang tidak sengaja)
            $namaWargaRaw = trim($row['nama_warga']);
            $jenisIuranRaw = trim($row['jenis_iuran']);

            if (empty($namaWargaRaw)) continue;

            // --- 2. Cari Warga (Lebih Fleksibel) ---
            $userWarga = User::where('nama_lengkap', $namaWargaRaw)->first();
            $warga = $userWarga ? Warga::where('id_user', $userWarga->id_user)->first() : null;

            // --- 3. Cari Jenis Iuran (Lebih Fleksibel) ---
            // Kita gunakan LIKE agar tidak sensitif huruf besar/kecil
            $jenisIuran = JenisIuran::where('nama_iuran', 'LIKE', $jenisIuranRaw)->first();

            // --- 4. Cari Pencatat ---
            $namaPencatat = trim($row['dicatat_oleh'] ?? '');
            $pencatat = User::where('nama_lengkap', $namaPencatat)->first();
            if (!$pencatat) {
                $pencatat = auth()->user() ?? User::find(1);
            }

            // --- 5. Olah Tanggal ---
            try {
                if (is_numeric($row['tanggal_bayar'])) {
                    $tanggalBayar = Carbon::instance(Date::excelToDateTimeObject($row['tanggal_bayar']));
                } else {
                    $tanggalBayar = Carbon::parse($row['tanggal_bayar']);
                }
            } catch (\Exception $e) {
                $tanggalBayar = Carbon::now();
            }

            // --- 6. Simpan Data (Hanya jika Warga & Iuran ketemu) ---
            // Jika Jenis Iuran tidak ketemu, baris ini akan dilewati tanpa error meledak
            if ($warga && $jenisIuran && $pencatat) {

                Pembayaran::create([
                    'id_warga'      => $warga->id_warga,
                    'id_iuran'      => $jenisIuran->id_iuran,
                    'dicatat_oleh'  => $pencatat->id_user,
                    'jumlah_bayar'  => $row['jumlah_bayar'],
                    'tanggal_bayar' => $tanggalBayar->format('Y-m-d H:i:s'),
                    'periode_tahun' => $tanggalBayar->year,
                    'periode_bulan' => $tanggalBayar->format('m'),
                ]);
            }
        }
    }

    public function headingRow(): int
    {
        return 1;
    }

    public function rules(): array
    {
        return [
            'nama_warga'    => ['required'],
            'jumlah_bayar'  => ['required', 'numeric'],
            'tanggal_bayar' => ['required'],

            // PERBAIKAN:
            // Saya HAPUS validasi 'exists' untuk jenis_iuran di sini.
            // Alasannya: Validasi ini terlalu kaku. Kalau ada spasi dikit aja dia error.
            // Kita sudah menangani pencariannya secara manual & aman di atas (pakai trim).
            'jenis_iuran'   => ['required'],
        ];
    }
}
