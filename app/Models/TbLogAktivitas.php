<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TbLogAktivitas extends Model
{
    protected $table = 'tb_log_aktivitas';
    protected $primaryKey = 'id_log';
    public $timestamps = false;

    protected $fillable = ['id_user', 'aktivitas', 'waktu_aktivitas'];

    protected $casts = ['waktu_aktivitas' => 'datetime'];

    public function user()
    {
        return $this->belongsTo(TbUser::class, 'id_user', 'id_user');
    }

    /**
     * Helper untuk catat log
     */
    public static function catat(int $idUser, string $aktivitas): void
    {
        self::create([
            'id_user'          => $idUser,
            'aktivitas'        => $aktivitas,
            'waktu_aktivitas'  => now(),
        ]);
    }
}
