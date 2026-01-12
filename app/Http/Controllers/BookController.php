<?php

namespace App\Http\Controllers;

use App\Models\Book;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('kategoris')->latest()->get();
        return view('books.index', compact('books'));
    }

    public function show($id)
    {
        $book = Book::with('kategoris')->findOrFail($id);
        return view('books.show', compact('book'));
    }
}
