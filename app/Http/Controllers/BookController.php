<?php

namespace App\Http\Controllers;

use App\Models\Book;

class BookController extends Controller
{
    /**
     * Daftar buku (USER)
     */
    public function index()
    {
        $books = Book::latest()->get();
        return view('books.index', compact('books'));
    }

    /**
     * Detail buku (USER)
     */
    public function show($id)
    {
        $book = Book::findOrFail($id);
        return view('books.show', compact('book'));
    }
}
