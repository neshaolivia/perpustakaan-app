<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil 8 buku terbaru
        $books = Book::latest()->take(8)->get();

        return view('dashboard', [
            'totalBuku' => Book::count(),
            'totalUser' => User::count(),
            'books'     => $books, // data buku dikirim ke view
        ]);
    }
}
