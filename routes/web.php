<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\BukuController as AdminBukuController;

Route::get('/', function () {
    return view('landing');
})->name('landing');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

Route::get('/riwayat', [DashboardController::class, 'riwayat'])
    ->middleware('auth')
    ->name('riwayat');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('books', BookController::class);

    Route::middleware('role:admin')
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {

            Route::get('/buku', [AdminBukuController::class, 'index'])->name('buku.index');
            Route::get('/buku/create', [AdminBukuController::class, 'create'])->name('buku.create');
            Route::post('/buku', [AdminBukuController::class, 'store'])->name('buku.store');

        });
});

require __DIR__ . '/auth.php';
