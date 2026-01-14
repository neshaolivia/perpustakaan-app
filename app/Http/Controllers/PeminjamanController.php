<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PeminjamanController extends Controller
{
    public function create(Book $book)
{
    // kirim data buku ke form peminjaman
    return view('peminjaman.create', compact('book'));
}
/**
     * Simpan peminjaman buku (AUTO APPROVE)
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_buku' => 'required|exists:buku,id',
            'lama_pinjam' => 'required|integer|min:1|max:30'
        ]);

        $buku = Book::findOrFail($request->id_buku);

        // 1️⃣ Cek status buku
        if ($buku->status !== 'tersedia') {
            return back()->with('error', 'Buku sedang tidak tersedia');
        }

        // 2️⃣ Cek jumlah peminjaman aktif user (max 2)
        $jumlahPinjamAktif = Peminjaman::where('id_user', Auth::id())
            ->where('status', 'dipinjam')
            ->count();

        if ($jumlahPinjamAktif >= 2) {
            return back()->with('error', 'Anda sudah meminjam maksimal 2 buku');
        }

        // 3️⃣ Tentukan tanggal
        $tanggalPinjam = Carbon::now();
        $lamaPinjam = (int) $request->lama_pinjam; // ⬅ casting ke integer
            $tanggalKembali = $tanggalPinjam->copy()->addDays($lamaPinjam);


        // 4️⃣ Simpan peminjaman
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

        return redirect()
            ->route('dashboard')
            ->with('success', 'Peminjaman buku berhasil disetujui');
    }

    /**
     * Pengembalian buku
     */
    public function kembali($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        // Pastikan hanya peminjam yang bisa mengembalikan
        if ($peminjaman->id_user !== Auth::id()) {
            abort(403);
        }

        $peminjaman->update([
            'tanggal_kembali' => now(),
            'status' => 'dikembalikan'
        ]);

        $peminjaman->book->update([
            'status' => 'tersedia'
        ]);

        return back()->with('success', 'Buku berhasil dikembalikan');
    }
}
