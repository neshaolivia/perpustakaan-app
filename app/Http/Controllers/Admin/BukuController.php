<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Kategoris;
use Illuminate\Http\Request;

class BukuController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }

    public function index()
    {
        $books = Book::with('kategoris')->latest()->get();
        return view('admin.buku.index', compact('books'));
    }

    /**
     * Menampilkan form tambah buku
     */
    public function create()
{
    $kategoris = Kategoris::all();
    return view('admin.buku.create', compact('kategoris'));
}

    /**
     * Menyimpan data buku ke database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul'       => 'required|string|max:255',
            'author'      => 'required|string|max:255',
            'id_kategoris' => 'required|exists:kategoris,id',
            'cover'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'description' => 'nullable|string',
        ]);

        // upload cover jika ada
        if ($request->hasFile('cover')) {
            $validated['cover'] = $request->file('cover')
                ->store('covers', 'public');
        }

        // set status default
        $validated['status'] = 'Tersedia';

        Book::create($validated);

        return redirect()
            ->route('admin.buku.index')
            ->with('success', 'Buku berhasil ditambahkan');
    }

    /**
     * Menampilkan form edit buku
     */
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $kategoris = Kategoris::all();

        return view('admin.buku.edit', compact('book', 'kategoris'));
    }

    /**
     * Update data buku
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'judul'       => 'required|string|max:255',
            'author'      => 'required|string|max:255',
            'id_kategoris' => 'required|exists:kategoris,id',
            'cover'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'description' => 'nullable|string',
            'status'      => 'required|string',
        ]);

        if ($request->hasFile('cover')) {
            $validated['cover'] = $request->file('cover')
                ->store('covers', 'public');
        }

        $book = Book::findOrFail($id);
        $book->update($validated);

        return redirect()
            ->route('admin.buku.index')
            ->with('success', 'Buku berhasil diperbarui');
    }

    /**
     * Hapus buku
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()
            ->route('admin.buku.index')
            ->with('success', 'Buku berhasil dihapus');
    }
}
