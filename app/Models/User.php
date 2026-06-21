<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'nim',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'id_user');
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'id_user');
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isUser()
    {
        return $this->role === 'user';
    }

    public function canBorrow()
    {
        $jumlahPinjamAktif = $this->peminjaman()
            ->where('status', 'dipinjam')
            ->count();

        return $jumlahPinjamAktif < 2;
    }
}
