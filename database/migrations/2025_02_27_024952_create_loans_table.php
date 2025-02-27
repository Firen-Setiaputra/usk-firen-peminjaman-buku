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
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anggota_id')->constrained('anggotas','id')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('book_id')->constrained('books','id')->cascadeOnUpdate()->cascadeOnDelete();
            $table->date('tanggal_peminjaman')->default(now());
            $table->date('tanggal_pengembalian')->nullable();
            $table->enum('status',['dipinjam','dikembalikan','terlambat']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
