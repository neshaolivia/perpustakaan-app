<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;

class DashboardController extends Controller
{
    public function index(\Illuminate\Http\Request $request)
    {
        $query = Book::with('kategoris')->latest();

        if ($request->has('kategori') && $request->kategori != '') {
            $query->whereHas('kategoris', function($q) use ($request) {
                $q->where('nama_kategoris', $request->kategori);
            });
        }

        $books = $query->take(12)->get();
        $categories = \App\Models\Kategoris::all();

        return view('dashboard', [
            'totalBuku' => Book::count(),
            'totalUser' => User::count(),
            'books'     => $books,
            'categories'=> $categories,
        ]);
    }
}
