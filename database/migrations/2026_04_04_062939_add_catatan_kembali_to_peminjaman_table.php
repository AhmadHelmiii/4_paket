<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('peminjaman', function (Blueprint $table) {
            $table->text('catatan_kembali')->nullable()->after('catatan_petugas');
            $table->boolean('konfirmasi_kembali')->default(false)->after('catatan_kembali');
        });
    }

    public function down(): void
    {
        Schema::table('peminjaman', function (Blueprint $table) {
            $table->dropColumn(['catatan_kembali', 'konfirmasi_kembali']);
        });
    }
};
