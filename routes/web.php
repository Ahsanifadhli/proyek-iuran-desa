<?php

use App\Http\Controllers\Admin\KelolaIuranController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // PERLU DI-IMPORT: Untuk digunakan di '/dashboard'

// 1. Impor semua kontroler
use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\UserController; // Akan kita gunakan
use App\Http\Controllers\RtRw\DashboardController as RtRwDashboard;
use App\Http\Controllers\Warga\DashboardController as WargaDashboard;
use App\Http\Controllers\SendEmailController;

Route::get('/send-mail', [SendEmailController::class, 'index'])->name('kirim-email');

Route::post('/post-email', [SendEmailController::class, 'store'])->name('post-email');

Route::post('/kirim-kontak', [SendEmailController::class, 'handleContactForm'])->name('kirim-kontak');


Route::get('/', function () {
    return view('welcome');
});

// === RUTE TAMU (GUEST) ===
Route::middleware('guest')->group(function () {

    Route::controller(LoginController::class)->group(function () {
        Route::get('/login', 'create')->name('login');
        Route::post('/login', 'store')->name('login.store');
    });

});

// === RUTE TERAUTENTIKASI (AUTH) ===
Route::middleware('auth')->group(function () {

    // Rute Logout
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

    // "PENGATUR LALU LINTAS" DASHBOARD
    // Memeriksa peran dan mengarahkan ke dashboard yang sesuai
    Route::get('/dashboard', function () {
        $role = Auth::user()->role;

        switch ($role) {
            case 'Admin':
                return redirect()->route('admin.dashboard');

            case 'RT':
            case 'RW':
                return redirect()->route('rtrw.dashboard');

            case 'Warga':
                return redirect()->route('warga.dashboard');

            default:
                abort(403, 'Peran tidak valid atau tidak dikenali.');
        }

    })->name('dashboard');

    // === GRUP DASHBOARD SPESIFIK PERAN ===

    // Rute Admin
    Route::middleware('role:Admin')->prefix('admin')->name('admin.')->group(function () {

        Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');

        // Ini menggunakan 'UserController' yang sudah Anda impor.
        Route::get('/manage-user', [UserController::class, 'index'])->name('manage-user');


        // --- INI BAGIAN YANG DIPERBAIKI ---
        // Route untuk Halaman Laporan (Index)
        // Nama route-nya sekarang 'admin.kelola_iuran.index' agar cocok dengan view
        Route::get('/kelola-iuran', [KelolaIuranController::class, 'index'])->name('kelola_iuran.index');

        // Route untuk FUNGSI EXPORT (dari file saya sebelumnya)
        // Ini akan membuat nama route 'admin.laporan.export'
        Route::get('/laporan/export', [KelolaIuranController::class, 'exportExcel'])->name('laporan.export');

        // Route untuk FUNGSI IMPORT (dari file saya sebelumnya)
        // Ini akan membuat nama route 'admin.iuran.import'
        Route::post('/iuran/import', [KelolaIuranController::class, 'importExcel'])->name('iuran.import');
        // --- BATAS PERBAIKAN ---

    });

    // Rute RT/RW
    Route::middleware('role:RT,RW')->prefix('rt-rw')->name('rtrw.')->group(function () {
        Route::get('/dashboard', [RtRwDashboard::class, 'index'])->name('dashboard');
    });

    // Rute Warga
    Route::middleware('role:Warga')->prefix('warga')->name('warga.')->group(function () {
        Route::get('/dashboard', [WargaDashboard::class, 'index'])->name('dashboard');
    });

});
