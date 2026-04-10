@extends('layouts.app')
@section('title', 'Transaksi Parkir')
@section('page-title', 'Transaksi Parkir')
@section('page-subtitle', 'Kelola kendaraan masuk dan keluar')

@section('content')
<div style="display:flex; flex-direction:column; gap:16px;">

    <div style="display:flex; gap:10px;">
        <a href="{{ route('petugas.transaksi.create') }}" class="btn-primary">
            <i class="fa-solid fa-arrow-right-to-bracket"></i> Kendaraan Masuk
        </a>
        <a href="{{ route('petugas.transaksi.checkout') }}" class="btn-success">
            <i class="fa-solid fa-arrow-right-from-bracket"></i> Kendaraan Keluar
        </a>
    </div>

    {{-- Search & Filter --}}
    <div class="card" style="padding:16px 20px;">
        <form method="GET" action="{{ route('petugas.transaksi.index') }}" style="display:flex; gap:10px; align-items:center; flex-wrap:wrap;">
            <div style="position:relative; flex:1; min-width:180px;">
                <i class="fa-solid fa-search" style="position:absolute; left:12px; top:50%; transform:translateY(-50%); color:#94a3b8; font-size:13px;"></i>
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Cari plat nomor..."
                       style="width:100%; padding:9px 12px 9px 36px; border:1.5px solid #e2e8f0; border-radius:10px; font-size:13.5px; outline:none; transition:all 0.15s; background:#f8fafc; text-transform:uppercase;"
                       onfocus="this.style.borderColor='#2563eb';this.style.background='#fff'"
                       onblur="this.style.borderColor='#e2e8f0';this.style.background='#f8fafc'">
            </div>
            <div style="display:flex; align-items:center; gap:6px;">
                <input type="date" name="dari" value="{{ request('dari') }}"
                       style="padding:9px 12px; border:1.5px solid #e2e8f0; border-radius:10px; font-size:13px; color:#374151; background:#f8fafc; outline:none; cursor:pointer;"
                       onfocus="this.style.borderColor='#2563eb'" onblur="this.style.borderColor='#e2e8f0'">
                <span style="font-size:12px; color:#94a3b8;">s/d</span>
                <input type="date" name="sampai" value="{{ request('sampai') }}"
                       style="padding:9px 12px; border:1.5px solid #e2e8f0; border-radius:10px; font-size:13px; color:#374151; background:#f8fafc; outline:none; cursor:pointer;"
                       onfocus="this.style.borderColor='#2563eb'" onblur="this.style.borderColor='#e2e8f0'">
            </div>
            <select name="status" onchange="this.form.submit()"
                    style="padding:9px 14px; border:1.5px solid #e2e8f0; border-radius:10px; font-size:13.5px; color:#374151; background:#f8fafc; outline:none; cursor:pointer;">
                <option value="">Semua Status</option>
                <option value="masuk"  {{ request('status') === 'masuk'  ? 'selected' : '' }}>Sedang Parkir</option>
                <option value="keluar" {{ request('status') === 'keluar' ? 'selected' : '' }}>Sudah Keluar</option>
            </select>
            <button type="submit" class="btn-primary" style="padding:9px 18px;">
                <i class="fa-solid fa-search"></i> Cari
            </button>
            @if(request('search') || request('status') || request('dari') || request('sampai'))
            <a href="{{ route('petugas.transaksi.index') }}" style="padding:9px 14px; border:1.5px solid #e2e8f0; border-radius:10px; font-size:13px; color:#64748b; text-decoration:none; background:#f8fafc;">
                <i class="fa-solid fa-xmark"></i> Reset
            </a>
            @endif
        </form>
    </div>

    <div class="card" style="overflow:hidden;">
        <div style="padding:16px 20px; border-bottom:1px solid #f1f5f9;">
            <p style="font-size:14px; font-weight:700; color:#0f172a;">Riwayat Transaksi</p>
        </div>
        <div style="overflow-x:auto;">
            <table style="width:100%; border-collapse:collapse; min-width:700px;">
                <thead>
                    <tr style="background:#f8fafc;">
                        <th style="padding:11px 20px; text-align:left; font-size:11px; font-weight:700; color:#64748b; text-transform:uppercase; letter-spacing:0.05em;">Plat Nomor</th>
                        <th style="padding:11px 20px; text-align:left; font-size:11px; font-weight:700; color:#64748b; text-transform:uppercase; letter-spacing:0.05em;">Jenis</th>
                        <th style="padding:11px 20px; text-align:left; font-size:11px; font-weight:700; color:#64748b; text-transform:uppercase; letter-spacing:0.05em;">Area</th>
                        <th style="padding:11px 20px; text-align:left; font-size:11px; font-weight:700; color:#64748b; text-transform:uppercase; letter-spacing:0.05em;">Masuk</th>
                        <th style="padding:11px 20px; text-align:left; font-size:11px; font-weight:700; color:#64748b; text-transform:uppercase; letter-spacing:0.05em;">Keluar</th>
                        <th style="padding:11px 20px; text-align:left; font-size:11px; font-weight:700; color:#64748b; text-transform:uppercase; letter-spacing:0.05em;">Biaya</th>
                        <th style="padding:11px 20px; text-align:left; font-size:11px; font-weight:700; color:#64748b; text-transform:uppercase; letter-spacing:0.05em;">Status</th>
                        <th style="padding:11px 20px; text-align:left; font-size:11px; font-weight:700; color:#64748b; text-transform:uppercase; letter-spacing:0.05em;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transaksis as $t)
                    <tr class="table-row" style="border-top:1px solid #f1f5f9;">
                        <td style="padding:13px 20px; font-size:13.5px; font-weight:700; color:#0f172a;">{{ $t->kendaraan->plat_nomor }}</td>
                        <td style="padding:13px 20px;">
                            <span style="font-size:12.5px; text-transform:capitalize; color:#475569; background:#f8fafc; padding:3px 10px; border-radius:99px; font-weight:500;">{{ $t->kendaraan->jenis_kendaraan }}</span>
                        </td>
                        <td style="padding:13px 20px; font-size:13px; color:#475569;">{{ $t->area->nama_area }}</td>
                        <td style="padding:13px 20px; font-size:12.5px; color:#475569; white-space:nowrap;">{{ $t->waktu_masuk->format('d/m/Y H:i') }}</td>
                        <td style="padding:13px 20px; font-size:12.5px; color:#475569; white-space:nowrap;">{{ $t->waktu_keluar ? $t->waktu_keluar->format('d/m/Y H:i') : '—' }}</td>
                        <td style="padding:13px 20px; font-size:13px; font-weight:700; color:{{ $t->biaya_total ? '#2563eb' : '#94a3b8' }};">
                            {{ $t->biaya_total ? 'Rp '.number_format($t->biaya_total,0,',','.') : '—' }}
                        </td>
                        <td style="padding:13px 20px;">
                            @if($t->status === 'masuk')
                            <span class="badge" style="background:#dcfce7; color:#166534;"><span style="width:6px;height:6px;border-radius:50%;background:#22c55e;display:inline-block;margin-right:5px;"></span>Parkir</span>
                            @else
                            <span class="badge" style="background:#f1f5f9; color:#475569;"><span style="width:6px;height:6px;border-radius:50%;background:#94a3b8;display:inline-block;margin-right:5px;"></span>Selesai</span>
                            @endif
                        </td>
                        <td style="padding:13px 20px;">
                            @if($t->status === 'keluar')
                            <a href="{{ route('petugas.transaksi.struk', $t->id_parkir) }}"
                               style="font-size:12px; font-weight:600; color:#2563eb; text-decoration:none; padding:4px 10px; border-radius:6px; background:#eff6ff;">
                                <i class="fa-solid fa-receipt" style="margin-right:3px;"></i>Struk
                            </a>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="8" style="padding:50px; text-align:center; color:#94a3b8; font-size:13px;">Belum ada transaksi</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($transaksis->hasPages())
        <div style="padding:14px 20px; border-top:1px solid #f1f5f9;">{{ $transaksis->links() }}</div>
        @endif
    </div>
</div>
@endsection
