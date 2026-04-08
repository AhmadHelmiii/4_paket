@extends('layouts.app')
@section('title', 'Area Parkir')
@section('page-title', 'Area Parkir')
@section('page-subtitle', 'Kelola zona dan kapasitas parkir')

@section('content')
<div style="display:flex; flex-direction:column; gap:16px;">
    <div style="display:flex; justify-content:flex-end;">
        <a href="{{ route('admin.area.create') }}" class="btn-primary">
            <i class="fa-solid fa-plus"></i> Tambah Area
        </a>
    </div>

    <div class="card" style="overflow:hidden;">
        <table style="width:100%; border-collapse:collapse;">
            <thead>
                <tr style="background:#f8fafc;">
                    <th style="padding:12px 20px; text-align:left; font-size:11px; font-weight:700; color:#64748b; text-transform:uppercase; letter-spacing:0.05em;">Nama Area</th>
                    <th style="padding:12px 20px; text-align:left; font-size:11px; font-weight:700; color:#64748b; text-transform:uppercase; letter-spacing:0.05em;">Kapasitas</th>
                    <th style="padding:12px 20px; text-align:left; font-size:11px; font-weight:700; color:#64748b; text-transform:uppercase; letter-spacing:0.05em;">Terisi</th>
                    <th style="padding:12px 20px; text-align:left; font-size:11px; font-weight:700; color:#64748b; text-transform:uppercase; letter-spacing:0.05em; width:200px;">Occupancy</th>
                    <th style="padding:12px 20px; text-align:left; font-size:11px; font-weight:700; color:#64748b; text-transform:uppercase; letter-spacing:0.05em;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($areas as $area)
                <tr class="table-row" style="border-top:1px solid #f1f5f9;">
                    <td style="padding:14px 20px;">
                        <div style="display:flex; align-items:center; gap:10px;">
                            <div style="width:36px; height:36px; border-radius:10px; background:linear-gradient(135deg,#6366f1,#8b5cf6); display:flex; align-items:center; justify-content:center;">
                                <i class="fa-solid fa-map-pin" style="color:#fff; font-size:14px;"></i>
                            </div>
                            <span style="font-size:13.5px; font-weight:600; color:#0f172a;">{{ $area->nama_area }}</span>
                        </div>
                    </td>
                    <td style="padding:14px 20px; font-size:13.5px; font-weight:600; color:#475569;">{{ $area->kapasitas }} slot</td>
                    <td style="padding:14px 20px;">
                        <span style="font-size:13.5px; font-weight:700; color:{{ $area->persentaseTerisi() >= 90 ? '#dc2626' : '#0f172a' }};">{{ $area->terisi }}</span>
                        <span style="font-size:12px; color:#94a3b8;"> / {{ $area->kapasitas }}</span>
                    </td>
                    <td style="padding:14px 20px;">
                        <div style="display:flex; align-items:center; gap:8px;">
                            <div style="flex:1; background:#f1f5f9; border-radius:99px; height:6px; overflow:hidden;">
                                <div style="height:6px; border-radius:99px;
                                    background: {{ $area->persentaseTerisi() >= 90 ? 'linear-gradient(90deg,#ef4444,#dc2626)' : ($area->persentaseTerisi() >= 70 ? 'linear-gradient(90deg,#f59e0b,#d97706)' : 'linear-gradient(90deg,#2563eb,#1d4ed8)') }};
                                    width: {{ $area->persentaseTerisi() }}%;"></div>
                            </div>
                            <span style="font-size:12px; font-weight:600; color:#64748b; min-width:35px;">{{ $area->persentaseTerisi() }}%</span>
                        </div>
                    </td>
                    <td style="padding:14px 20px;">
                        <div style="display:flex; gap:8px;">
                            <a href="{{ route('admin.area.edit', $area->id_area) }}"
                               style="font-size:12.5px; font-weight:600; color:#2563eb; text-decoration:none; padding:5px 12px; border-radius:7px; background:#eff6ff;"
                               onmouseover="this.style.background='#dbeafe'" onmouseout="this.style.background='#eff6ff'">
                                <i class="fa-solid fa-pen-to-square" style="margin-right:4px;"></i>Edit
                            </a>
                            <form method="POST" action="{{ route('admin.area.destroy', $area->id_area) }}" onsubmit="return confirm('Hapus area ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" style="font-size:12.5px; font-weight:600; color:#dc2626; background:#fef2f2; border:none; cursor:pointer; padding:5px 12px; border-radius:7px;"
                                    onmouseover="this.style.background='#fee2e2'" onmouseout="this.style.background='#fef2f2'">
                                    <i class="fa-solid fa-trash" style="margin-right:4px;"></i>Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" style="padding:50px; text-align:center; color:#94a3b8; font-size:13px;">Belum ada area parkir</td></tr>
                @endforelse
            </tbody>
        </table>
        @if($areas->hasPages())
        <div style="padding:14px 20px; border-top:1px solid #f1f5f9;">{{ $areas->links() }}</div>
        @endif
    </div>
</div>
@endsection
