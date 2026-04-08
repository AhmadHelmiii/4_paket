<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\TbTransaksi;
use App\Models\TbAreaParkir;
use App\Models\TbKendaraan;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Stats hari ini
        $today = Carbon::today();

        $totalMasukHariIni = TbTransaksi::whereDate('waktu_masuk', $today)->count();
        $kendaraanAktif    = TbTransaksi::where('status', 'masuk')->count();
        $pendapatanHariIni = TbTransaksi::whereDate('waktu_masuk', $today)
                                ->where('status', 'keluar')
                                ->sum('biaya_total');

        $areas = TbAreaParkir::all();

        // Transaksi terbaru
        $transaksiTerbaru = TbTransaksi::with(['kendaraan', 'area'])
            ->orderByDesc('waktu_masuk')
            ->limit(5)
            ->get();

        // Data chart per jam (24 jam terakhir)
        $chartData = $this->getChartData();

        return view('dashboard', compact(
            'user', 'totalMasukHariIni', 'kendaraanAktif',
            'pendapatanHariIni', 'areas', 'transaksiTerbaru', 'chartData'
        ));
    }

    private function getChartData(): array
    {
        $labels = [];
        $data   = [];

        for ($i = 0; $i < 24; $i++) {
            $jam = str_pad($i, 2, '0', STR_PAD_LEFT) . ':00';
            $labels[] = $jam;
            $data[] = TbTransaksi::whereDate('waktu_masuk', Carbon::today())
                ->whereRaw('HOUR(waktu_masuk) = ?', [$i])
                ->count();
        }

        return ['labels' => $labels, 'data' => $data];
    }
}
