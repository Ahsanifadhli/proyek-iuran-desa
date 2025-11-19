<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Warga extends Model {
    use HasFactory;
    protected $table = 'wargas';
    protected $primaryKey = 'id_warga';
    protected $guarded = [];

    public function user() {
        // PERBAIKAN: Tambahkan 'id_user' sebagai owner key
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
    public function rt() {
        return $this->belongsTo(Rt::class, 'id_rt');
    }
    public function pembayarans() {
        return $this->hasMany(Pembayaran::class, 'id_warga');
    }
}
