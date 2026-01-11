<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'totalBuku' => Book::count(),
            'totalUser' => User::count(),
        ]);
    }
}
