<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Alat;
use App\Models\Peminjaman;
use App\Models\LogAktivitas;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_user'        => User::count(),
            'alat_tersedia'     => Alat::where('stok_tersedia', '>', 0)->count(),
            'peminjaman_aktif'  => Peminjaman::where('status', 'dipinjam')->count(),
            'terlambat_kembali' => Peminjaman::where('status', 'dipinjam')
                                    ->whereDate('tgl_kembali_rencana', '<', today())->count(),
        ];

        $log_terbaru = LogAktivitas::with('user')->latest()->limit(5)->get();
        $pending     = Peminjaman::with(['peminjam', 'details.alat'])
                        ->where('status', 'menunggu')->latest()->limit(5)->get();

        return view('admin.dashboard', compact('stats', 'log_terbaru', 'pending'));
    }
}
