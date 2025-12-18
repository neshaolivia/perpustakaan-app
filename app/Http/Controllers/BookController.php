<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        return Book::with('kategori')->get();
    }

    public function store(Request $request)
    {
        return Book::create($request->all());
    }

    public function show($id)
    {
        return Book::findOrFail($id);
    }
}
