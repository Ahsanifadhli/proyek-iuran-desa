<?php

namespace App\Exports;

use App\Models\Pembayaran;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;

class PembayaranExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    // Filter-filter yang kita terima dari Controller
    protected $startDate;
    protected $endDate;
    protected $filterRw;
    protected $filterRt;
    protected $filterIuran;

    public function __construct($startDate, $endDate, $filterRw, $filterRt, $filterIuran)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->filterRw = $filterRw;
        $this->filterRt = $filterRt;
        $this->filterIuran = $filterIuran;
    }

    /**
    * @return \Illuminate\Database\Eloquent\Builder
    */
    public function query()
    {
        // 1. Buat query dasar, sama persis seperti di Controller
        $query = Pembayaran::with(['warga.user', 'warga.rt.rw', 'jenisIuran', 'pencatat'])
                         ->whereBetween('tanggal_bayar', [$this->startDate, $this->endDate]);

        // 2. Terapkan filter dinamis, sama persis seperti di Controller
        if ($this->filterRw) {
            $query->whereHas('warga.rt.rw', function ($q) {
                $q->where('rw.id_rw', $this->filterRw);
            });
        }
        if ($this->filterRt) {
            $query->whereHas('warga.rt', function ($q) {
                $q->where('rt.id_rt', $this->filterRt);
            });
        }
        if ($this->filterIuran) {
            $query->where('id_iuran', $this->filterIuran);
        }

        // 3. Kembalikan query yang sudah difilter
        return $query->orderBy('tanggal_bayar', 'desc');
    }

    /**
    * @return array
    */
    public function headings(): array
    {
        // Ini adalah judul kolom di file Excel
        return [
            'Tanggal Bayar',
            'Nama Warga',
            'Wilayah',
            'Jenis Iuran',
            'Periode',
            'Jumlah (Rp)',
            'Dicatat Oleh',
        ];
    }

    /**
    * @var Pembayaran $pembayaran
    */
    public function map($pembayaran): array
    {
        // Ini adalah data yang akan diisi ke setiap baris
        return [
            Carbon::parse($pembayaran->tanggal_bayar)->format('d M Y, H:i'),
            $pembayaran->warga->user->nama_lengkap ?? 'Error',
            'RT ' . ($pembayaran->warga->rt->no_rt ?? '?') . ' / RW ' . ($pembayaran->warga->rt->rw->no_rw ?? '?'),
            $pembayaran->jenisIuran->nama_iuran ?? 'Error',
            Carbon::createFromDate($pembayaran->periode_tahun, $pembayaran->periode_bulan, 1)->format('F Y'),
            $pembayaran->jumlah_bayar,
            $pembayaran->pencatat->nama_lengkap ?? 'Error',
        ];
    }
}
