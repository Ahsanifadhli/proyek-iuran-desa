{{-- 1. Menggunakan layout utama admin --}}
@extends('admin.layouts.app')

{{-- 2. Mengatur judul halaman (Saya sesuaikan judulnya) --}}
@section('title', 'Manajemen Pengguna')

{{-- 3. Mengisi konten halaman --}}
@section('content')

{{--
  CATATAN:
  Struktur seperti <div class="main-content">, <nav>,
  dan <div class="content-wrapper"> tidak diperlukan lagi
  karena sudah ada di file 'admin.layouts.app'.
  Kita hanya perlu mengisi konten unik untuk halaman ini.
--}}

<!-- ======================================================================= -->
<!-- KONTEN UTAMA HALAMAN (HTML)                                           -->
<!-- ======================================================================= -->
<div class="container-fluid px-4">
    {{-- Header Halaman --}}
    <h1 class="mt-4">Manajemen Pengguna</h1>
    <p class="text-muted">Kelola semua data pengguna sistem.</p>

    <!-- FORM UNTUK FILTER DAN PENCARIAN -->
    <div class="card shadow-sm mb-4">
        <div class="card-header">
            <i class="fas fa-filter me-1"></i>
            Filter & Pencarian
        </div>
        <div class="card-body">
            {{--
              Form ini sekarang diarahkan ke rute 'admin.manage-user' (dari file web.php Anda).
              Gunakan helper request() untuk menjaga nilai filter tetap ada.
            --}}
            <form action="{{ route('admin.manage-user') }}" method="GET" class="row g-3 align-items-center">
                <div class="col-md-4">
                    <input type="text" class="form-control" name="keyword" placeholder="Cari nama atau username..." value="{{ request('keyword') }}">
                </div>
                <div class="col-md-3">
                    <select class="form-select" name="role">
                        <option value="">Semua Role</option>
                        {{-- Gunakan helper @selected() untuk opsi yang aktif --}}
                        <option value="Admin" @selected(request('role') == 'Admin')>Admin</option>
                        <option value="RW" @selected(request('role') == 'RW')>RW</option>
                        <option value="RT" @selected(request('role') == 'RT')>RT</option>
                        <option value="Warga" @selected(request('role') == 'Warga')>Warga</option>
                    </select>
                </div>
                <div class="col-md-5 d-flex justify-content-between flex-wrap gap-2">
                    <div>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-search me-2"></i>Terapkan</button>
                        <a href="{{ route('admin.manage-user') }}" class="btn btn-secondary"><i class="fas fa-redo me-2"></i>Reset</a>
                    </div>
                    {{-- Arahkan ke rute untuk menambah pengguna (sesuaikan namanya jika perlu) --}}
                    <a href="" class="btn btn-success"><i class="fas fa-plus-circle me-2"></i>Tambah Pengguna</a>
                </div>
            </form>
        </div>
    </div>

    <!-- TABEL DATA PENGGUNA -->
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>No.</th>
                            <th>Nama Lengkap</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Wilayah</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{--
                          Nantinya, Anda akan mengganti data statis ini
                          dengan loop Blade dari controller.

                          Contoh:
                          @forelse ($users as $user)
                            <tr>
                               <td>{{ $loop->iteration }}</td>
                               <td>{{ $user->nama_lengkap }}</td>
                               ...
                            </tr>
                          @empty
                            <tr>
                                <td colspan="7" class="text-center">Data tidak ditemukan.</td>
                            </tr>
                          @endforelse
                        --}}

                        <!-- Data dummy (contoh) untuk prototipe -->
                        <tr>
                            <td>1</td>
                            <td>Administrator Sistem</td>
                            <td>admin</td>
                            <td><span class="badge bg-info text-dark">Admin</span></td>
                            <td>-</td>
                            <td><span class="badge bg-success">Aktif</span></td>
                            <td>
                                <a href="#" class="btn btn-warning btn-sm" title="Edit"><i class="fas fa-edit"></i></a>
                                <a href="#" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Anda yakin ingin menonaktifkan pengguna ini?')"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Budi Santoso</td>
                            <td>ketua.rw05</td>
                            <td><span class="badge bg-info text-dark">RW</span></td>
                            <td>RW 05</td>
                            <td><span class="badge bg-success">Aktif</span></td>
                            <td>
                                <a href="#" class="btn btn-warning btn-sm" title="Edit"><i class="fas fa-edit"></i></a>
                                <a href="#" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Anda yakin ingin menonaktifkan pengguna ini?')"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Ahmad Zulkifli</td>
                            <td>ketua.rt01</td>
                            <td><span class="badge bg-info text-dark">RT</span></td>
                            <td>RT 01 / RW 05</td>
                            <td><span class="badge bg-danger">Tidak Aktif</span></td>
                            <td>
                                <a href="#" class="btn btn-warning btn-sm" title="Edit"><i class="fas fa-edit"></i></a>
                                <a href="#" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Anda yakin ingin menonaktifkan pengguna ini?')"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Siti Aminah</td>
                            <td>siti.warga</td>
                            <td><span class="badge bg-info text-dark">Warga</span></td>
                            <td>RT 01 / RW 05</td>
                            <td><span class="badge bg-success">Aktif</span></td>
                            <td>
                                <a href="#" class="btn btn-warning btn-sm" title="Edit"><i class="fas fa-edit"></i></a>
                                <a href="#" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Anda yakin ingin menonaktifkan pengguna ini?')"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Joko Susilo</td>
                            <td>joko.warga</td>
                            <td><span class="badge bg-info text-dark">Warga</span></td>
                            <td>RT 02 / RW 05</td>
                            <td><span class="badge bg-success">Aktif</span></td>
                            <td>
                                <a href="#" class="btn btn-warning btn-sm" title="Edit"><i class="fas fa-edit"></i></a>
                                <a href="#" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Anda yakin ingin menonaktifkan pengguna ini?')"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        <!-- Akhir data dummy -->
                    </tbody>
                </table>
            </div>

            {{--
              Nantinya, Anda akan menambahkan link paginasi di sini
              jika datanya dari controller.
              Contoh:
              <div class="mt-3">
                  {{ $users->links() }}
              </div>
            --}}

        </div>
    </div>
</div>
<!-- ======================================================================= -->
<!-- AKHIR KONTEN UTAMA HALAMAN                                             -->
<!-- ======================================================================= -->

@endsection

