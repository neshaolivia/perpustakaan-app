<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PeminjamanController extends Controller
{
    public function index()
    {
        return Peminjaman::with(['user', 'book'])->get();
    }

  public function store(Request $request)
{
    $request->validate([
        'id_buku' => 'required|exists:buku,id',
        'lama_pinjam' => 'required|integer|max:30'
    ]);

    $buku = Book::findOrFail($request->id_buku);

    // 1️⃣ Cek status buku
    if ($buku->status !== 'tersedia') {
        return back()->with('error', 'Buku sedang tidak tersedia');
    }

    // 2️⃣ Cek jumlah peminjaman aktif user
    $jumlahPinjamAktif = Peminjaman::where('id_user', Auth::id())
        ->where('status', 'dipinjam')
        ->count();

    if ($jumlahPinjamAktif >= 2) {
        return back()->with('error', 'Anda sudah meminjam maksimal 2 buku');
    }

    // 3️⃣ Tentukan tanggal pinjam & kembali
    $tanggalPinjam = Carbon::now();
    $tanggalKembali = $tanggalPinjam->copy()->addDays($request->lama_pinjam);

    // 4️⃣ Simpan peminjaman (AUTO-APPROVE)
    Peminjaman::create([
        'id_user' => Auth::id(),
        'id_buku' => $buku->id,
        'tanggal_pinjam' => $tanggalPinjam,
        'tanggal_kembali' => $tanggalKembali,
        'status' => 'dipinjam'
    ]);

    // 5️⃣ Update status buku
    $buku->update([
        'status' => 'dipinjam'
    ]);

    return back()->with('success', 'Peminjaman buku berhasil disetujui');
}

   public function kembali($id)
{
    $peminjaman = Peminjaman::findOrFail($id);

    $peminjaman->update([
        'tanggal_kembali' => now(),
        'status' => 'dikembalikan'
    ]);

    // Kembalikan status buku
    $peminjaman->book->update([
        'status' => 'tersedia'
    ]);

    return back()->with('success', 'Buku berhasil dikembalikan');
}
}
