<?php

use App\Models\User;
use App\Models\Book;
use App\Models\Kategoris;
use App\Models\Peminjaman;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\post;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;
use Carbon\Carbon;

beforeEach(function () {
    // Jalankan setiap test sebagai User biasa
    $this->user = User::factory()->create([
        'role' => 'user',
    ]);

    $this->kategori = Kategoris::create(['nama_kategoris' => 'Sains']);
    
    // Buku Tersedia
    $this->bukuTersedia = Book::create([
        'judul' => 'Buku Tersedia',
        'author' => 'Penulis',
        'id_kategoris' => $this->kategori->id,
        'status' => 'Tersedia'
    ]);

    // Buku Tidak Tersedia
    $this->bukuTidakTersedia = Book::create([
        'judul' => 'Buku Dipinjam',
        'author' => 'Penulis',
        'id_kategoris' => $this->kategori->id,
        'status' => 'Tidak Tersedia'
    ]);
});

it('user dapat mengajukan peminjaman untuk buku yang tersedia', function () {
    $tglPinjam = Carbon::now();
    $tglKembali = Carbon::now()->addDays(7);

    $response = actingAs($this->user)->post(route('peminjaman.store'), [
        'id_buku' => $this->bukuTersedia->id,
        'nama' => 'Nama User Test',
        'nim' => '12345678',
        'tanggal_pinjam' => $tglPinjam->format('Y-m-d'),
        'tanggal_kembali' => $tglKembali->format('Y-m-d'),
    ]);

    $response->assertRedirect(route('riwayat'));
    $response->assertSessionHas('success');

    // Cek data masuk ke tabel peminjaman
    assertDatabaseHas('peminjaman', [
        'id_user' => $this->user->id,
        'id_buku' => $this->bukuTersedia->id,
        'status' => 'dipinjam' // Controller menggunakan lowercase 'dipinjam'
    ]);

    // Cek status buku berubah
    assertDatabaseHas('buku', [
        'id' => $this->bukuTersedia->id,
        'status' => 'dipinjam'
    ]);
    
    // Cek profil user terupdate
    assertDatabaseHas('users', [
        'id' => $this->user->id,
        'name' => 'Nama User Test',
        'nim' => '12345678'
    ]);
});

it('user gagal mengajukan peminjaman jika buku sedang tidak tersedia', function () {
    $tglPinjam = Carbon::now();
    $tglKembali = Carbon::now()->addDays(7);

    $response = actingAs($this->user)->post(route('peminjaman.store'), [
        'id_buku' => $this->bukuTidakTersedia->id,
        'nama' => 'Nama User Test',
        'nim' => '12345678',
        'tanggal_pinjam' => $tglPinjam->format('Y-m-d'),
        'tanggal_kembali' => $tglKembali->format('Y-m-d'),
    ]);

    $response->assertRedirect(); // redirect back()
    $response->assertSessionHas('error', 'Buku sedang tidak tersedia');

    // Pastikan tidak ada data baru di tabel peminjaman
    assertDatabaseMissing('peminjaman', [
        'id_user' => $this->user->id,
        'id_buku' => $this->bukuTidakTersedia->id,
    ]);
});

it('user gagal mengajukan peminjaman jika sudah meminjam batas maksimal buku', function () {
    // Buat dua buku tambahan untuk dipinjam
    $buku1 = Book::create(['judul' => 'Buku 1', 'author' => 'Author', 'id_kategoris' => $this->kategori->id, 'status' => 'Tersedia']);
    $buku2 = Book::create(['judul' => 'Buku 2', 'author' => 'Author', 'id_kategoris' => $this->kategori->id, 'status' => 'Tersedia']);

    // Simulasi user sudah meminjam 2 buku
    Peminjaman::create([
        'id_user' => $this->user->id,
        'id_buku' => $buku1->id,
        'tanggal_pinjam' => now(),
        'tanggal_kembali' => now()->addDays(7),
        'status' => 'dipinjam'
    ]);
    Peminjaman::create([
        'id_user' => $this->user->id,
        'id_buku' => $buku2->id,
        'tanggal_pinjam' => now(),
        'tanggal_kembali' => now()->addDays(7),
        'status' => 'dipinjam'
    ]);

    $tglPinjam = Carbon::now();
    $tglKembali = Carbon::now()->addDays(7);

    $response = actingAs($this->user)->post(route('peminjaman.store'), [
        'id_buku' => $this->bukuTersedia->id,
        'nama' => 'Nama User Test',
        'nim' => '12345678',
        'tanggal_pinjam' => $tglPinjam->format('Y-m-d'),
        'tanggal_kembali' => $tglKembali->format('Y-m-d'),
    ]);

    $response->assertRedirect(); // redirect back()
    $response->assertSessionHas('error', 'Anda sudah meminjam maksimal 2 buku');
});
