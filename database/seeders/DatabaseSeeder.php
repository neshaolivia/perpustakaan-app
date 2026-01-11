<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            KategorisSeeder::class, // ← TAMBAHKAN INI
            BukuSeeder::class,     // jika ada
        ]);
    }
}
