@extends('layouts.app')
@section('title', 'Data Kendaraan')
@section('page-title', 'Data Kendaraan')
@section('page-subtitle', 'Kelola data kendaraan terdaftar')

@section('content')
<div style="display:flex; flex-direction:column; gap:16px;">
    {{-- Search & Filter --}}
    <div class="card" style="padding:16px 20px;">
        <form method="GET" action="{{ route('admin.kendaraan.index') }}" style="display:flex; gap:10px; align-items:center; flex-wrap:wrap;">
            <div style="position:relative; flex:1; min-width:200px;">
                <i class="fa-solid fa-search" style="position:absolute; left:12px; top:50%; transform:translateY(-50%); color:#94a3b8; font-size:13px;"></i>
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Cari plat nomor atau pemilik..."
                       style="width:100%; padding:9px 12px 9px 36px; border:1.5px solid #e2e8f0; border-radius:10px; font-size:13.5px; outline:none; transition:all 0.15s; background:#f8fafc; text-transform:uppercase;"
                       onfocus="this.style.borderColor='#2563eb';this.style.background='#fff'"
                       onblur="this.style.borderColor='#e2e8f0';this.style.background='#f8fafc'">
            </div>
            <select name="jenis" onchange="this.form.submit()"
                    style="padding:9px 14px; border:1.5px solid #e2e8f0; border-radius:10px; font-size:13.5px; color:#374151; background:#f8fafc; outline:none; cursor:pointer;">
                <option value="">Semua Jenis</option>
                <option value="motor"   {{ request('jenis') === 'motor'   ? 'selected' : '' }}>Motor</option>
                <option value="mobil"   {{ request('jenis') === 'mobil'   ? 'selected' : '' }}>Mobil</option>
                <option value="lainnya" {{ request('jenis') === 'lainnya' ? 'selected' : '' }}>Lainnya</option>
            </select>
            <button type="submit" class="btn-primary" style="padding:9px 18px;">
                <i class="fa-solid fa-search"></i> Cari
            </button>
            @if(request('search') || request('jenis'))
            <a href="{{ route('admin.kendaraan.index') }}" style="padding:9px 14px; border:1.5px solid #e2e8f0; border-radius:10px; font-size:13px; color:#64748b; text-decoration:none; background:#f8fafc;">
                <i class="fa-solid fa-xmark"></i> Reset
            </a>
            @endif
        </form>
    </div>

    <div style="display:flex; justify-content:flex-end;">
        <a href="{{ route('admin.kendaraan.create') }}" class="btn-primary">
            <i class="fa-solid fa-plus"></i> Tambah Kendaraan
        </a>
    </div>

    <div class="card" style="overflow:hidden;">
        <table style="width:100%; border-collapse:collapse;">
            <thead>
                <tr style="background:#f8fafc;">
                    <th style="padding:12px 20px; text-align:left; font-size:11px; font-weight:700; color:#64748b; text-transform:uppercase; letter-spacing:0.05em;">Plat Nomor</th>
                    <th style="padding:12px 20px; text-align:left; font-size:11px; font-weight:700; color:#64748b; text-transform:uppercase; letter-spacing:0.05em;">Jenis</th>
                    <th style="padding:12px 20px; text-align:left; font-size:11px; font-weight:700; color:#64748b; text-transform:uppercase; letter-spacing:0.05em;">Warna</th>
                    <th style="padding:12px 20px; text-align:left; font-size:11px; font-weight:700; color:#64748b; text-transform:uppercase; letter-spacing:0.05em;">Pemilik</th>
                    <th style="padding:12px 20px; text-align:left; font-size:11px; font-weight:700; color:#64748b; text-transform:uppercase; letter-spacing:0.05em;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kendaraans as $k)
                <tr class="table-row" style="border-top:1px solid #f1f5f9;">
                    <td style="padding:14px 20px;">
                        <div style="display:flex; align-items:center; gap:10px;">
                            <div style="width:36px; height:36px; border-radius:10px; display:flex; align-items:center; justify-content:center; flex-shrink:0;
                                background: {{ $k->jenis_kendaraan === 'motor' ? 'linear-gradient(135deg,#2563eb,#1d4ed8)' : ($k->jenis_kendaraan === 'mobil' ? 'linear-gradient(135deg,#059669,#047857)' : 'linear-gradient(135deg,#d97706,#b45309)') }};">
                                <i class="fa-solid {{ $k->jenis_kendaraan === 'motor' ? 'fa-motorcycle' : ($k->jenis_kendaraan === 'mobil' ? 'fa-car' : 'fa-truck') }}" style="color:#fff; font-size:14px;"></i>
                            </div>
                            <span style="font-size:14px; font-weight:700; color:#0f172a; letter-spacing:0.03em;">{{ $k->plat_nomor }}</span>
                        </div>
                    </td>
                    <td style="padding:14px 20px;">
                        <span style="font-size:12.5px; text-transform:capitalize; color:#475569; background:#f8fafc; padding:3px 10px; border-radius:99px; font-weight:500;">{{ $k->jenis_kendaraan }}</span>
                    </td>
                    <td style="padding:14px 20px; font-size:13px; color:#475569;">{{ $k->warna ?? '—' }}</td>
                    <td style="padding:14px 20px; font-size:13px; color:#475569;">{{ $k->pemilik ?? '—' }}</td>
                    <td style="padding:14px 20px;">
                        <div style="display:flex; align-items:center; gap:8px;">
                            <a href="{{ route('admin.kendaraan.edit', $k->id_kendaraan) }}"
                               style="font-size:12.5px; font-weight:600; color:#2563eb; text-decoration:none; padding:5px 12px; border-radius:7px; background:#eff6ff; transition:background 0.15s;"
                               onmouseover="this.style.background='#dbeafe'" onmouseout="this.style.background='#eff6ff'">
                                <i class="fa-solid fa-pen-to-square" style="margin-right:4px;"></i>Edit
                            </a>
                            <form method="POST" action="{{ route('admin.kendaraan.destroy', $k->id_kendaraan) }}" onsubmit="return confirm('Hapus kendaraan ini?')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                    style="font-size:12.5px; font-weight:600; color:#dc2626; background:#fef2f2; border:none; cursor:pointer; padding:5px 12px; border-radius:7px; transition:background 0.15s;"
                                    onmouseover="this.style.background='#fee2e2'" onmouseout="this.style.background='#fef2f2'">
                                    <i class="fa-solid fa-trash" style="margin-right:4px;"></i>Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" style="padding:50px; text-align:center; color:#94a3b8; font-size:13px;">Belum ada data kendaraan</td></tr>
                @endforelse
            </tbody>
        </table>
        @if($kendaraans->hasPages())
        <div style="padding:14px 20px; border-top:1px solid #f1f5f9;">{{ $kendaraans->links() }}</div>
        @endif
    </div>
</div>
@endsection
