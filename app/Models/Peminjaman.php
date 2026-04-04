<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';
    protected $fillable = [
        'kode_pinjam', 'peminjam_id', 'petugas_id',
        'tgl_pinjam', 'tgl_kembali_rencana',
        'status', 'catatan', 'catatan_petugas',
        'catatan_kembali', 'konfirmasi_kembali'
    ];

    protected $casts = [
        'tgl_pinjam' => 'date',
        'tgl_kembali_rencana' => 'date',
    ];

    public function peminjam() { return $this->belongsTo(User::class, 'peminjam_id'); }
    public function petugas() { return $this->belongsTo(User::class, 'petugas_id'); }
    public function details() { return $this->hasMany(DetailPeminjaman::class); }
    public function pengembalian() { return $this->hasOne(Pengembalian::class); }
}
