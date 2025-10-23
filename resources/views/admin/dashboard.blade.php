{{-- 1. Menggunakan layout induk admin --}}
@extends('admin.layouts.app')

{{-- 2. Mengatur judul halaman --}}
@section('title', 'Dashboard Utama')

{{-- 3. Mengisi konten halaman --}}
@section('content')

<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard</h1>
    {{-- Mengganti sintaks PHP date() dengan Blade --}}
    <p class="text-muted">Ringkasan data sistem iuran warga untuk bulan {{ date('F Y') }}.</p>

    <div class="row g-4 mb-4">

        <div class="col-md-3">
            <div class="card border-start border-primary border-4 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>

                            <p class="mb-0 text-muted">Total RW</p>
                        </div>
                        <i class="fas fa-map-marked-alt fa-2x text-primary opacity-25"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-start border-success border-4 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>

                            <p class="mb-0 text-muted">Total RT</p>
                        </div>
                        <i class="fas fa-building fa-2x text-success opacity-25"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-start border-info border-4 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            {{-- INI PERBAIKAN 1: Menggunakan variabel formatted --}}

                            <p class="mb-0 text-muted">Jumlah Warga Aktif</p>
                        </div>
                        <i class="fas fa-users fa-2x text-info opacity-25"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-start border-warning border-4 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            {{-- (Ini sudah benar dari sebelumnya) --}}

                            <p class="mb-0 text-muted">Iuran Bulan Ini</p>
                        </div>
                        <i class="fas fa-dollar-sign fa-2x text-warning opacity-25"></i>
                    </div>
                </div>
            </div>
        </div>

    </div> <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="fas fa-chart-bar me-2"></i>Grafik Pemasukan Iuran per RW (Bulan Ini)</h5>
                </div>
                <div class="card-body">
                    {{-- Mengganti sintaks if-else PHP dengan @if-@else Blade --}}
                    @if (empty($chart_data))
                        <div class="alert alert-warning text-center">Belum ada data pembayaran untuk bulan ini.</div>
                    @else
                        <canvas id="iuranChart"></canvas>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
{{-- AKHIR SECTION KONTEN --}}


{{-- 4. Memasukkan JS khusus halaman ini ke "slot" @stack('scripts') --}}

