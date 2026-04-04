<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alat', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')->constrained('kategori_alat')->restrictOnDelete();
            $table->string('nama_alat', 150);
            $table->string('kode_alat', 50)->unique();
            $table->integer('stok_total')->default(1);
            $table->integer('stok_tersedia')->default(0);
            $table->enum('kondisi', ['baik', 'rusak ringan', 'rusak berat'])->default('baik');
            $table->text('deskripsi')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alat');
    }
};
