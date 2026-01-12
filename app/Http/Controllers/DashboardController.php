<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $books = Book::latest()->take(8)->get(); // ambil 8 buku terbaru

        return view('dashboard', [
            'totalBuku' => Book::count(),
            'totalUser' => User::count(),
            'books'     => $books, // ← INI KUNCI UTAMA
        ]);
    }
}
