<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rt extends Model {
    use HasFactory;
    protected $table = 'rt';
    protected $primaryKey = 'id_rt';
    protected $guarded = [];

    public function rw() {
        return $this->belongsTo(Rw::class, 'id_rw');
    }
    public function wargas() {
        return $this->hasMany(Warga::class, 'id_rt');
    }
}
