<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\Rw;
use App\Models\Rt;
use App\Models\JenisIuran;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanIuranExport;
// PENTING: Jangan lupa baris ini agar fitur Import jalan!
use App\Imports\LaporanIuranImport;

class KelolaIuranController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('start_date', Carbon::now()->startOfMonth()->toDateString());
        $endDate = $request->input('end_date', Carbon::now()->endOfMonth()->toDateString());
        $filterRw = $request->input('rw');
        $filterRt = $request->input('rt');
        $filterIuran = $request->input('iuran');

        $query = Pembayaran::with([
            'warga',
            'warga.rt.rw',
            'jenisIuran',
            'pencatat',
            'warga.user'
        ])
        ->whereBetween('tanggal_bayar', [$startDate, $endDate]);

        if ($filterRw) {
            $query->whereHas('warga.rt.rw', function ($q) use ($filterRw) {
                $q->where('rw.id_rw', $filterRw);
            });
        }
        if ($filterRt) {
            $query->whereHas('warga.rt', function ($q) use ($filterRt) {
                $q->where('rt.id_rt', $filterRt);
            });
        }
        if ($filterIuran) {
            $query->where('id_iuran', $filterIuran);
        }

        $summaryQuery = clone $query;
        $total_pemasukan = $summaryQuery->sum('jumlah_bayar');
        $jumlah_transaksi = $summaryQuery->count();
        $laporanDetail = $query->orderBy('tanggal_bayar', 'desc')->get();

        $data_rw_filter = Rw::orderBy('no_rw')->get();
        $data_rt_filter = Rt::orderBy('no_rt')->get();
        $data_iuran_filter = JenisIuran::orderBy('nama_iuran')->get();

        return view('admin.kelola_iuran', compact(
            'laporanDetail', 'total_pemasukan', 'jumlah_transaksi',
            'data_rw_filter', 'data_rt_filter', 'data_iuran_filter',
            'startDate', 'endDate', 'filterRw', 'filterRt', 'filterIuran'
        ));
    }

    public function exportExcel(Request $request)
    {
        $startDate = $request->input('start_date', Carbon::now()->startOfMonth()->toDateString());
        $endDate = $request->input('end_date', Carbon::now()->endOfMonth()->toDateString());
        $filterRw = $request->input('rw');
        $filterRt = $request->input('rt');
        $filterIuran = $request->input('iuran');

        $query = Pembayaran::with([
            'warga',
            'warga.rt.rw',
            'jenisIuran',
            'pencatat',
            'warga.user'
        ])
        ->whereBetween('tanggal_bayar', [$startDate, $endDate]);

        if ($filterRw) {
            $query->whereHas('warga.rt.rw', function ($q) use ($filterRw) {
                $q->where('rw.id_rw', $filterRw);
            });
        }
        if ($filterRt) {
            $query->whereHas('warga.rt', function ($q) use ($filterRt) {
                $q->where('rt.id_rt', $filterRt);
            });
        }
        if ($filterIuran) {
            $query->where('id_iuran', $filterIuran);
        }

        $laporanDetail = $query->orderBy('tanggal_bayar', 'desc')->get();

        $namaFile = 'laporan_iuran_' . Carbon::now()->format('Y-m-d_His') . '.xlsx';
        return Excel::download(new LaporanIuranExport($laporanDetail), $namaFile);
    }

    // +++ INI YANG TADI HILANG: METHOD IMPORT +++
    public function importExcel(Request $request)
    {
        // 1. Validasi file yang diupload
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        try {
            // 2. Jalankan proses import
            Excel::import(new LaporanIuranImport, $request->file('file'));

            // 3. Sukses
            return redirect()->route('admin.kelola_iuran.index')->with('success', 'Data iuran berhasil diimport!');

        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            // Tangkap error validasi excel (misal: nama warga tidak ada di DB)
            $failures = $e->failures();

            $errors = [];
            foreach ($failures as $failure) {
                $errors[] = "Baris ke-{$failure->row()} (Kolom {$failure->attribute()}): {$failure->errors()[0]}";
            }

            return redirect()->route('admin.kelola_iuran.index')
                             ->with('error', 'Gagal mengimport data! Terdapat kesalahan pada file Excel.')
                             ->with('import_errors', $errors);
        } catch (\Exception $e) {
            // Tangkap error umum lain
            return redirect()->route('admin.kelola_iuran.index')->with('error', 'Gagal import: ' . $e->getMessage());
        }
    }
}
