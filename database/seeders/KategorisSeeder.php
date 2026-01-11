<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategorisSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('kategoris')->insert([
            [
                'nama_kategoris' => 'Teknologi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kategoris' => 'Pendidikan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kategoris' => 'Komik',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kategoris' => 'Novel',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kategoris' => 'Sejarah',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
