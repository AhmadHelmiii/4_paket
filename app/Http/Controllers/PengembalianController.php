<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\DetailPeminjaman;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengembalianController extends Controller
{
    // Daftar peminjaman yang perlu diproses (dipinjam + menunggu_konfirmasi)
    public function index()
    {
        $peminjamans = Peminjaman::with('peminjam', 'details.alat', 'pengembalian')
            ->whereIn('status', ['dipinjam', 'menunggu_konfirmasi'])
            ->latest()
            ->paginate(10);

        return view('pengembalian.index', compact('peminjamans'));
    }

    // Form proses pengembalian oleh petugas
    public function show(Peminjaman $peminjaman)
    {
        if (!in_array($peminjaman->status, ['dipinjam', 'menunggu_konfirmasi'])) {
            return back()->with('error', 'Peminjaman ini tidak dalam status aktif.');
        }

        $peminjaman->load('peminjam', 'details.alat');

        $hariTerlambat = max(0, today()->diffInDays($peminjaman->tgl_kembali_rencana, false) * -1);
        $estimasiDenda = $hariTerlambat * 5000;

        return view('pengembalian.show', compact('peminjaman', 'hariTerlambat', 'estimasiDenda'));
    }

    // Petugas proses pengembalian — panggil stored procedure langsung tanpa wrapper transaction
    public function store(Request $request, Peminjaman $peminjaman)
    {
        $request->validate([
            'tgl_kembali'     => 'required|date',
            'kondisi_akhir'   => 'required|array',
            'kondisi_akhir.*' => 'in:baik,rusak ringan,rusak berat',
            'keterangan'      => 'nullable|string',
        ]);

        if (!in_array($peminjaman->status, ['dipinjam', 'menunggu_konfirmasi'])) {
            return back()->with('error', 'Peminjaman ini tidak dalam status aktif.');
        }

        // Update kondisi akhir tiap alat
        foreach ($request->kondisi_akhir as $detailId => $kondisi) {
            DetailPeminjaman::where('id', $detailId)
                ->where('peminjaman_id', $peminjaman->id)
                ->update(['kondisi_akhir' => $kondisi]);
        }

        // Panggil stored procedure — sudah ada START TRANSACTION, COMMIT, ROLLBACK di dalamnya
        DB::statement('CALL proses_pengembalian(?, ?, ?, ?)', [
            $peminjaman->id,
            auth()->id(),
            $request->tgl_kembali,
            $request->keterangan,
        ]);

        LogAktivitas::catat('update', 'peminjaman', $peminjaman->id,
            "Petugas proses pengembalian: {$peminjaman->kode_pinjam}");

        return redirect()->route('pengembalian.index')
            ->with('success', 'Pengembalian berhasil diproses.');
    }

    // Admin: lihat semua riwayat pengembalian
    public function semua()
    {
        $pengembalians = Pengembalian::with('peminjaman.peminjam', 'peminjaman.details.alat', 'petugas')
            ->latest()->paginate(15);
        return view('pengembalian.semua', compact('pengembalians'));
    }

    // Admin: hapus data pengembalian
    public function destroy(Pengembalian $pengembalian)
    {
        LogAktivitas::catat('delete', 'pengembalian', $pengembalian->id,
            "Hapus pengembalian ID: {$pengembalian->id}");
        $pengembalian->delete();
        return back()->with('success', 'Data pengembalian berhasil dihapus.');
    }
}
