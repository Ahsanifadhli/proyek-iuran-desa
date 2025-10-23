<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id_user';

    // Beri tahu Laravel bahwa Anda tidak punya kolom 'updated_at'
    const UPDATED_AT = null;

    protected $fillable = [
        'nama_lengkap',
        'username',
        'password',
        'role',
        'no_hp',
        'email',
        'foto',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token', // Kita akan tambahkan kolom ini
    ];

    protected $casts = [
        'is_active' => 'boolean',
        // Kita tidak perlu 'email_verified_at' karena tidak pakai Breeze
    ];
}
