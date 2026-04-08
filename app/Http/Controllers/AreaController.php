<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TbAreaParkir;
use App\Models\TbLogAktivitas;
use Illuminate\Support\Facades\Auth;

class AreaController extends Controller
{
    public function index()
    {
        $areas = TbAreaParkir::orderBy('nama_area')->paginate(10);
        return view('admin.area.index', compact('areas'));
    }

    public function create()
    {
        return view('admin.area.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_area'  => 'required|string|max:50',
            'kapasitas'  => 'required|integer|min:1',
        ]);

        TbAreaParkir::create([
            'nama_area' => $request->nama_area,
            'kapasitas' => $request->kapasitas,
            'terisi'    => 0,
        ]);

        TbLogAktivitas::catat(Auth::id(), "Tambah area parkir: {$request->nama_area}");
        return redirect()->route('area.index')->with('success', 'Area parkir berhasil ditambahkan.');
    }

    public function edit(TbAreaParkir $area)
    {
        return view('admin.area.edit', compact('area'));
    }

    public function update(Request $request, TbAreaParkir $area)
    {
        $request->validate([
            'nama_area' => 'required|string|max:50',
            'kapasitas' => 'required|integer|min:1',
        ]);

        $area->update($request->only('nama_area', 'kapasitas'));
        TbLogAktivitas::catat(Auth::id(), "Update area parkir: {$area->nama_area}");
        return redirect()->route('area.index')->with('success', 'Area parkir berhasil diperbarui.');
    }

    public function destroy(TbAreaParkir $area)
    {
        TbLogAktivitas::catat(Auth::id(), "Hapus area parkir: {$area->nama_area}");
        $area->delete();
        return redirect()->route('area.index')->with('success', 'Area parkir berhasil dihapus.');
    }
}
