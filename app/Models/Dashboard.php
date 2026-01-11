<?php

namespace App\Http\Controllers;

use App\Models\Book;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBuku = Book::count();

        return view('dashboard', compact('totalBuku'));
    }
}
