<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = Peminjaman::with(['peminjam', 'details.alat', 'pengembalian']);

        if ($request->filled('tgl_mulai')) {
            $query->whereDate('created_at', '>=', $request->tgl_mulai);
        }
        if ($request->filled('tgl_selesai')) {
            $query->whereDate('created_at', '<=', $request->tgl_selesai);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('peminjam_id')) {
            $query->where('peminjam_id', $request->peminjam_id);
        }

        $peminjaman = $query->latest()->paginate(20)->withQueryString();

        $ringkasan = [
            'total_pinjam'  => $query->count(),
            'total_denda'   => \App\Models\Pengembalian::sum('denda'),
            'aktif'         => Peminjaman::where('status', 'dipinjam')->count(),
        ];

        $peminjams = User::where('role', 'peminjam')->orderBy('name')->get();

        return view('petugas.laporan.index', compact('peminjaman', 'ringkasan', 'peminjams'));
    }

    public function pdf(Request $request)
    {
        // Placeholder — bisa diimplementasi dengan DomPDF nanti
        return back()->with('error', 'Fitur PDF belum tersedia. Install package barryvdh/laravel-dompdf terlebih dahulu.');
    }
}
