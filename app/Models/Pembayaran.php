<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pembayaran extends Model {
    use HasFactory;
    protected $table = 'pembayarans';
    protected $primaryKey = 'id_pembayaran';
    protected $guarded = [];

    public function warga() {
        return $this->belongsTo(Warga::class, 'id_warga');
    }
    public function jenisIuran() {
        return $this->belongsTo(JenisIuran::class, 'id_iuran');
    }
    public function pencatat() {
        // PERBAIKAN: Tambahkan 'id_user' sebagai owner key (primary key di tabel users)
        return $this->belongsTo(User::class, 'dicatat_oleh', 'id_user');
    }
}
