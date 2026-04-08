@extends('layouts.app')
@section('title', 'Tarif Parkir')
@section('page-title', 'Tarif Parkir')
@section('page-subtitle', 'Atur tarif per jam untuk setiap jenis kendaraan')

@section('content')
<div style="display:flex; flex-direction:column; gap:16px;">
    <div style="display:flex; justify-content:flex-end;">
        <a href="{{ route('admin.tarif.create') }}" class="btn-primary">
            <i class="fa-solid fa-plus"></i> Tambah Tarif
        </a>
    </div>

    <div style="display:grid; grid-template-columns:repeat(auto-fill, minmax(260px,1fr)); gap:14px;">
        @forelse($tarifs as $tarif)
        <div class="card" style="padding:20px; position:relative; overflow:hidden;">
            <div style="position:absolute; top:-15px; right:-15px; width:80px; height:80px; border-radius:50%; opacity:0.08;
                background: {{ $tarif->jenis_kendaraan === 'motor' ? '#2563eb' : ($tarif->jenis_kendaraan === 'mobil' ? '#059669' : '#d97706') }};"></div>
            <div style="display:flex; align-items:center; gap:12px; margin-bottom:16px;">
                <div style="width:44px; height:44px; border-radius:12px; display:flex; align-items:center; justify-content:center;
                    background: {{ $tarif->jenis_kendaraan === 'motor' ? 'linear-gradient(135deg,#2563eb,#1d4ed8)' : ($tarif->jenis_kendaraan === 'mobil' ? 'linear-gradient(135deg,#059669,#047857)' : 'linear-gradient(135deg,#d97706,#b45309)') }};
                    box-shadow: 0 4px 12px {{ $tarif->jenis_kendaraan === 'motor' ? 'rgba(37,99,235,0.3)' : ($tarif->jenis_kendaraan === 'mobil' ? 'rgba(5,150,105,0.3)' : 'rgba(217,119,6,0.3)') }};">
                    <i class="fa-solid {{ $tarif->jenis_kendaraan === 'motor' ? 'fa-motorcycle' : ($tarif->jenis_kendaraan === 'mobil' ? 'fa-car' : 'fa-truck') }}" style="color:#fff; font-size:18px;"></i>
                </div>
                <div>
                    <p style="font-size:15px; font-weight:700; color:#0f172a; text-transform:capitalize;">{{ $tarif->jenis_kendaraan }}</p>
                    <p style="font-size:11.5px; color:#94a3b8;">Per jam</p>
                </div>
            </div>
            <p style="font-size:24px; font-weight:800; color:#0f172a; margin-bottom:16px;">Rp {{ number_format($tarif->tarif_per_jam,0,',','.') }}</p>
            <div style="display:flex; gap:8px;">
                <a href="{{ route('admin.tarif.edit', $tarif->id_tarif) }}"
                   style="flex:1; text-align:center; font-size:12.5px; font-weight:600; color:#2563eb; text-decoration:none; padding:7px; border-radius:8px; background:#eff6ff; transition:background 0.15s;"
                   onmouseover="this.style.background='#dbeafe'" onmouseout="this.style.background='#eff6ff'">
                    <i class="fa-solid fa-pen-to-square" style="margin-right:4px;"></i>Edit
                </a>
                <form method="POST" action="{{ route('admin.tarif.destroy', $tarif->id_tarif) }}" onsubmit="return confirm('Hapus tarif ini?')" style="flex:1;">
                    @csrf @method('DELETE')
                    <button type="submit" style="width:100%; font-size:12.5px; font-weight:600; color:#dc2626; background:#fef2f2; border:none; cursor:pointer; padding:7px; border-radius:8px; transition:background 0.15s;"
                        onmouseover="this.style.background='#fee2e2'" onmouseout="this.style.background='#fef2f2'">
                        <i class="fa-solid fa-trash" style="margin-right:4px;"></i>Hapus
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="card" style="padding:50px; text-align:center; color:#94a3b8; grid-column:1/-1;">
            <i class="fa-solid fa-tags" style="font-size:32px; margin-bottom:10px; display:block; opacity:0.3;"></i>
            Belum ada tarif parkir
        </div>
        @endforelse
    </div>
</div>
@endsection
