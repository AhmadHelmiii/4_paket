<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TbKendaraan;
use App\Models\TbUser;
use App\Models\TbLogAktivitas;
use Illuminate\Support\Facades\Auth;

class KendaraanController extends Controller
{
    public function index(Request $request)
    {
        $query = TbKendaraan::with('user');

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('plat_nomor', 'like', '%'.$request->search.'%')
                  ->orWhere('pemilik', 'like', '%'.$request->search.'%');
            });
        }

        if ($request->filled('jenis')) {
            $query->where('jenis_kendaraan', $request->jenis);
        }

        $kendaraans = $query->orderByDesc('created_at')->paginate(10)->withQueryString();
        return view('admin.kendaraan.index', compact('kendaraans'));
    }

    public function create()
    {
        $users = TbUser::where('status_aktif', 1)->orderBy('nama_lengkap')->get();
        return view('admin.kendaraan.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'plat_nomor'      => 'required|string|max:15|unique:tb_kendaraan,plat_nomor',
            'jenis_kendaraan' => 'required|string|max:20',
            'warna'           => 'nullable|string|max:20',
            'pemilik'         => 'nullable|string|max:100',
            'id_user'         => 'nullable|exists:tb_user,id_user',
        ]);

        TbKendaraan::create($request->only('plat_nomor', 'jenis_kendaraan', 'warna', 'pemilik', 'id_user'));
        TbLogAktivitas::catat(Auth::id(), "Tambah kendaraan: {$request->plat_nomor}");
        return redirect()->route('kendaraan.index')->with('success', 'Kendaraan berhasil ditambahkan.');
    }

    public function edit(TbKendaraan $kendaraan)
    {
        $users = TbUser::where('status_aktif', 1)->orderBy('nama_lengkap')->get();
        return view('admin.kendaraan.edit', compact('kendaraan', 'users'));
    }

    public function update(Request $request, TbKendaraan $kendaraan)
    {
        $request->validate([
            'plat_nomor'      => 'required|string|max:15|unique:tb_kendaraan,plat_nomor,' . $kendaraan->id_kendaraan . ',id_kendaraan',
            'jenis_kendaraan' => 'required|string|max:20',
            'warna'           => 'nullable|string|max:20',
            'pemilik'         => 'nullable|string|max:100',
            'id_user'         => 'nullable|exists:tb_user,id_user',
        ]);

        $kendaraan->update($request->only('plat_nomor', 'jenis_kendaraan', 'warna', 'pemilik', 'id_user'));
        TbLogAktivitas::catat(Auth::id(), "Update kendaraan: {$kendaraan->plat_nomor}");
        return redirect()->route('kendaraan.index')->with('success', 'Kendaraan berhasil diperbarui.');
    }

    public function destroy(TbKendaraan $kendaraan)
    {
        TbLogAktivitas::catat(Auth::id(), "Hapus kendaraan: {$kendaraan->plat_nomor}");
        $kendaraan->delete();
        return redirect()->route('kendaraan.index')->with('success', 'Kendaraan berhasil dihapus.');
    }
}
