<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('kode_buku')->unique();
            $table->string('nama_buku');
            $table->string('penulis')->nullable();
            $table->string('penerbit')->nullable();
            $table->enum('kategori',['novel','cerita-anak','manga', 'lainnya']);
            $table->integer('stock')->default(0);
            $table->text('deskripsi')->nullable();
            $table->enum('status',['tersedia','rusak','dipinjam'])->default('tersedia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
