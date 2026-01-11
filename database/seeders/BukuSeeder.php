<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BukuSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('buku')->insert([
            [
                'judul' => 'Tentang Kamu',
                'penulis' => 'Tere Liye',
                'kategori' => 'Novel',
                'sinopsis' => 'Terima kasih untuk kesempatan mengenalmu, itu adalah salah satu anugerah terbesar hidupku. Cinta memang tidak perlu ditemukan, cintalah yang akan menemukan kita. Terima kasih. Nasihat lama itu benar sekali, aku tidak akan menangis karena sesuatu telah berakhir, tapi aku akan tersenyum karena sesuatu itu pernah terjadi. Masa lalu. Rasa sakit. Masa depan. Mimpi-mimpi. Semua akan berlalu, seperti sungai yang mengalir. Maka biarlah hidupku mengalir seperti sungai kehidupan.',
                'rating' => 4,
                'cover' => 'covers/tentang-kamu.jpg',
                'status' => 'tersedia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Perang Eropa',
                'penulis' => 'P.K. Ojong',
                'kategori' => 'Sejarah',
                'sinopsis' => 'Ketika telah cukup umur, Hitler harus masuk milisi atau wajib militer. Tetapi dia tidak melaporkan diri. Ia malah ke luar negeri, ke Kota Munchen di Jerman. Dia dikejar oleh polisi Austria sebagai desertir… (Bab tentang Hitler Masa Muda)

“Semua tabung torpedo kini telah kosong. Saya putuskan untuk mengundurkan diri, antara lain karena dugaan seorang pengendara mobil telah memergoki kami. Mobilnya berhenti di depan kami, kemudian memutar dan lari sekencang-kencangnya ke arah Scapa… “(Gunter Prien, komandan U-47 setelah berhasil menenggelamkan kapal tempur Inggris HMS Royal Oak di Pangkalan Scapa Flow)',
                'rating' => 4,
                'cover' => 'covers/perang-eropa1.jpg',
                'status' => 'tersedia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Laravel Framework: Belajar Pengembangan Aplikasi Web Berbasis PHP',
                'penulis' => 'Ir. Yuniar Supardi, S. Kom.',
                'kategori' => 'Teknologi',
                'sinopsis' => 'Menguasai Laravel bukan hanya soal bisa membuat aplikasi web, tetapi juga memahami mengapa keahlian ini sangat dihargai di dunia kerja. Buku ini menjadi jawaban mengapa web programmer dengan Laravel dibayar mahal. Karena menguasai framework ini berarti menguasai alur kerja modern dalam pengembangan aplikasi web.',
                'rating' => 5,
                'cover' => 'covers/laravel-framework.jpg',
                'status' => 'tersedia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
