<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tb_kendaraan', function (Blueprint $table) {
            $table->increments('id_kendaraan');
            $table->string('plat_nomor', 15)->unique();
            $table->string('jenis_kendaraan', 20);
            $table->string('warna', 20)->nullable();
            $table->string('pemilik', 100)->nullable();
            $table->unsignedInteger('id_user')->nullable();
            $table->foreign('id_user')->references('id_user')->on('tb_user')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_kendaraan');
    }
};
