<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TbTransaksi;
use App\Models\TbKendaraan;
use App\Models\TbTarif;
use App\Models\TbAreaParkir;
use App\Models\TbLogAktivitas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        $query = TbTransaksi::with(['kendaraan', 'tarif', 'area', 'user']);

        if ($request->filled('search')) {
            $query->whereHas('kendaraan', fn($q) => $q->where('plat_nomor', 'like', '%'.$request->search.'%'));
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $transaksis = $query->orderByDesc('waktu_masuk')->paginate(15)->withQueryString();
        return view('petugas.transaksi.index', compact('transaksis'));
    }

    public function create()
    {
        $areas  = TbAreaParkir::where('terisi', '<', DB::raw('kapasitas'))->get();
        $tarifs = TbTarif::all();
        return view('petugas.transaksi.create', compact('areas', 'tarifs'));
    }

    /**
     * Proses kendaraan masuk
     */
    public function store(Request $request)
    {
        $request->validate([
            'plat_nomor'      => 'required|string|max:15',
            'jenis_kendaraan' => 'required|in:motor,mobil,lainnya',
            'id_area'         => 'required|exists:tb_area_parkir,id_area',
            'warna'           => 'nullable|string|max:20',
            'pemilik'         => 'nullable|string|max:100',
        ]);

        // Cek apakah kendaraan sudah di dalam
        $kendaraan = TbKendaraan::where('plat_nomor', $request->plat_nomor)->first();
        if ($kendaraan) {
            $aktif = $kendaraan->transaksiAktif;
            if ($aktif) {
                return back()->with('error', 'Kendaraan dengan plat ' . $request->plat_nomor . ' masih berada di dalam parkir.');
            }
        }

        // Ambil tarif sesuai jenis
        $tarif = TbTarif::where('jenis_kendaraan', $request->jenis_kendaraan)->first();
        if (!$tarif) {
            return back()->with('error', 'Tarif untuk jenis kendaraan ini belum diatur.');
        }

        DB::transaction(function () use ($request, $tarif, &$kendaraan) {
            // Buat atau update kendaraan
            $kendaraan = TbKendaraan::updateOrCreate(
                ['plat_nomor' => strtoupper($request->plat_nomor)],
                [
                    'jenis_kendaraan' => $request->jenis_kendaraan,
                    'warna'           => $request->warna,
                    'pemilik'         => $request->pemilik,
                ]
            );

            // Buat transaksi masuk
            TbTransaksi::create([
                'id_kendaraan' => $kendaraan->id_kendaraan,
                'waktu_masuk'  => now(),
                'id_tarif'     => $tarif->id_tarif,
                'status'       => 'masuk',
                'id_user'      => Auth::id(),
                'id_area'      => $request->id_area,
            ]);

            // Update slot area
            TbAreaParkir::where('id_area', $request->id_area)->increment('terisi');
        });

        TbLogAktivitas::catat(Auth::id(), "Kendaraan masuk: {$request->plat_nomor}");
        return redirect()->route('petugas.transaksi.index')->with('success', 'Kendaraan berhasil dicatat masuk.');
    }

    /**
     * Proses kendaraan keluar (checkout)
     */
    public function checkout(Request $request)
    {
        $transaksi = null;
        $kendaraan = null;
        $hasil = null;

        if ($request->filled('plat_nomor')) {
            $kendaraan = TbKendaraan::where('plat_nomor', strtoupper($request->plat_nomor))->first();

            if (!$kendaraan) {
                return back()->with('error', 'Kendaraan dengan plat ' . strtoupper($request->plat_nomor) . ' tidak ditemukan.');
            }

            $transaksi = $kendaraan->transaksiAktif;
            if (!$transaksi) {
                return back()->with('error', 'Kendaraan ' . strtoupper($request->plat_nomor) . ' tidak sedang parkir.');
            }

            $transaksi->load('tarif');
            $hasil = $transaksi->hitungBiaya();
        }

        return view('petugas.transaksi.checkout', compact('transaksi', 'kendaraan', 'hasil'));
    }

    public function prosesCheckout(Request $request, TbTransaksi $transaksi)
    {
        if ($transaksi->status === 'keluar') {
            return redirect()->route('petugas.transaksi.index')->with('error', 'Transaksi sudah selesai.');
        }

        $transaksi->load('tarif');
        $hasil = $transaksi->hitungBiaya();

        DB::transaction(function () use ($transaksi, $hasil) {
            $transaksi->update([
                'waktu_keluar' => $hasil['keluar'],
                'durasi_jam'   => $hasil['durasi'],
                'biaya_total'  => $hasil['biaya'],
                'status'       => 'keluar',
            ]);

            TbAreaParkir::where('id_area', $transaksi->id_area)->decrement('terisi');
        });

        TbLogAktivitas::catat(Auth::id(), "Kendaraan keluar: {$transaksi->kendaraan->plat_nomor}");
        return redirect()->route('petugas.transaksi.struk', $transaksi->id_parkir);
    }

    public function struk(TbTransaksi $transaksi)
    {
        $transaksi->load(['kendaraan', 'tarif', 'area', 'user']);
        return view('petugas.transaksi.struk', compact('transaksi'));
    }

    public function cetakStruk(TbTransaksi $transaksi)
    {
        $transaksi->load(['kendaraan', 'tarif', 'area', 'user']);
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('petugas.transaksi.struk-pdf', compact('transaksi'));
        return $pdf->stream('struk-parkir-' . $transaksi->id_parkir . '.pdf');
    }
}
