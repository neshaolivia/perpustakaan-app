<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = 'buku';

    protected $fillable = [
        'judul',
        'author',
        'id_kategoris',
        'description',
        'cover',
        'status',
    ];

    public function kategoris()
    {
        return $this->belongsTo(Kategoris::class, 'id_kategoris');
    }

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'id_buku');
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'id_buku');
    }
}
