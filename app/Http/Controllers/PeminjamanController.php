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
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:50',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after:tanggal_pinjam',
        ]);

        $buku = Book::findOrFail($request->id_buku);

        // 1️⃣ Cek status buku
        if (strtolower($buku->status) !== 'tersedia') {
            return back()->with('error', 'Buku sedang tidak tersedia')->withInput();
        }

        // Cek durasi peminjaman maksimal 30 hari
        $tglPinjam = Carbon::parse($request->tanggal_pinjam);
        $tglKembali = Carbon::parse($request->tanggal_kembali);

        if ($tglPinjam->diffInDays($tglKembali) > 30) {
            return back()->with('error', 'Lama peminjaman maksimal adalah 30 hari dari tanggal peminjaman.')->withInput();
        }

        $user = Auth::user();

        // Update user profile with name and nim
        $user->update([
            'name' => $request->nama,
            'nim' => $request->nim,
        ]);

        // 2️⃣ Cek jumlah peminjaman aktif user (max 2)
        $jumlahPinjamAktif = Peminjaman::where('id_user', $user->id)
            ->where('status', 'dipinjam')
            ->count();

        if ($jumlahPinjamAktif >= 2) {
            return back()->with('error', 'Anda sudah meminjam maksimal 2 buku');
        }

        // 4️⃣ Simpan peminjaman
        Peminjaman::create([
            'id_user' => $user->id,
            'id_buku' => $buku->id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'status' => 'dipinjam'
        ]);

        // 5️⃣ Update status buku
        $buku->update([
            'status' => 'dipinjam'
        ]);

        return redirect()
            ->route('riwayat')
            ->with('success', 'Pengajuan peminjaman berhasil diajukan.');
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
