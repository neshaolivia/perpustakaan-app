<?php

use App\Models\User;
use App\Models\Book;
use App\Models\Kategoris;
use App\Models\Peminjaman;
use Illuminate\Foundation\Testing\RefreshDatabase;

// Gunakan TestCase bawaan Laravel agar kita bisa menggunakan DB factory di Unit Test
uses(Tests\TestCase::class, RefreshDatabase::class);

it('mengembalikan true jika role adalah admin', function () {
    $user = User::factory()->make(['role' => 'admin']);
    
    // Independent path 1: role = admin
    expect($user->isAdmin())->toBeTrue();
});

it('mengembalikan false jika role bukan admin', function () {
    $user = User::factory()->make(['role' => 'user']);
    
    // Independent path 2: role != admin
    expect($user->isAdmin())->toBeFalse();
});

it('mengembalikan true jika user masih bisa meminjam (kurang dari 2 buku)', function () {
    $user = User::factory()->create();
    
    // Independent path 1: jumlah peminjaman aktif < 2 (saat ini 0)
    expect($user->canBorrow())->toBeTrue();
});

it('mengembalikan false jika user sudah meminjam 2 buku atau lebih', function () {
    $user = User::factory()->create();
    $kategori = Kategoris::create(['nama_kategoris' => 'Buku Test']);
    
    $buku1 = Book::create(['judul' => 'A', 'author' => 'A', 'id_kategoris' => $kategori->id, 'status' => 'Tersedia']);
    $buku2 = Book::create(['judul' => 'B', 'author' => 'B', 'id_kategoris' => $kategori->id, 'status' => 'Tersedia']);

    Peminjaman::create([
        'id_user' => $user->id,
        'id_buku' => $buku1->id,
        'tanggal_pinjam' => now(),
        'tanggal_kembali' => now()->addDays(2),
        'status' => 'dipinjam'
    ]);

    Peminjaman::create([
        'id_user' => $user->id,
        'id_buku' => $buku2->id,
        'tanggal_pinjam' => now(),
        'tanggal_kembali' => now()->addDays(2),
        'status' => 'dipinjam'
    ]);

    // Independent path 2: jumlah peminjaman aktif >= 2
    expect($user->canBorrow())->toBeFalse();
});
