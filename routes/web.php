<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\BukuController as AdminBukuController;
use App\Http\Controllers\PeminjamanController;
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
| Dashboard (Login)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| Riwayat (Login)
|--------------------------------------------------------------------------
*/
Route::get('/riwayat', [DashboardController::class, 'riwayat'])
    ->middleware('auth')
    ->name('riwayat');

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    /* =====================
     | Profile
     ===================== */
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    /* =====================
     | Buku (USER)
     ===================== */
    Route::get('/books', [BookController::class, 'index'])
        ->name('books.index');

    Route::get('/books/{id}', [BookController::class, 'show'])
        ->name('books.show');

    /* =====================
     | Peminjaman Buku (USER)
     ===================== */
    Route::get('/peminjaman/{book}', [PeminjamanController::class, 'create'])
        ->name('peminjaman.create');

    Route::post('/peminjaman', [PeminjamanController::class, 'store'])
        ->name('peminjaman.store');


    /* =====================
     | Buku (ADMIN)
     ===================== */
    Route::middleware(['auth', 'role:admin'])
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {

            Route::get('/buku', [AdminBukuController::class, 'index'])
                ->name('buku.index');

            Route::get('/buku/create', [AdminBukuController::class, 'create'])
                ->name('buku.create');

            Route::post('/buku', [AdminBukuController::class, 'store'])
                ->name('buku.store');

            Route::get('/buku/{id}/edit', [AdminBukuController::class, 'edit'])
                ->name('buku.edit');

            Route::put('/buku/{id}', [AdminBukuController::class, 'update'])
                ->name('buku.update');

            Route::delete('/buku/{id}', [AdminBukuController::class, 'destroy'])
                ->name('buku.destroy');
        });
});

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
