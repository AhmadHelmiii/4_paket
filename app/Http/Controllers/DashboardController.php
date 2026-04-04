<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Peminjaman;
use App\Models\User;
use App\Models\LogAktivitas;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $data = match($user->role) {
            'admin' => [
                'total_users'      => User::count(),
                'total_alat'       => Alat::count(),
                'peminjaman_aktif' => Peminjaman::where('status', 'dipinjam')->count(),
                'terlambat'        => Peminjaman::where('status', 'dipinjam')
                                        ->whereDate('tgl_kembali_rencana', '<', today())->count(),
                'pending'          => Peminjaman::where('status', 'menunggu')
                                        ->with('peminjam', 'details.alat')->latest()->take(5)->get(),
                'log_terbaru'      => LogAktivitas::with('user')->latest()->take(5)->get(),
            ],
            'petugas' => [
                'peminjaman_aktif' => Peminjaman::where('status', 'dipinjam')->count(),
                'menunggu'         => Peminjaman::where('status', 'menunggu')->count(),
                'terlambat'        => Peminjaman::where('status', 'dipinjam')
                                        ->whereDate('tgl_kembali_rencana', '<', today())->count(),
                'pending'          => Peminjaman::where('status', 'menunggu')
                                        ->with('peminjam', 'details.alat')->latest()->take(5)->get(),
            ],
            'peminjam' => [
                'peminjaman_saya'  => Peminjaman::where('peminjam_id', $user->id)->latest()->take(5)->get(),
                'aktif'            => Peminjaman::where('peminjam_id', $user->id)->where('status', 'dipinjam')->count(),
                'menunggu'         => Peminjaman::where('peminjam_id', $user->id)->where('status', 'menunggu')->count(),
                'alat_tersedia'    => Alat::where('stok_tersedia', '>', 0)->count(),
            ],
            default => [],
        };

        return view('dashboard', compact('data'));
    }
}
