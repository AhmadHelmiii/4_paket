<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Traits\LogsActivity;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    use LogsActivity;

    public function index(Request $request)
    {
        $query = Peminjaman::with(['peminjam', 'details.alat']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $peminjaman = $query->latest()->paginate(15)->withQueryString();
        return view('petugas.peminjaman.index', compact('peminjaman'));
    }

    public function aksi(Request $request, $id)
    {
        $request->validate([
            'aksi'    => 'required|in:setujui,tolak',
            'catatan' => 'nullable|string',
        ]);

        $peminjaman = Peminjaman::where('status', 'menunggu')->findOrFail($id);

        if ($request->aksi === 'setujui') {
            // Cek stok cukup untuk semua alat
            foreach ($peminjaman->details as $detail) {
                if ($detail->alat->stok_tersedia < $detail->jumlah) {
                    return back()->with('error', "Stok alat '{$detail->alat->nama_alat}' tidak mencukupi.");
                }
            }

            $peminjaman->update([
                'status'          => 'dipinjam',
                'petugas_id'      => auth()->id(),
                'tgl_pinjam'      => today(),
                'catatan_petugas' => $request->catatan,
            ]);

            $this->logAktivitas('setujui', 'peminjaman', $peminjaman->id, "Setujui peminjaman: {$peminjaman->kode_pinjam}");
        } else {
            $peminjaman->update([
                'status'          => 'ditolak',
                'petugas_id'      => auth()->id(),
                'catatan_petugas' => $request->catatan,
            ]);

            $this->logAktivitas('tolak', 'peminjaman', $peminjaman->id, "Tolak peminjaman: {$peminjaman->kode_pinjam}");
        }

        return back()->with('success', 'Peminjaman berhasil diproses.');
    }
}
