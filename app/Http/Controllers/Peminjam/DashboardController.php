<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $stats = [
            'menunggu'      => Peminjaman::where('peminjam_id', $user->id)->where('status', 'menunggu')->count(),
            'dipinjam'      => Peminjaman::where('peminjam_id', $user->id)->where('status', 'dipinjam')->count(),
            'dikembalikan'  => Peminjaman::where('peminjam_id', $user->id)->where('status', 'dikembalikan')->count(),
        ];

        $riwayat = Peminjaman::with(['details.alat'])
                    ->where('peminjam_id', $user->id)
                    ->latest()->limit(5)->get();

        return view('peminjam.dashboard', compact('stats', 'riwayat'));
    }
}
