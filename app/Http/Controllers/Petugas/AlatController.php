<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\KategoriAlat;
use App\Traits\LogsActivity;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class AlatController extends Controller
{
    use LogsActivity;

    public function index(Request $request)
    {
        $query = Alat::with('kategori');

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama_alat', 'like', "%{$request->search}%")
                  ->orWhere('kode_alat', 'like', "%{$request->search}%");
            });
        }
        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        $alat      = $query->latest()->paginate(10)->withQueryString();
        $kategoris = KategoriAlat::orderBy('nama_kategori')->get();

        return view('petugas.alat.index', compact('alat', 'kategoris'));
    }

    public function create()
    {
        $kategoris = KategoriAlat::orderBy('nama_kategori')->get();
        return view('petugas.alat.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'kategori_id' => 'required|exists:kategori_alat,id',
            'nama_alat'   => 'required|string|max:150',
            'kode_alat'   => 'required|string|max:50|unique:alat,kode_alat',
            'stok_total'  => 'required|integer|min:1',
            'kondisi'     => 'required|in:baik,rusak ringan,rusak berat',
            'deskripsi'   => 'nullable|string',
            'foto'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data['stok_tersedia'] = $data['stok_total'];

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('alat', 'public');
        }

        $alat = Alat::create($data);
        $this->logAktivitas('create', 'alat', $alat->id, "Tambah alat: {$alat->nama_alat}");

        return redirect()->route('petugas.alat.index')->with('success', 'Alat berhasil ditambahkan.');
    }

    public function show(Alat $alat)
    {
        $alat->load('kategori', 'detailPeminjaman.peminjaman.peminjam');
        return view('petugas.alat.show', compact('alat'));
    }

    public function edit(Alat $alat)
    {
        $kategoris = KategoriAlat::orderBy('nama_kategori')->get();
        return view('petugas.alat.edit', compact('alat', 'kategoris'));
    }

    public function update(Request $request, Alat $alat)
    {
        $data = $request->validate([
            'kategori_id' => 'required|exists:kategori_alat,id',
            'nama_alat'   => 'required|string|max:150',
            'kode_alat'   => ['required', 'string', 'max:50', Rule::unique('alat')->ignore($alat->id)],
            'stok_total'  => 'required|integer|min:1',
            'kondisi'     => 'required|in:baik,rusak ringan,rusak berat',
            'deskripsi'   => 'nullable|string',
            'foto'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($alat->foto) Storage::disk('public')->delete($alat->foto);
            $data['foto'] = $request->file('foto')->store('alat', 'public');
        }

        $alat->update($data);
        $this->logAktivitas('update', 'alat', $alat->id, "Update alat: {$alat->nama_alat}");

        return redirect()->route('petugas.alat.index')->with('success', 'Alat berhasil diperbarui.');
    }

    public function destroy(Alat $alat)
    {
        $aktif = $alat->detailPeminjaman()->whereHas('peminjaman', fn($q) => $q->where('status', 'dipinjam'))->count();
        if ($aktif > 0) {
            return back()->with('error', 'Alat tidak bisa dihapus karena sedang dipinjam.');
        }

        if ($alat->foto) Storage::disk('public')->delete($alat->foto);
        $this->logAktivitas('delete', 'alat', $alat->id, "Hapus alat: {$alat->nama_alat}");
        $alat->delete();

        return redirect()->route('petugas.alat.index')->with('success', 'Alat berhasil dihapus.');
    }
}
