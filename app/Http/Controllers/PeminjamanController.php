<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Peminjaman;
use App\Models\DetailPeminjaman;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    public function index()
    {
        $user  = auth()->user();
        $query = Peminjaman::with('peminjam', 'details.alat', 'pengembalian');

        if ($user->isPeminjam()) {
            $query->where('peminjam_id', $user->id);
        }

        $peminjamans = $query->latest()->paginate(10);
        return view('peminjaman.index', compact('peminjamans'));
    }

    public function create()
    {
        $alats = Alat::where('stok_tersedia', '>', 0)->with('kategori')->get();
        return view('peminjaman.create', compact('alats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'alat_ids'           => 'required|array|min:1|max:3',
            'alat_ids.*'         => 'exists:alat,id',
            'jumlah'             => 'required|array',
            'jumlah.*'           => 'integer|min:1',
            'tgl_kembali_rencana'=> 'required|date|after_or_equal:today|before_or_equal:' . now()->addDays(7)->toDateString(),
            'catatan'            => 'nullable|string',
        ]);

        // Validasi stok tiap alat
        foreach ($request->alat_ids as $alatId) {
            $alat   = Alat::findOrFail($alatId);
            $jumlah = $request->jumlah[$alatId] ?? 1;
            if ($alat->stok_tersedia < $jumlah) {
                return back()->withErrors(['alat_ids' => "Stok alat {$alat->nama_alat} tidak mencukupi."])->withInput();
            }
        }

        DB::transaction(function () use ($request) {
            $kode = 'PJM-' . now()->format('Ymd') . '-' . str_pad(
                Peminjaman::whereDate('created_at', today())->count() + 1, 3, '0', STR_PAD_LEFT
            );

            $peminjaman = Peminjaman::create([
                'kode_pinjam'         => $kode,
                'peminjam_id'         => auth()->id(),
                'tgl_kembali_rencana' => $request->tgl_kembali_rencana,
                'status'              => 'menunggu',
                'catatan'             => $request->catatan,
            ]);

            foreach ($request->alat_ids as $alatId) {
                DetailPeminjaman::create([
                    'peminjaman_id' => $peminjaman->id,
                    'alat_id'       => $alatId,
                    'jumlah'        => $request->jumlah[$alatId] ?? 1,
                ]);
            }

            LogAktivitas::catat('create', 'peminjaman', $peminjaman->id, "Ajukan peminjaman: {$kode}");
        });

        return redirect()->route('peminjaman.index')->with('success', 'Pengajuan peminjaman berhasil dikirim.');
    }

    public function show(Peminjaman $peminjaman)
    {
        $this->authorizeView($peminjaman);
        $peminjaman->load('peminjam', 'petugas', 'details.alat', 'pengembalian');
        return view('peminjaman.show', compact('peminjaman'));
    }

    public function aksi(Request $request, Peminjaman $peminjaman)
    {
        $request->validate([
            'aksi'            => 'required|in:setujui,tolak',
            'catatan_petugas' => 'nullable|string',
        ]);

        if ($peminjaman->status !== 'menunggu') {
            return back()->with('error', 'Peminjaman ini sudah diproses.');
        }

        DB::transaction(function () use ($request, $peminjaman) {
            if ($request->aksi === 'setujui') {
                $peminjaman->update([
                    'status'          => 'dipinjam',
                    'petugas_id'      => auth()->id(),
                    'tgl_pinjam'      => today(),
                    'catatan_petugas' => $request->catatan_petugas,
                ]);
                LogAktivitas::catat('update', 'peminjaman', $peminjaman->id, "Setujui peminjaman: {$peminjaman->kode_pinjam}");
            } else {
                $peminjaman->update([
                    'status'          => 'ditolak',
                    'petugas_id'      => auth()->id(),
                    'catatan_petugas' => $request->catatan_petugas,
                ]);
                LogAktivitas::catat('update', 'peminjaman', $peminjaman->id, "Tolak peminjaman: {$peminjaman->kode_pinjam}");
            }
        });

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil diproses.');
    }

    // Peminjam konfirmasi sudah mengembalikan alat ke petugas
    public function konfirmasi(Request $request, Peminjaman $peminjaman)
    {
        if ($peminjaman->peminjam_id !== auth()->id()) abort(403);
        if ($peminjaman->status !== 'dipinjam') {
            return back()->with('error', 'Peminjaman ini tidak dalam status dipinjam.');
        }

        $peminjaman->update([
            'status'             => 'menunggu_konfirmasi', // tunggu petugas konfirmasi
            'konfirmasi_kembali' => true,
            'catatan_kembali'    => $request->catatan_kembali,
        ]);

        LogAktivitas::catat('update', 'peminjaman', $peminjaman->id,
            "Peminjam konfirmasi pengembalian: {$peminjaman->kode_pinjam}");

        return back()->with('success', 'Konfirmasi terkirim. Petugas akan segera memproses pengembalian alat kamu.');
    }

    public function destroy(Peminjaman $peminjaman)
    {        if ($peminjaman->status === 'dipinjam') {
            return back()->with('error', 'Tidak bisa menghapus peminjaman yang sedang aktif.');
        }
        LogAktivitas::catat('delete', 'peminjaman', $peminjaman->id, "Hapus peminjaman: {$peminjaman->kode_pinjam}");
        $peminjaman->delete();
        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil dihapus.');
    }

    private function authorizeView(Peminjaman $peminjaman): void
    {
        $user = auth()->user();
        if ($user->isPeminjam() && $peminjaman->peminjam_id !== $user->id) {
            abort(403);
        }
    }
}
