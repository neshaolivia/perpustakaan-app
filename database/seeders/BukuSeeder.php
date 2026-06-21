<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Kategoris;

class BukuSeeder extends Seeder
{
    public function run(): void
    {
        $novel = Kategoris::where('nama_kategoris', 'Novel')->first();
        $sejarah = Kategoris::where('nama_kategoris', 'Sejarah')->first();
        $teknologi = Kategoris::where('nama_kategoris', 'Teknologi')->first();

        DB::table('buku')->insert([
            [
                'judul' => 'Tentang Kamu',
                'author' => 'Tere Liye',
                'id_kategoris' => $novel->id,
                'description' => 'Terima kasih untuk kesempatan mengenalmu...',
                'cover' => 'covers/tentang-kamu.jpg',
                'status' => 'tersedia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Perang Eropa',
                'author' => 'P.K. Ojong',
                'id_kategoris' => $sejarah->id,
                'description' => 'Ketika telah cukup umur, Hitler harus masuk milisi...',
                'cover' => 'covers/perang-eropa1.jpg',
                'status' => 'tersedia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Laravel Framework',
                'author' => 'Ir. Yuniar Supardi, S. Kom.',
                'id_kategoris' => $teknologi->id,
                'description' => 'Menguasai Laravel bukan hanya soal bisa membuat aplikasi web...',
                'cover' => 'covers/laravel-framework.jpg',
                'status' => 'tersedia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
