<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Landing Page
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('landing');
})->name('landing');

/*
|--------------------------------------------------------------------------
| Dashboard (HARUS LOGIN)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| Riwayat (HARUS LOGIN)
|--------------------------------------------------------------------------
*/
Route::get('/riwayat', [DashboardController::class, 'riwayat'])
    ->middleware('auth')
    ->name('riwayat');

/*
|--------------------------------------------------------------------------
| AUTHENTICATED ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    /*Profil*/
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    /*Buku*/
    Route::get('/books', [BookController::class, 'index'])
        ->name('books.index');

    Route::get('/books/{id}', [BookController::class, 'show'])
        ->name('books.show');
});

/*Auth Routes (Login, Register, Logout)*/
require __DIR__ . '/auth.php';
