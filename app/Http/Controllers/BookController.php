<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Kategori;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Constructor
     * Semua method di controller ini HANYA untuk ADMIN
     */
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }

    /**
     * Menampilkan daftar buku (ADMIN)
     */
    public function index()
    {
        $books = Book::with('kategori')->latest()->get();
        return view('books.index', compact('books'));
    }

    /**
     * Form tambah buku
     */
    public function create()
    {
        $kategori = Kategori::all();
        return view('books.create', compact('kategori'));
    }

    /**
     * Simpan buku baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul'        => 'required|string|max:255',
            'penulis'      => 'required|string|max:255',
            'penerbit'     => 'required|string|max:255',
            'tahun_terbit' => 'required|integer',
            'id_kategori'  => 'nullable|exists:kategori,id',
        ]);

        Book::create($validated);

        return redirect()
            ->route('books-admin.index')
            ->with('success', 'Buku berhasil ditambahkan');
    }

    /**
     * Form edit buku
     */
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $kategori = Kategori::all();

        return view('books.edit', compact('book', 'kategori'));
    }

    /**
     * Update buku
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'judul'        => 'required|string|max:255',
            'penulis'      => 'required|string|max:255',
            'penerbit'     => 'required|string|max:255',
            'tahun_terbit' => 'required|integer',
            'id_kategori'  => 'nullable|exists:kategori,id',
        ]);

        $book = Book::findOrFail($id);
        $book->update($validated);

        return redirect()
            ->route('books-admin.index')
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
            ->route('books-admin.index')
            ->with('success', 'Buku berhasil dihapus');
    }
}
