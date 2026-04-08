<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TbTarif;
use App\Models\TbLogAktivitas;
use Illuminate\Support\Facades\Auth;

class TarifController extends Controller
{
    public function index()
    {
        $tarifs = TbTarif::orderBy('jenis_kendaraan')->get();
        return view('admin.tarif.index', compact('tarifs'));
    }

    public function create()
    {
        return view('admin.tarif.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_kendaraan' => 'required|in:motor,mobil,lainnya',
            'tarif_per_jam'   => 'required|numeric|min:0',
        ]);

        TbTarif::create($request->only('jenis_kendaraan', 'tarif_per_jam'));
        TbLogAktivitas::catat(Auth::id(), "Tambah tarif: {$request->jenis_kendaraan}");
        return redirect()->route('tarif.index')->with('success', 'Tarif berhasil ditambahkan.');
    }

    public function edit(TbTarif $tarif)
    {
        return view('admin.tarif.edit', compact('tarif'));
    }

    public function update(Request $request, TbTarif $tarif)
    {
        $request->validate([
            'jenis_kendaraan' => 'required|in:motor,mobil,lainnya',
            'tarif_per_jam'   => 'required|numeric|min:0',
        ]);

        $tarif->update($request->only('jenis_kendaraan', 'tarif_per_jam'));
        TbLogAktivitas::catat(Auth::id(), "Update tarif: {$tarif->jenis_kendaraan}");
        return redirect()->route('tarif.index')->with('success', 'Tarif berhasil diperbarui.');
    }

    public function destroy(TbTarif $tarif)
    {
        TbLogAktivitas::catat(Auth::id(), "Hapus tarif: {$tarif->jenis_kendaraan}");
        $tarif->delete();
        return redirect()->route('tarif.index')->with('success', 'Tarif berhasil dihapus.');
    }
}
