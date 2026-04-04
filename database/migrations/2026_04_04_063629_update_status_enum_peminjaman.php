<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // MySQL: ubah enum untuk tambah nilai 'menunggu_konfirmasi'
        DB::statement("ALTER TABLE peminjaman MODIFY COLUMN status ENUM('menunggu','dipinjam','menunggu_konfirmasi','dikembalikan','ditolak') DEFAULT 'menunggu'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE peminjaman MODIFY COLUMN status ENUM('menunggu','dipinjam','dikembalikan','ditolak') DEFAULT 'menunggu'");
    }
};
