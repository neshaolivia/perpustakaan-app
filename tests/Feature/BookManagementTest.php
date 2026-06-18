<?php

use App\Models\Book;
use App\Models\User;
use App\Models\Kategoris;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\post;
use function Pest\Laravel\put;
use function Pest\Laravel\delete;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;

beforeEach(function () {
    // Jalankan setiap test sebagai Admin
    $this->admin = User::factory()->create([
        'role' => 'admin',
    ]);
});

it('admin dapat menambahkan buku baru dengan data valid', function () {
    $kategori = Kategoris::create(['nama_kategoris' => 'Fiksi']);

    $response = actingAs($this->admin)->post(route('admin.buku.store'), [
        'judul' => 'Buku Pest Laravel',
        'author' => 'Taylor Otwell',
        'id_kategoris' => $kategori->id,
        'description' => 'Buku tentang testing',
    ]);

    $response->assertRedirect(route('admin.buku.index'));
    $response->assertSessionHas('success', 'Buku berhasil ditambahkan');

    assertDatabaseHas('buku', [
        'judul' => 'Buku Pest Laravel',
        'author' => 'Taylor Otwell',
        'status' => 'Tersedia' // Sesuai default di controller
    ]);
});

it('admin gagal menambahkan buku jika validasi form tidak terpenuhi', function () {
    $response = actingAs($this->admin)->post(route('admin.buku.store'), [
        // Judul kosong, author kosong, id_kategoris tidak ada
        'judul' => '',
    ]);

    $response->assertSessionHasErrors(['judul', 'author', 'id_kategoris']);
    assertDatabaseMissing('buku', [
        'judul' => ''
    ]);
});

it('admin dapat memperbarui data buku', function () {
    $kategori = Kategoris::create(['nama_kategoris' => 'Sejarah']);
    $book = Book::create([
        'judul' => 'Sejarah Lama',
        'author' => 'Anonim',
        'id_kategoris' => $kategori->id,
        'status' => 'Tersedia'
    ]);

    $response = actingAs($this->admin)->put(route('admin.buku.update', $book->id), [
        'judul' => 'Sejarah Baru',
        'author' => 'Anonim',
        'id_kategoris' => $kategori->id,
        'status' => 'Tersedia',
        'description' => 'Updated desc'
    ]);

    $response->assertRedirect(route('admin.buku.index'));
    
    assertDatabaseHas('buku', [
        'id' => $book->id,
        'judul' => 'Sejarah Baru'
    ]);
});

it('admin gagal memperbarui buku dengan data tidak valid', function () {
    $kategori = Kategoris::create(['nama_kategoris' => 'Sains']);
    $book = Book::create([
        'judul' => 'Buku Sains',
        'author' => 'Einstein',
        'id_kategoris' => $kategori->id,
        'status' => 'Tersedia'
    ]);

    $response = actingAs($this->admin)->put(route('admin.buku.update', $book->id), [
        'judul' => '', // Invalid
        'author' => 'Einstein',
        'id_kategoris' => $kategori->id,
        'status' => 'Tersedia',
    ]);

    $response->assertSessionHasErrors(['judul']);
    
    // Pastikan data di database tidak berubah
    assertDatabaseHas('buku', [
        'id' => $book->id,
        'judul' => 'Buku Sains'
    ]);
});

it('admin dapat menghapus buku', function () {
    $kategori = Kategoris::create(['nama_kategoris' => 'Komik']);
    $book = Book::create([
        'judul' => 'Komik Lucu',
        'author' => 'Komikus',
        'id_kategoris' => $kategori->id,
        'status' => 'Tersedia'
    ]);

    $response = actingAs($this->admin)->delete(route('admin.buku.destroy', $book->id));

    $response->assertRedirect(route('admin.buku.index'));
    
    assertDatabaseMissing('buku', [
        'id' => $book->id,
    ]);
});
