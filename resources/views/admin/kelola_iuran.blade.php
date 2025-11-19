@extends('admin.layouts.app')

@section('title', 'Laporan Keuangan')

@section('content')
<div class="container-fluid px-0">

    {{-- Tampilkan Pesan Sukses/Error --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Menampilkan Detail Kegagalan Import (Jika ada validasi Excel yang gagal) --}}
    @if (session('import_errors'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong><i class="fas fa-exclamation-triangle me-2"></i> Gagal Import Sebagian Data:</strong>
            <ul class="mb-0 mt-2 small">
                @foreach (session('import_errors') as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif


    {{-- BAGIAN IMPORT & EXPORT --}}
    <div class="row g-3 mb-4">
        {{-- CARD IMPORT --}}
        <div class="col-md-6">
            <div class="card shadow-sm h-100 border-primary">
                <div class="card-body">
                    <h5 class="card-title mb-2 text-primary"><i class="fas fa-file-excel me-2"></i>Import Data Transaksi</h5>
                    <p class="card-text text-muted small mb-3">
                        Upload file Excel (.xlsx) untuk memasukkan data pembayaran massal.<br>
                        <strong>Kolom Wajib di Excel:</strong> <code>Nama Warga</code>, <code>Jenis Iuran</code>, <code>Tanggal Bayar</code>, <code>Jumlah Bayar</code>.
                    </p>

                    <form action="{{ route('admin.iuran.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="input-group">
                            {{-- PERBAIKAN: name diubah jadi 'file' agar sesuai Controller --}}
                            <input type="file" name="file" class="form-control" required accept=".xlsx, .xls">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-upload me-1"></i> Upload
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- CARD EXPORT --}}
        <div class="col-md-6">
            <div class="card shadow-sm h-100 border-success">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title mb-2 text-success"><i class="fas fa-file-export me-2"></i>Export Laporan</h5>
                    <p class="card-text text-muted small">
                        Download laporan keuangan saat ini (sesuai filter yang dipilih di bawah) menjadi file Excel.
                    </p>
                    {{-- Mengirim query string (filter) saat export agar data sesuai tampilan --}}
                    <a href="{{ route('admin.laporan.export', request()->query()) }}" class="btn btn-success mt-auto w-100">
                        <i class="fas fa-download me-1"></i> Download Excel
                    </a>
                </div>
            </div>
        </div>
    </div>


    {{-- CARD FILTER --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white">
            <h5 class="mb-0 text-secondary"><i class="fas fa-filter me-1"></i> Filter Laporan</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.kelola_iuran.index') }}" method="GET">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label for="start_date" class="form-label small fw-bold">Tanggal Mulai</label>
                        <input type="date" name="start_date" id="start_date" class="form-control" value="{{ $startDate }}">
                    </div>
                    <div class="col-md-3">
                        <label for="end_date" class="form-label small fw-bold">Tanggal Akhir</label>
                        <input type="date" name="end_date" id="end_date" class="form-control" value="{{ $endDate }}">
                    </div>
                    <div class="col-md-2">
                        <label for="rw" class="form-label small fw-bold">RW</label>
                        <select name="rw" id="rw" class="form-select">
                            <option value="">Semua RW</option>
                            @foreach ($data_rw_filter as $rw)
                                <option value="{{ $rw->id_rw }}" @selected($filterRw == $rw->id_rw)>
                                    RW {{ $rw->no_rw }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="rt" class="form-label small fw-bold">RT</label>
                        <select name="rt" id="rt" class="form-select">
                            <option value="">Semua RT</option>
                            @foreach ($data_rt_filter as $rt)
                                <option value="{{ $rt->id_rt }}" @selected($filterRt == $rt->id_rt)>
                                    RT {{ $rt->no_rt }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="iuran" class="form-label small fw-bold">Jenis Iuran</label>
                        <select name="iuran" id="iuran" class="form-select">
                            <option value="">Semua Iuran</option>
                            @foreach ($data_iuran_filter as $iuran)
                                <option value="{{ $iuran->id_iuran }}" @selected($filterIuran == $iuran->id_iuran)>
                                    {{ $iuran->nama_iuran }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-search me-1"></i> Terapkan Filter
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- CARD RINGKASAN --}}
    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <div class="card bg-success text-white shadow border-0">
                <div class="card-body">
                    <h6 class="text-uppercase text-white-50 small">Total Pemasukan</h6>
                    <h3 class="display-6 fw-bold">Rp {{ number_format($total_pemasukan, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card bg-info text-white shadow border-0">
                <div class="card-body">
                    <h6 class="text-uppercase text-white-50 small">Jumlah Transaksi</h6>
                    <h3 class="display-6 fw-bold">{{ number_format($jumlah_transaksi) }}</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- CARD TABEL DETAIL --}}
    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h5 class="mb-0 text-secondary"><i class="fas fa-table me-1"></i> Detail Transaksi</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Tanggal Bayar</th>
                            <th>Nama Warga</th>
                            <th>Wilayah</th>
                            <th>Jenis Iuran</th>
                            <th>Periode</th>
                            <th class="text-end">Jumlah</th>
                            <th>Dicatat Oleh</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($laporanDetail as $row)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($row->tanggal_bayar)->format('d M Y') }}</td>
                                <td>
                                    {{-- Menggunakan nama_lengkap sesuai perbaikan database kita --}}
                                    <span class="fw-bold">{{ $row->warga->user->nama_lengkap ?? 'Data Warga Error' }}</span>
                                </td>
                                <td>RT {{ $row->warga->rt->no_rt ?? '?' }} / RW {{ $row->warga->rt->rw->no_rw ?? '?' }}</td>
                                <td>
                                    <span class="badge bg-info text-dark">{{ $row->jenisIuran->nama_iuran ?? 'Error' }}</span>
                                </td>
                                <td>{{ \Carbon\Carbon::createFromDate($row->periode_tahun, $row->periode_bulan, 1)->format('F Y') }}</td>
                                <td class="text-end fw-bold">Rp {{ number_format($row->jumlah_bayar, 0, ',', '.') }}</td>
                                <td class="small text-muted">{{ $row->pencatat->nama_lengkap ?? 'Error' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">
                                    <i class="fas fa-folder-open fa-3x mb-3"></i><br>
                                    Tidak ada data transaksi untuk filter yang dipilih.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination jika ada --}}
            <div class="mt-3">
                 {{-- $laporanDetail->withQueryString()->links() --}}
            </div>
        </div>
    </div>

</div>
@endsection
