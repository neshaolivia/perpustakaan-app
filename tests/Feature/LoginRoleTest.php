<?php

use App\Models\User;
use function Pest\Laravel\post;
use function Pest\Laravel\assertAuthenticatedAs;
use function Pest\Laravel\assertGuest;

it('gagal login dengan kredensial salah', function () {
    $user = User::factory()->create([
        'email' => 'user@example.com',
        'password' => bcrypt('password123'),
        'role' => 'user',
    ]);

    $response = post('/login', [
        'email' => 'user@example.com',
        'password' => 'wrongpassword',
    ]);

    assertGuest();
    $response->assertSessionHasErrors('email'); // Pesan error standar Laravel jika gagal login
});

it('berhasil login sebagai admin dan diarahkan ke dashboard', function () {
    $admin = User::factory()->create([
        'email' => 'admin@example.com',
        'password' => bcrypt('password123'),
        'role' => 'admin',
    ]);

    $response = post('/login', [
        'email' => 'admin@example.com',
        'password' => 'password123',
    ]);

    assertAuthenticatedAs($admin);
    // Asumsi rute default setelah login
    $response->assertRedirect(route('dashboard'));
    
    expect($admin->role)->toBe('admin');
});

it('berhasil login sebagai user dan diarahkan ke dashboard', function () {
    $user = User::factory()->create([
        'email' => 'user_baru@example.com',
        'password' => bcrypt('password123'),
        'role' => 'user',
    ]);

    $response = post('/login', [
        'email' => 'user_baru@example.com',
        'password' => 'password123',
    ]);

    assertAuthenticatedAs($user);
    $response->assertRedirect(route('dashboard'));
    
    expect($user->role)->toBe('user');
});
