<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogAktivitas extends Model
{
    protected $table = 'log_aktivitas';
    protected $fillable = ['user_id', 'aksi', 'tabel_target', 'target_id', 'detail', 'ip_address'];

    public function user() { return $this->belongsTo(User::class); }

    public static function catat(string $aksi, string $tabel = null, int $targetId = null, string $detail = null): void
    {
        if (auth()->check()) {
            self::create([
                'user_id'      => auth()->id(),
                'aksi'         => $aksi,
                'tabel_target' => $tabel,
                'target_id'    => $targetId,
                'detail'       => $detail,
                'ip_address'   => request()->ip(),
            ]);
        }
    }
}
