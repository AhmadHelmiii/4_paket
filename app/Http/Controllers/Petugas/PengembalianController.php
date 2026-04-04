<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Traits\LogsActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengembalianController extends Controller
{
    use LogsActivity;

    public function index()
    {
        $peminjaman = Peminjaman::with(['peminjam', 'details.alat'])
                        ->where('status', 'dipinjam')
                        ->latest()->paginate(15);

        return view('petugas.pengembalian.index', compact('peminjaman'));
    }

    public function show($id)
    {
        $peminjaman = Peminjaman::with(['peminjam', 'details.alat'])
                        ->where('status', 'dipinjam')
                        ->findOrFail($id);

        return view('petugas.pengembalian.show', compact('peminjaman'));
    }

    public function proses(Request $request, $id)
    {
        $request->validate([
            'tgl_kembali'   => 'required|date',
            'kondisi_akhir' => 'required|array',
            'kondisi_akhir.*' => 'required|in:baik,rusak ringan,rusak berat',
            'keterangan'    => 'nullable|string',
        ]);

        $peminjaman = Peminjaman::where('status', 'dipinjam')->findOrFail($id);

        try {
            // Gunakan stored procedure MySQL
            DB::statement('CALL proses_pengembalian(?, ?, ?, ?)', [
                $peminjaman->id,
                auth()->id(),
                $request->tgl_kembali,
                $request->keterangan,
            ]);

            // Update kondisi akhir alat
            foreach ($request->kondisi_akhir as $detail_id => $kondisi) {
                $peminjaman->details()->where('id', $detail_id)->update(['kondisi_akhir' => $kondisi]);
            }

            $this->logAktivitas('pengembalian', 'peminjaman', $peminjaman->id, "Proses pengembalian: {$peminjaman->kode_pinjam}");

            return redirect()->route('petugas.kembali.index')->with('success', 'Pengembalian berhasil diproses.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memproses pengembalian: ' . $e->getMessage());
        }
    }
}
