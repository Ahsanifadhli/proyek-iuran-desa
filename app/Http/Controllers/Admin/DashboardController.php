<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Kita tidak memanggil Model, DB, atau Carbon lagi

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard Admin (versi statis).
     */
    public function index()
    {
        // Langsung tampilkan view-nya tanpa mengirim data apapun
        return view('admin.dashboard');
    }
}
