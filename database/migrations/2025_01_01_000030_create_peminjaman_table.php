<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pinjam', 30)->unique();
            $table->foreignId('peminjam_id')->constrained('users')->restrictOnDelete();
            $table->foreignId('petugas_id')->nullable()->constrained('users')->nullOnDelete();
            $table->date('tgl_pinjam')->nullable();
            $table->date('tgl_kembali_rencana');
            $table->enum('status', ['menunggu', 'dipinjam', 'dikembalikan', 'ditolak'])->default('menunggu');
            $table->text('catatan')->nullable();
            $table->text('catatan_petugas')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};
