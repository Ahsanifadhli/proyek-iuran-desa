<?php

namespace App\Http\Controllers\Warga;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Langsung tampilkan file view-nya tanpa mengirim data
        return view('warga.dashboard');
    }
}
