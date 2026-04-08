@extends('layouts.app')
@section('title', 'Edit Kendaraan')
@section('page-title', 'Edit Kendaraan')

@section('content')
<div class="max-w-lg">
    <x-form-card>
        <form method="POST" action="{{ route('admin.kendaraan.update', $kendaraan->id_kendaraan) }}" class="space-y-4">
            @csrf @method('PUT')
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Plat Nomor</label>
                <input type="text" name="plat_nomor" value="{{ old('plat_nomor', $kendaraan->plat_nomor) }}"
                       class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 uppercase" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Jenis Kendaraan</label>
                <select name="jenis_kendaraan" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="motor"   {{ old('jenis_kendaraan', $kendaraan->jenis_kendaraan) === 'motor'   ? 'selected' : '' }}>Motor</option>
                    <option value="mobil"   {{ old('jenis_kendaraan', $kendaraan->jenis_kendaraan) === 'mobil'   ? 'selected' : '' }}>Mobil</option>
                    <option value="lainnya" {{ old('jenis_kendaraan', $kendaraan->jenis_kendaraan) === 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Warna</label>
                <input type="text" name="warna" value="{{ old('warna', $kendaraan->warna) }}"
                       class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Pemilik</label>
                <input type="text" name="pemilik" value="{{ old('pemilik', $kendaraan->pemilik) }}"
                       class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="flex gap-3 pt-2">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-5 py-2 rounded-lg transition-colors">Update</button>
                <a href="{{ route('admin.kendaraan.index') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-medium px-5 py-2 rounded-lg transition-colors">Batal</a>
            </div>
        </form>
    </x-form-card>
</div>
@endsection
