<?php

namespace App\Traits;

use App\Models\LogAktivitas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

trait LogsActivity
{
    protected function logAktivitas(string $aksi, string $tabelTarget = null, int $targetId = null, string $detail = null): void
    {
        LogAktivitas::create([
            'user_id'      => Auth::id(),
            'aksi'         => $aksi,
            'tabel_target' => $tabelTarget,
            'target_id'    => $targetId,
            'detail'       => $detail,
            'ip_address'   => Request::ip(),
        ]);
    }
}
