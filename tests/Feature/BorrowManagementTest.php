<?php

use App\Models\User;
use App\Models\Book;
use App\Models\Kategoris;
use App\Models\Peminjaman;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\put;
use function Pest\Laravel\assertDatabaseHas;

beforeEach(function () {
    // Jalankan setiap test sebagai Admin
    $this->admin = User::factory()->create([
        'role' => 'admin',
    ]);

    // Setup data buku dan peminjaman awal
    $this->kategori = Kategoris::create(['nama_kategoris' => 'Teknologi']);
    $this->book = Book::create([
        'judul' => 'Belajar Laravel',
        'author' => 'Taylor Otwell',
        'id_kategoris' => $this->kategori->id,
        'status' => 'Tersedia' // Awalnya tersedia
    ]);
    $this->user = User::factory()->create([
        'role' => 'user',
    ]);
});

it('admin mengubah status peminjaman menjadi Dipinjam dan mengubah status ketersediaan buku', function () {
    // Asumsi: User sudah melakukan pengajuan dan statusnya 'Pending'
    $peminjaman = Peminjaman::create([
        'id_user' => $this->user->id,
        'id_buku' => $this->book->id,
        'tanggal_pinjam' => now(),
        'tanggal_kembali' => now()->addDays(7),
        'status' => 'Pending'
    ]);

    // Admin mengupdate status menjadi Dipinjam
    $response = actingAs($this->admin)->put(route('admin.peminjaman.update', $peminjaman->id), [
        'status' => 'Dipinjam'
    ]);

    $response->assertRedirect();
    $response->assertSessionHas('success');

    // Cek status peminjaman berubah
    assertDatabaseHas('peminjaman', [
        'id' => $peminjaman->id,
        'status' => 'Dipinjam'
    ]);

    // SESUAI KETENTUAN: status buku harus berubah menjadi 'Tidak Tersedia' / 'Dipinjam'
    assertDatabaseHas('buku', [
        'id' => $this->book->id,
        'status' => 'Tidak Tersedia' // Atau string yang merepresentasikan tidak tersedia di app Anda
    ]);
});

it('admin mengubah status menjadi Dikembalikan dan buku kembali tersedia', function () {
    // Setup buku sedang dipinjam
    $this->book->update(['status' => 'Tidak Tersedia']);

    $peminjaman = Peminjaman::create([
        'id_user' => $this->user->id,
        'id_buku' => $this->book->id,
        'tanggal_pinjam' => now()->subDays(5),
        'tanggal_kembali' => now()->addDays(2),
        'status' => 'Dipinjam'
    ]);

    // Admin mengupdate status menjadi Dikembalikan
    $response = actingAs($this->admin)->put(route('admin.peminjaman.update', $peminjaman->id), [
        'status' => 'Dikembalikan'
    ]);

    $response->assertRedirect();
    $response->assertSessionHas('success');

    // Cek status peminjaman berubah
    assertDatabaseHas('peminjaman', [
        'id' => $peminjaman->id,
        'status' => 'Dikembalikan'
    ]);

    // SESUAI KETENTUAN: status buku harus berubah kembali menjadi 'Tersedia'
    assertDatabaseHas('buku', [
        'id' => $this->book->id,
        'status' => 'Tersedia'
    ]);
});
