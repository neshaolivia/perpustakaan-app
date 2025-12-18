<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
        return Peminjaman::with(['user', 'book'])->get();
    }

    public function store(Request $request)
    {
        return Peminjaman::create([
            'id_user' => $request->id_user,
            'id_buku' => $request->id_buku,
            'tanggal_pinjam' => now(),
            'status' => 'dipinjam'
        ]);
    }

    public function kembali($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->update([
            'tanggal_kembali' => now(),
            'status' => 'dikembalikan'
        ]);

        return $peminjaman;
    }
}
