<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriAlat;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = KategoriAlat::withCount('alat')->latest()->paginate(10);
        return view('admin.kategori.index', compact('kategoris'));
    }

    public function create()
    {
        return view('admin.kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:100|unique:kategori_alat',
            'deskripsi'     => 'nullable|string',
        ]);

        $kategori = KategoriAlat::create($request->only('nama_kategori', 'deskripsi'));
        LogAktivitas::catat('create', 'kategori_alat', $kategori->id, "Tambah kategori: {$kategori->nama_kategori}");

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(KategoriAlat $kategori)
    {
        return view('admin.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, KategoriAlat $kategori)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:100|unique:kategori_alat,nama_kategori,' . $kategori->id,
            'deskripsi'     => 'nullable|string',
        ]);

        $kategori->update($request->only('nama_kategori', 'deskripsi'));
        LogAktivitas::catat('update', 'kategori_alat', $kategori->id, "Update kategori: {$kategori->nama_kategori}");

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(KategoriAlat $kategori)
    {
        if ($kategori->alat()->count() > 0) {
            return back()->with('error', 'Kategori tidak bisa dihapus karena masih memiliki alat terkait.');
        }

        LogAktivitas::catat('delete', 'kategori_alat', $kategori->id, "Hapus kategori: {$kategori->nama_kategori}");
        $kategori->delete();

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
