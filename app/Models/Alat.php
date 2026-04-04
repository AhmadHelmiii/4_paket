<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{
    protected $table = 'alat';
    protected $fillable = [
        'kategori_id', 'nama_alat', 'kode_alat',
        'stok_total', 'stok_tersedia', 'kondisi', 'deskripsi', 'foto'
    ];

    public function kategori() { return $this->belongsTo(KategoriAlat::class, 'kategori_id'); }
    public function detailPeminjaman() { return $this->hasMany(DetailPeminjaman::class); }

    /**
     * Return URL foto — support URL eksternal maupun file lokal di storage
     */
    public function getFotoUrlAttribute(): ?string
    {
        if (!$this->foto) return null;
        if (str_starts_with($this->foto, 'http')) return $this->foto;
        return \Storage::url($this->foto);
    }
}
