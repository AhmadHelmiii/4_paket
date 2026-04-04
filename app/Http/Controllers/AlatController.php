<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\KategoriAlat;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;

class AlatController extends Controller
{
    public function index(Request $request)
    {
        $query = Alat::with('kategori');

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('nama_alat', 'like', "%{$request->search}%")
                  ->orWhere('kode_alat', 'like', "%{$request->search}%");
            });
        }
        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }
        if ($request->filled('tersedia')) {
            $query->where('stok_tersedia', '>', 0);
        }

        $alats     = $query->latest()->paginate(10)->withQueryString();
        $kategoris = KategoriAlat::orderBy('nama_kategori')->get();

        return view('alat.index', compact('alats', 'kategoris'));
    }

    public function create()
    {
        $kategoris = KategoriAlat::orderBy('nama_kategori')->get();
        return view('alat.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required|exists:kategori_alat,id',
            'nama_alat'   => 'required|string|max:150',
            'kode_alat'   => 'required|string|max:50|unique:alat',
            'stok_total'  => 'required|integer|min:1',
            'kondisi'     => 'required|in:baik,rusak ringan,rusak berat',
            'deskripsi'   => 'nullable|string',
            'foto'        => 'nullable|image|max:2048',
        ]);

        $data = $request->only('kategori_id', 'nama_alat', 'kode_alat', 'stok_total', 'kondisi', 'deskripsi');
        $data['stok_tersedia'] = $request->stok_total;

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('alat', 'public');
        }

        $alat = Alat::create($data);
        LogAktivitas::catat('create', 'alat', $alat->id, "Tambah alat: {$alat->nama_alat}");

        return redirect()->route('alat.index')->with('success', 'Alat berhasil ditambahkan.');
    }

    public function show(Alat $alat)
    {
        $alat->load('kategori', 'detailPeminjaman.peminjaman');
        return view('alat.show', compact('alat'));
    }

    public function edit(Alat $alat)
    {
        $kategoris = KategoriAlat::orderBy('nama_kategori')->get();
        return view('alat.edit', compact('alat', 'kategoris'));
    }

    public function update(Request $request, Alat $alat)
    {
        $request->validate([
            'kategori_id' => 'required|exists:kategori_alat,id',
            'nama_alat'   => 'required|string|max:150',
            'kode_alat'   => 'required|string|max:50|unique:alat,kode_alat,' . $alat->id,
            'stok_total'  => 'required|integer|min:1',
            'kondisi'     => 'required|in:baik,rusak ringan,rusak berat',
            'deskripsi'   => 'nullable|string',
            'foto'        => 'nullable|image|max:2048',
        ]);

        $data = $request->only('kategori_id', 'nama_alat', 'kode_alat', 'stok_total', 'kondisi', 'deskripsi');

        if ($request->hasFile('foto')) {
            if ($alat->foto) {
                \Storage::disk('public')->delete($alat->foto);
            }
            $data['foto'] = $request->file('foto')->store('alat', 'public');
        }

        $alat->update($data);
        LogAktivitas::catat('update', 'alat', $alat->id, "Update alat: {$alat->nama_alat}");

        return redirect()->route('alat.index')->with('success', 'Alat berhasil diperbarui.');
    }

    public function destroy(Alat $alat)
    {
        $aktif = $alat->detailPeminjaman()->whereHas('peminjaman', fn($q) => $q->where('status', 'dipinjam'))->count();
        if ($aktif > 0) {
            return back()->with('error', 'Alat tidak bisa dihapus karena sedang dipinjam.');
        }

        if ($alat->foto) {
            \Storage::disk('public')->delete($alat->foto);
        }

        LogAktivitas::catat('delete', 'alat', $alat->id, "Hapus alat: {$alat->nama_alat}");
        $alat->delete();

        return redirect()->route('alat.index')->with('success', 'Alat berhasil dihapus.');
    }
}
