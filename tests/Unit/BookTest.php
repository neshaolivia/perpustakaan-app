<?php

use App\Models\Book;

it('mengembalikan true jika status buku Tersedia', function () {
    // Kita gunakan make() karena ini murni pengecekan atribut kelas tanpa perlu simpan ke DB
    $book = new Book(['status' => 'Tersedia']);
    
    // Independent path 1: status == 'Tersedia'
    expect($book->isAvailable())->toBeTrue();
});

it('mengembalikan false jika status buku Tidak Tersedia atau Dipinjam', function () {
    $book1 = new Book(['status' => 'Tidak Tersedia']);
    $book2 = new Book(['status' => 'Dipinjam']);
    
    // Independent path 2: status != 'Tersedia'
    expect($book1->isAvailable())->toBeFalse();
    expect($book2->isAvailable())->toBeFalse();
});
