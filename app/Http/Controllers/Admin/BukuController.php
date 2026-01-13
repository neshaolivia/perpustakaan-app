<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Kategoris;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    /**
     * Menampilkan daftar buku
     */
    public function index()
    {
        $books = Book::with('kategoris')->latest()->get();
        return view('admin.buku.index', compact('books'));
    }

    /**
     * Form tambah buku
     */
    public function create()
    {
        $kategoris = Kategoris::all();
        return view('admin.buku.create', compact('kategoris'));
    }

    /**
     * Simpan buku ke database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul'        => 'required|string|max:255',
            'author'       => 'required|string|max:255',
            'id_kategoris' => 'required|exists:kategoris,id',
            'cover'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'description'  => 'nullable|string',
        ]);

        if ($request->hasFile('cover')) {
            $validated['cover'] = $request->file('cover')->store('covers', 'public');
        }

        $validated['status'] = 'Tersedia';

        Book::create($validated);

        return redirect()
            ->route('admin.buku.index')
            ->with('success', 'Buku berhasil ditambahkan');
    }

    /**
     * Form edit buku
     */
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $kategoris = Kategoris::all();
        return view('admin.buku.edit', compact('book', 'kategoris'));
    }

    /**
     * Update buku
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'judul'        => 'required|string|max:255',
            'author'       => 'required|string|max:255',
            'id_kategoris' => 'required|exists:kategoris,id',
            'status'       => 'required|string',
            'cover'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'description'  => 'nullable|string',
        ]);

        if ($request->hasFile('cover')) {
            $validated['cover'] = $request->file('cover')->store('covers', 'public');
        }

        Book::findOrFail($id)->update($validated);

        return redirect()
            ->route('admin.buku.index')
            ->with('success', 'Buku berhasil diperbarui');
    }

    /**
     * Hapus buku
     */
    public function destroy($id)
    {
        Book::findOrFail($id)->delete();

        return redirect()
            ->route('admin.buku.index')
            ->with('success', 'Buku berhasil dihapus');
    }
}
