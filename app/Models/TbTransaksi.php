<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class TbTransaksi extends Model
{
    protected $table = 'tb_transaksi';
    protected $primaryKey = 'id_parkir';

    public function getRouteKeyName(): string { return 'id_parkir'; }

    protected $fillable = [
        'id_kendaraan', 'waktu_masuk', 'waktu_keluar',
        'id_tarif', 'durasi_jam', 'biaya_total', 'status', 'id_user', 'id_area',
    ];

    protected $casts = [
        'waktu_masuk'  => 'datetime',
        'waktu_keluar' => 'datetime',
    ];

    public function kendaraan()
    {
        return $this->belongsTo(TbKendaraan::class, 'id_kendaraan', 'id_kendaraan');
    }

    public function tarif()
    {
        return $this->belongsTo(TbTarif::class, 'id_tarif', 'id_tarif');
    }

    public function user()
    {
        return $this->belongsTo(TbUser::class, 'id_user', 'id_user');
    }

    public function area()
    {
        return $this->belongsTo(TbAreaParkir::class, 'id_area', 'id_area');
    }

    /**
     * Hitung durasi dan biaya saat checkout
     */
    public function hitungBiaya(): array
    {
        $masuk  = Carbon::parse($this->waktu_masuk);
        $keluar = Carbon::now();
        $durasi = max(1, (int) ceil($masuk->diffInMinutes($keluar) / 60));
        $biaya  = $durasi * $this->tarif->tarif_per_jam;

        return ['durasi' => $durasi, 'biaya' => $biaya, 'keluar' => $keluar];
    }
}
