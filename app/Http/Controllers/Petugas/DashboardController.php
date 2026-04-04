<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\Peminjaman;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'menunggu'         => Peminjaman::where('status', 'menunggu')->count(),
            'dipinjam'         => Peminjaman::where('status', 'dipinjam')->count(),
            'terlambat'        => Peminjaman::where('status', 'dipinjam')
                                    ->whereDate('tgl_kembali_rencana', '<', today())->count(),
            'alat_tersedia'    => Alat::where('stok_tersedia', '>', 0)->count(),
        ];

        $pending = Peminjaman::with(['peminjam', 'details.alat'])
                    ->where('status', 'menunggu')->latest()->limit(5)->get();

        $dipinjam = Peminjaman::with(['peminjam', 'details.alat'])
                    ->where('status', 'dipinjam')
                    ->whereDate('tgl_kembali_rencana', '<', today())
                    ->latest()->limit(5)->get();

        return view('petugas.dashboard', compact('stats', 'pending', 'dipinjam'));
    }
}
