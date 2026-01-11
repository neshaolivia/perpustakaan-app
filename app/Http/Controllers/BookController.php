<?php

namespace App\Http\Controllers;

use App\Models\Book;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // ✅ USER & ADMIN BOLEH
    }

    // LIST BUKU (USER)
    public function index()
    {
        $books = Book::with('kategoris')->latest()->get();
        return view('books.index', compact('books'));
    }

    // DETAIL BUKU (USER)
    public function show($id)
    {
        $book = Book::with('kategoris')->findOrFail($id);
        return view('books.show', compact('book'));
    }
}
