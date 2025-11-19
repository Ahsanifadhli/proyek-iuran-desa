<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JenisIuran extends Model {
    use HasFactory;
    protected $table = 'jenis_iurans';
    protected $primaryKey = 'id_iuran';
    protected $guarded = [];

    public function pembayarans() {
        return $this->hasMany(Pembayaran::class, 'id_iuran');
    }
}
