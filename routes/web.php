<?php

use Illuminate\Support\Facades\Route;

// 1. Impor semua kontroler
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\RtRw\DashboardController as RtRwDashboard;
use App\Http\Controllers\Warga\DashboardController as WargaDashboard;

/*
|--------------------------------------------------------------------------
| Halaman Utama (Landing Page)
|--------------------------------------------------------------------------
|
| Rute ini harus ada di LUAR SEMUA GRUP MIDDLEWARE
| agar bisa diakses oleh siapa saja, kapan saja.
|
*/
Route::get('/', function () {
    return view('welcome');
});


/*
|--------------------------------------------------------------------------
| Rute Autentikasi (Untuk "Tamu" / Guest)
|--------------------------------------------------------------------------
|
| Hanya yang BELUM LOGIN yang bisa akses ini.
|
*/
Route::middleware('guest')->group(function () {

    Route::controller(LoginController::class)->group(function () {
        Route::get('/login', 'create')->name('login');
        Route::post('/login', 'store')->name('login.store');
    });

});


/*
|--------------------------------------------------------------------------
| Rute Terproteksi (Untuk yang SUDAH Login)
|--------------------------------------------------------------------------
|
| Hanya yang SUDAH LOGIN yang bisa akses ini.
|
*/
Route::middleware('auth')->group(function () {

    // Rute Logout
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

    // "PENGATUR LALU LINTAS" DASHBOARD
    Route::get('/dashboard', function () {
        $role = Auth::user()->role;

        if ($role == 'Admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($role == 'RT' || $role == 'RW') {
            return redirect()->route('rtrw.dashboard');
        } elseif ($role == 'Warga') {
            return redirect()->route('warga.dashboard');
        }

        Auth::logout();
        return redirect('/login')->with('error', 'Peran tidak valid.');

    })->name('dashboard');


    // === GRUP DASHBOARD SPESIFIK PERAN ===

    // Rute Admin
    Route::middleware('role:Admin')->prefix('admin')->name('admin.')->group(function () {
        Route::controller(AdminDashboard::class)->group(function () {
            Route::get('/dashboard', 'index')->name('dashboard');
        });
    });

    // Rute RT/RW
    Route::middleware('role:RT,RW')->prefix('rt-rw')->name('rtrw.')->group(function () {
        Route::controller(RtRwDashboard::class)->group(function () {
            Route::get('/dashboard', 'index')->name('dashboard');
        });
    });

    // Rute Warga
    Route::middleware('role:Warga')->prefix('warga')->name('warga.')->group(function () {
        Route::controller(WargaDashboard::class)->group(function () {
            Route::get('/dashboard', 'index')->name('dashboard');
        });
    });

});

