@extends('layouts.app')
@section('title', 'Tambah Area Parkir')
@section('page-title', 'Tambah Area Parkir')
@section('page-subtitle', 'Tambah zona parkir baru')

@section('content')
<div style="max-width:520px; margin:0 auto;">
    <div class="card" style="padding:28px 32px;">
        <form method="POST" action="{{ route('admin.area.store') }}">
            @csrf
            <div style="margin-bottom:20px;">
                <label style="display:block; font-size:12px; font-weight:700; color:#374151; margin-bottom:6px; text-transform:uppercase; letter-spacing:0.05em;">Nama Area</label>
                <input type="text" name="nama_area" value="{{ old('nama_area') }}" class="input-field" placeholder="Contoh: Zone A, Lantai 1..." required>
                @error('nama_area')<p style="font-size:12px; color:#dc2626; margin-top:4px;">{{ $message }}</p>@enderror
            </div>
            <div style="margin-bottom:24px;">
                <label style="display:block; font-size:12px; font-weight:700; color:#374151; margin-bottom:6px; text-transform:uppercase; letter-spacing:0.05em;">Kapasitas (slot)</label>
                <input type="number" name="kapasitas" value="{{ old('kapasitas') }}" min="1" class="input-field" placeholder="Jumlah slot parkir" required>
                @error('kapasitas')<p style="font-size:12px; color:#dc2626; margin-top:4px;">{{ $message }}</p>@enderror
            </div>
            <div style="display:flex; gap:10px;">
                <button type="submit" class="btn-primary"><i class="fa-solid fa-check"></i> Simpan</button>
                <a href="{{ route('admin.area.index') }}" class="btn-ghost">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
