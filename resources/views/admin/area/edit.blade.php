@extends('layouts.app')
@section('title', 'Edit Area Parkir')
@section('page-title', 'Edit Area Parkir')
@section('page-subtitle', 'Perbarui data ' . $area->nama_area)

@section('content')
<div style="max-width:520px; margin:0 auto;">
    <div class="card" style="padding:28px 32px;">
        <form method="POST" action="{{ route('admin.area.update', $area->id_area) }}">
            @csrf @method('PUT')
            <div style="margin-bottom:20px;">
                <label style="display:block; font-size:12px; font-weight:700; color:#374151; margin-bottom:6px; text-transform:uppercase; letter-spacing:0.05em;">Nama Area</label>
                <input type="text" name="nama_area" value="{{ old('nama_area',$area->nama_area) }}" class="input-field" required>
            </div>
            <div style="margin-bottom:24px;">
                <label style="display:block; font-size:12px; font-weight:700; color:#374151; margin-bottom:6px; text-transform:uppercase; letter-spacing:0.05em;">Kapasitas (slot)</label>
                <input type="number" name="kapasitas" value="{{ old('kapasitas',$area->kapasitas) }}" min="1" class="input-field" required>
            </div>
            <div style="display:flex; gap:10px;">
                <button type="submit" class="btn-primary"><i class="fa-solid fa-check"></i> Update</button>
                <a href="{{ route('admin.area.index') }}" class="btn-ghost">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
