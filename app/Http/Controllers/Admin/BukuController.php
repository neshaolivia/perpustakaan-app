<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Kategori;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function index()
    {
        $books = Book::latest()->get();
        return view('admin.buku.index', compact('books'));
    }

    public function create()
    {
        $kategori = Kategori::all();
        return view('admin.buku.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'tahun_terbit' => 'required|integer',
            'id_kategori' => 'nullable|exists:kategori,id',
            'cover' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // upload cover
        if ($request->hasFile('cover')) {
            $validated['cover'] = $request->file('cover')
                ->store('covers', 'public');
        }

        $validated['status'] = 'tersedia';

        Book::create($validated);

        return redirect()
            ->route('admin.buku.index')
            ->with('success', 'Buku berhasil ditambahkan');
    }
}
