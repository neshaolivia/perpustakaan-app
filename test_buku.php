<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

try {
    App\Models\Book::create(['judul' => 'Test PHP', 'author' => 'PHP', 'id_kategoris' => 1, 'status' => 'Tersedia', 'description' => 'Test', 'cover' => null]);
    echo 'SUCCESS';
} catch (\Exception $e) {
    echo $e->getMessage();
}
