<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    protected $table = 'pengembalian';
    protected $fillable = [
        'peminjaman_id', 'petugas_id',
        'tgl_kembali_aktual', 'hari_terlambat', 'denda', 'keterangan'
    ];

    protected $casts = [
        'tgl_kembali_aktual' => 'date',
        'denda' => 'decimal:2',
    ];

    public function peminjaman() { return $this->belongsTo(Peminjaman::class); }
    public function petugas() { return $this->belongsTo(User::class, 'petugas_id'); }
}
