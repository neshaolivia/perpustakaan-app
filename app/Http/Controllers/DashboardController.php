<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil 8 buku TERSEDIA terbaru
        $books = Book::where('status', 'tersedia')
            ->latest()
            ->take(8)
            ->get();

        return view('dashboard', [
            'totalBuku' => Book::count(),
            'totalUser' => User::count(),
            'books'     => $books,
        ]);
    }
}
