<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rw extends Model {
    use HasFactory;
    protected $table = 'rw';
    protected $primaryKey = 'id_rw';
    protected $guarded = [];

    public function rts() {
        return $this->hasMany(Rt::class, 'id_rw');
    }
}
