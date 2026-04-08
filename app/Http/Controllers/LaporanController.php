<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TbTransaksi;
use App\Models\TbKendaraan;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $dari   = $request->input('dari', Carbon::today()->toDateString());
        $sampai = $request->input('sampai', Carbon::today()->toDateString());
        $jenis  = $request->input('jenis_kendaraan', 'semua');

        $query = TbTransaksi::with(['kendaraan', 'area'])
            ->where('status', 'keluar')
            ->whereBetween('waktu_masuk', [
                Carbon::parse($dari)->startOfDay(),
                Carbon::parse($sampai)->endOfDay(),
            ]);

        if ($jenis !== 'semua') {
            $query->whereHas('kendaraan', fn($q) => $q->where('jenis_kendaraan', $jenis));
        }

        $transaksis       = $query->orderByDesc('waktu_masuk')->paginate(20)->withQueryString();
        $totalPendapatan  = $query->sum('biaya_total');
        $totalKendaraan   = $query->count();

        // Rekapitulasi harian
        $rekap = TbTransaksi::selectRaw('DATE(waktu_masuk) as tanggal, COUNT(*) as total, SUM(biaya_total) as pendapatan')
            ->where('status', 'keluar')
            ->whereBetween('waktu_masuk', [
                Carbon::parse($dari)->startOfDay(),
                Carbon::parse($sampai)->endOfDay(),
            ])
            ->groupBy('tanggal')
            ->orderByDesc('tanggal')
            ->get();

        return view('owner.laporan.index', compact(
            'transaksis', 'totalPendapatan', 'totalKendaraan',
            'dari', 'sampai', 'jenis', 'rekap'
        ));
    }
}
