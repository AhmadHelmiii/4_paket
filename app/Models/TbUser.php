<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class TbUser extends Authenticatable
{
    use Notifiable;

    protected $table = 'tb_user';
    protected $primaryKey = 'id_user';

    public function getRouteKeyName(): string { return 'id_user'; }

    protected $fillable = [
        'nama_lengkap', 'username', 'password', 'role', 'status_aktif',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = ['status_aktif' => 'boolean'];

    public function transaksi()
    {
        return $this->hasMany(TbTransaksi::class, 'id_user', 'id_user');
    }

    public function logAktivitas()
    {
        return $this->hasMany(TbLogAktivitas::class, 'id_user', 'id_user');
    }

    public function isAdmin(): bool    { return $this->role === 'admin'; }
    public function isPetugas(): bool  { return $this->role === 'petugas'; }
    public function isOwner(): bool    { return $this->role === 'owner'; }
}
