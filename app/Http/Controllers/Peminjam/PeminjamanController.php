<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\Peminjaman;
use App\Models\DetailPeminjaman;
use App\Traits\LogsActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    use LogsActivity;

    public function index(Request $request)
    {
        $kategoris = \App\Models\KategoriAlat::orderBy('nama_kategori')->get();
        $query     = Alat::with('kategori')->where('stok_tersedia', '>', 0)->where('kondisi', '!=', 'rusak berat');

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama_alat', 'like', "%{$request->search}%")
                  ->orWhere('kode_alat', 'like', "%{$request->search}%");
            });
        }
        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        $alat = $query->paginate(12)->withQueryString();
        return view('peminjam.pinjam.index', compact('alat', 'kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'alat'                  => 'required|array|min:1|max:3',
            'alat.*.id'             => 'required|exists:alat,id',
            'alat.*.jumlah'         => 'required|integer|min:1',
            'tgl_kembali_rencana'   => 'required|date|after:today|before_or_equal:' . now()->addDays(7)->toDateString(),
            'catatan'               => 'nullable|string|max:500',
        ]);

        DB::beginTransaction();
        try {
            // Validasi stok semua alat
            foreach ($request->alat as $item) {
                $alat = Alat::findOrFail($item['id']);
                if ($alat->stok_tersedia < $item['jumlah']) {
                    throw new \Exception("Stok alat '{$alat->nama_alat}' tidak mencukupi.");
                }
            }

            // Generate kode pinjam unik
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

            foreach ($request->alat as $item) {
                DetailPeminjaman::create([
                    'peminjaman_id' => $peminjaman->id,
                    'alat_id'       => $item['id'],
                    'jumlah'        => $item['jumlah'],
                ]);
            }

            DB::commit();
            $this->logAktivitas('create', 'peminjaman', $peminjaman->id, "Ajukan peminjaman: {$kode}");

            return redirect()->route('peminjam.pinjam.riwayat')->with('success', "Pengajuan berhasil! Kode: {$kode}");
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function riwayat()
    {
        $peminjaman = Peminjaman::with(['details.alat', 'pengembalian'])
                        ->where('peminjam_id', auth()->id())
                        ->latest()->paginate(10);

        return view('peminjam.pinjam.riwayat', compact('peminjaman'));
    }

    public function show($id)
    {
        $peminjaman = Peminjaman::with(['details.alat', 'petugas', 'pengembalian'])
                        ->where('peminjam_id', auth()->id())
                        ->findOrFail($id);

        return view('peminjam.pinjam.show', compact('peminjaman'));
    }
}
