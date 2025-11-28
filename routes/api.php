<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserApiController;
use App\Http\Controllers\Api\TagihanApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// KODE LAMA (Cuma bisa GET)
// Route::get('/tagihan', [TagihanApiController::class, 'index']);

// GANTI JADI INI (Otomatis dapat GET, POST, PUT, DELETE - Sesuai Modul Halaman 4)
Route::apiResource('/tagihan', App\Http\Controllers\Api\TagihanApiController::class);

Route::apiResource('/users', App\Http\Controllers\Api\UserApiController::class);
