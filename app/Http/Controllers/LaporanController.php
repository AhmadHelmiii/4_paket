<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    private function buildQuery(Request $request)
    {
        $query = Peminjaman::with('peminjam', 'details.alat', 'pengembalian')->latest();

        if ($request->filled('tgl_mulai'))   $query->whereDate('created_at', '>=', $request->tgl_mulai);
        if ($request->filled('tgl_selesai')) $query->whereDate('created_at', '<=', $request->tgl_selesai);
        if ($request->filled('status'))      $query->where('status', $request->status);
        if ($request->filled('peminjam_id')) $query->where('peminjam_id', $request->peminjam_id);

        return $query;
    }

    public function index(Request $request)
    {
        $peminjamans   = $this->buildQuery($request)->paginate(15)->withQueryString();
        $peminjams     = User::where('role', 'peminjam')->orderBy('name')->get();
        $totalDenda    = Pengembalian::sum('denda');
        $totalAktif    = Peminjaman::where('status', 'dipinjam')->count();
        $totalPeminjam = User::where('role', 'peminjam')->count();

        return view('laporan.index', compact(
            'peminjamans', 'peminjams', 'totalDenda', 'totalAktif', 'totalPeminjam'
        ));
    }

    public function exportPdf(Request $request)
    {
        $peminjamans   = $this->buildQuery($request)->get();
        $totalDenda    = $peminjamans->sum(fn($p) => $p->pengembalian?->denda ?? 0);
        $totalAktif    = $peminjamans->where('status', 'dipinjam')->count();
        $tglMulai      = $request->tgl_mulai ?? '-';
        $tglSelesai    = $request->tgl_selesai ?? '-';

        $pdf = Pdf::loadView('laporan.pdf', compact(
            'peminjamans', 'totalDenda', 'totalAktif', 'tglMulai', 'tglSelesai'
        ))->setPaper('a4', 'landscape');

        return $pdf->download('laporan-peminjaman-' . now()->format('Ymd') . '.pdf');
    }
}
