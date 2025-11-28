<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    use HasFactory;

    // Sesuaikan dengan kolom database proyek Iuran Desa kamu
    protected $table = 'tagihan'; // Pastikan nama tabelnya benar
    protected $guarded = ['id'];
}
