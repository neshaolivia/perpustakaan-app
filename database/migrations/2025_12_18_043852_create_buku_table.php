<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('buku', function (Blueprint $table) {
    $table->id();
    $table->string('judul');
    $table->string('author');
    $table->foreignId('id_kategori')
          ->constrained('kategoris')
          ->cascadeOnDelete();
    $table->string('status');
    $table->string('cover')->nullable();
    $table->text('description')->nullable();
    $table->timestamps();
});

}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buku');
    }
};
