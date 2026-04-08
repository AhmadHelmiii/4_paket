@extends('layouts.app')
@section('title', 'Laporan & Rekap')
@section('page-title', 'Laporan & Rekap')
@section('page-subtitle', 'Pantau pendapatan dan performa operasional')

@section('content')
<div style="display:flex; flex-direction:column; gap:16px;">

    {{-- Filter --}}
    <div class="card" style="padding:18px 20px;">
        <form method="GET" action="{{ route('owner.laporan.index') }}" style="display:flex; flex-wrap:wrap; gap:12px; align-items:flex-end;">
            <div>
                <label style="display:block; font-size:11px; font-weight:700; color:#64748b; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:5px;">Dari Tanggal</label>
                <input type="date" name="dari" value="{{ $dari }}" class="input-field" style="width:auto;">
            </div>
            <div>
                <label style="display:block; font-size:11px; font-weight:700; color:#64748b; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:5px;">Sampai Tanggal</label>
                <input type="date" name="sampai" value="{{ $sampai }}" class="input-field" style="width:auto;">
            </div>
            <div>
                <label style="display:block; font-size:11px; font-weight:700; color:#64748b; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:5px;">Jenis Kendaraan</label>
                <select name="jenis_kendaraan" class="input-field" style="width:auto;">
                    <option value="semua" {{ $jenis === 'semua' ? 'selected' : '' }}>Semua Jenis</option>
                    <option value="motor" {{ $jenis === 'motor' ? 'selected' : '' }}>Motor</option>
                    <option value="mobil" {{ $jenis === 'mobil' ? 'selected' : '' }}>Mobil</option>
                    <option value="lainnya" {{ $jenis === 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
            </div>
            <button type="submit" class="btn-primary">
                <i class="fa-solid fa-filter"></i> Terapkan Filter
            </button>
        </form>
    </div>

    {{-- Summary --}}
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:14px;">
        <div class="stat-card">
            <div style="display:flex; align-items:center; gap:12px; margin-bottom:12px;">
                <div style="width:40px; height:40px; background:linear-gradient(135deg,#2563eb,#1d4ed8); border-radius:11px; display:flex; align-items:center; justify-content:center;">
                    <i class="fa-solid fa-money-bill-trend-up" style="color:#fff; font-size:16px;"></i>
                </div>
                <p style="font-size:13px; font-weight:600; color:#475569;">Total Pendapatan</p>
            </div>
            <p style="font-size:26px; font-weight:800; color:#0f172a;">Rp {{ number_format($totalPendapatan,0,',','.') }}</p>
        </div>
        <div class="stat-card">
            <div style="display:flex; align-items:center; gap:12px; margin-bottom:12px;">
                <div style="width:40px; height:40px; background:linear-gradient(135deg,#059669,#047857); border-radius:11px; display:flex; align-items:center; justify-content:center;">
                    <i class="fa-solid fa-car" style="color:#fff; font-size:16px;"></i>
                </div>
                <p style="font-size:13px; font-weight:600; color:#475569;">Total Kendaraan</p>
            </div>
            <p style="font-size:26px; font-weight:800; color:#0f172a;">{{ number_format($totalKendaraan) }}</p>
        </div>
    </div>

    {{-- Rekap Harian --}}
    <div class="card" style="overflow:hidden;">
        <div style="padding:16px 20px; border-bottom:1px solid #f1f5f9;">
            <p style="font-size:14px; font-weight:700; color:#0f172a;">Rekapitulasi Harian</p>
        </div>
        <table style="width:100%; border-collapse:collapse;">
            <thead>
                <tr style="background:#f8fafc;">
                    <th style="padding:11px 20px; text-align:left; font-size:11px; font-weight:700; color:#64748b; text-transform:uppercase; letter-spacing:0.05em;">Tanggal</th>
                    <th style="padding:11px 20px; text-align:left; font-size:11px; font-weight:700; color:#64748b; text-transform:uppercase; letter-spacing:0.05em;">Total Kendaraan</th>
                    <th style="padding:11px 20px; text-align:left; font-size:11px; font-weight:700; color:#64748b; text-transform:uppercase; letter-spacing:0.05em;">Pendapatan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($rekap as $r)
                <tr class="table-row" style="border-top:1px solid #f1f5f9;">
                    <td style="padding:13px 20px; font-size:13.5px; font-weight:600; color:#0f172a;">
                        {{ \Carbon\Carbon::parse($r->tanggal)->isoFormat('dddd, D MMMM Y') }}
                    </td>
                    <td style="padding:13px 20px;">
                        <span style="font-size:13px; font-weight:600; color:#475569; background:#f1f5f9; padding:3px 10px; border-radius:99px;">{{ $r->total }} kendaraan</span>
                    </td>
                    <td style="padding:13px 20px; font-size:14px; font-weight:800; color:#2563eb;">
                        Rp {{ number_format($r->pendapatan,0,',','.') }}
                    </td>
                </tr>
                @empty
                <tr><td colspan="3" style="padding:50px; text-align:center; color:#94a3b8; font-size:13px;">Tidak ada data pada periode ini</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Detail --}}
    <div class="card" style="overflow:hidden;">
        <div style="padding:16px 20px; border-bottom:1px solid #f1f5f9;">
            <p style="font-size:14px; font-weight:700; color:#0f172a;">Detail Transaksi</p>
        </div>
        <div style="overflow-x:auto;">
            <table style="width:100%; border-collapse:collapse; min-width:650px;">
                <thead>
                    <tr style="background:#f8fafc;">
                        <th style="padding:11px 20px; text-align:left; font-size:11px; font-weight:700; color:#64748b; text-transform:uppercase; letter-spacing:0.05em;">Plat Nomor</th>
                        <th style="padding:11px 20px; text-align:left; font-size:11px; font-weight:700; color:#64748b; text-transform:uppercase; letter-spacing:0.05em;">Jenis</th>
                        <th style="padding:11px 20px; text-align:left; font-size:11px; font-weight:700; color:#64748b; text-transform:uppercase; letter-spacing:0.05em;">Masuk</th>
                        <th style="padding:11px 20px; text-align:left; font-size:11px; font-weight:700; color:#64748b; text-transform:uppercase; letter-spacing:0.05em;">Keluar</th>
                        <th style="padding:11px 20px; text-align:left; font-size:11px; font-weight:700; color:#64748b; text-transform:uppercase; letter-spacing:0.05em;">Durasi</th>
                        <th style="padding:11px 20px; text-align:left; font-size:11px; font-weight:700; color:#64748b; text-transform:uppercase; letter-spacing:0.05em;">Biaya</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transaksis as $t)
                    <tr class="table-row" style="border-top:1px solid #f1f5f9;">
                        <td style="padding:12px 20px; font-size:13.5px; font-weight:700; color:#0f172a;">{{ $t->kendaraan->plat_nomor }}</td>
                        <td style="padding:12px 20px; font-size:12.5px; text-transform:capitalize; color:#475569;">{{ $t->kendaraan->jenis_kendaraan }}</td>
                        <td style="padding:12px 20px; font-size:12.5px; color:#475569; white-space:nowrap;">{{ $t->waktu_masuk->format('d/m H:i') }}</td>
                        <td style="padding:12px 20px; font-size:12.5px; color:#475569; white-space:nowrap;">{{ $t->waktu_keluar?->format('d/m H:i') ?? '—' }}</td>
                        <td style="padding:12px 20px; font-size:12.5px; color:#475569;">{{ $t->durasi_jam }} jam</td>
                        <td style="padding:12px 20px; font-size:13.5px; font-weight:700; color:#2563eb;">Rp {{ number_format($t->biaya_total,0,',','.') }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="6" style="padding:50px; text-align:center; color:#94a3b8; font-size:13px;">Tidak ada data</td></tr>
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
