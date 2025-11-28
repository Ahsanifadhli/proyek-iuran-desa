<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tagihan; // Pastikan model Tagihan sudah ada
use App\Http\Resources\TagihanResource;
use Illuminate\Http\Request;

class TagihanApiController extends Controller
{
    public function index()
    {
        // Ambil data tagihan terbaru, misal 10 per halaman
        $tagihan = Tagihan::latest()->paginate(10); // [cite: 74]

        // Kembalikan dalam format JSON Resource
        return new TagihanResource(true, 'List Data Tagihan Desa', $tagihan); //
    }
}
