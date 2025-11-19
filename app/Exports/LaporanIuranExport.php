<?php

namespace App\Exports;

use App\Models\Pembayaran;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;

class LaporanIuranExport implements FromCollection, WithHeadings, WithMapping
{
    protected $laporanDetail;

    public function __construct($laporanDetail)
    {
        $this->laporanDetail = $laporanDetail;
    }

    public function collection()
    {
        return $this->laporanDetail;
    }

    public function headings(): array
    {
        return [
            'ID Bayar',
            'Tanggal Bayar',
            'Nama Warga', // Kolom yang gagal
            'RT',
            'RW',
            'Jenis Iuran',
            'Jumlah Bayar',
            'Dicatat Oleh', // Kolom yang gagal
        ];
    }

    public function map($item): array
    {
        // KUNCI PERBAIKAN FINAL: Mengubah akses kolom dari 'nama' menjadi 'nama_lengkap'
        $namaWarga = $item->warga->user->nama_lengkap ?? 'Data Warga Hilang';
        $namaPencatat = $item->pencatat->nama_lengkap ?? 'Data Pencatat Hilang';

        return [
            $item->id_pembayaran,
            Carbon::parse($item->tanggal_bayar)->format('d-m-Y'),
            $namaWarga,
            $item->warga->rt->no_rt ?? '?',
            $item->warga->rt->rw->no_rw ?? '?',
            $item->jenisIuran->nama_iuran ?? 'Data Iuran Hilang',
            $item->jumlah_bayar,
            $namaPencatat,
        ];
    }
}
