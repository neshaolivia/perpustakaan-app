<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjaman = Peminjaman::with(['user', 'book'])->orderBy('created_at', 'desc')->get();
        return view('admin.peminjaman.index', compact('peminjaman'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Dipinjam,Dikembalikan'
        ]);

        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->status = $request->status;
        $peminjaman->save();

        // Update status ketersediaan buku
        if ($request->status === 'Dipinjam') {
            $peminjaman->book->update(['status' => 'Tidak Tersedia']);
        } elseif ($request->status === 'Dikembalikan') {
            $peminjaman->book->update(['status' => 'Tersedia']);
        }

        return redirect()->back()->with('success', 'Status peminjaman berhasil diperbarui.');
    }
}
