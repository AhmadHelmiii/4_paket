@extends('layouts.app')
@section('title', 'Struk Parkir')
@section('page-title', 'Struk Parkir')
@section('page-subtitle', 'Transaksi #' . str_pad($transaksi->id_parkir, 6, '0', STR_PAD_LEFT))

@section('content')
<div style="max-width:400px; margin:0 auto;">
    <div class="card" style="overflow:hidden;">

        {{-- Header --}}
        <div style="background:linear-gradient(135deg,#0f172a,#1e293b); padding:24px; text-align:center;">
            <div style="width:48px; height:48px; background:linear-gradient(135deg,#2563eb,#1d4ed8); border-radius:14px; display:flex; align-items:center; justify-content:center; margin:0 auto 12px;">
                <i class="fa-solid fa-square-parking" style="color:#fff; font-size:22px;"></i>
            </div>
            <p style="color:#fff; font-size:18px; font-weight:800;">Parking Excellence</p>
            <p style="color:#64748b; font-size:12px; margin-top:2px;">Struk Parkir Resmi</p>
            <div style="margin-top:12px; background:rgba(255,255,255,0.06); border-radius:8px; padding:6px 14px; display:inline-block;">
                <p style="color:#94a3b8; font-size:11.5px; font-family:monospace;">
                    #{{ str_pad($transaksi->id_parkir, 6, '0', STR_PAD_LEFT) }}
                </p>
            </div>
        </div>

        {{-- Body --}}
        <div style="padding:20px;">
            @php
            $rows = [
                'Plat Nomor'   => $transaksi->kendaraan->plat_nomor,
                'Jenis'        => ucfirst($transaksi->kendaraan->jenis_kendaraan),
                'Area Parkir'  => $transaksi->area->nama_area,
                'Waktu Masuk'  => $transaksi->waktu_masuk->format('d/m/Y H:i'),
                'Waktu Keluar' => $transaksi->waktu_keluar?->format('d/m/Y H:i') ?? '-',
                'Durasi'       => ($transaksi->durasi_jam ?? 0) . ' jam',
                'Tarif/Jam'    => 'Rp ' . number_format($transaksi->tarif->tarif_per_jam, 0, ',', '.'),
            ];
            @endphp

            @foreach($rows as $label => $value)
            <div style="display:flex; justify-content:space-between; align-items:center; padding:9px 0; border-bottom:1px dashed #f1f5f9;">
                <span style="font-size:12.5px; color:#64748b;">{{ $label }}</span>
                <span style="font-size:13px; font-weight:600; color:#0f172a;">{{ $value }}</span>
            </div>
            @endforeach

            <div style="background:linear-gradient(135deg,#eff6ff,#dbeafe); border-radius:12px; padding:16px; text-align:center; margin-top:16px;">
                <p style="font-size:11px; color:#3b82f6; font-weight:700; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:4px;">Total Dibayar</p>
                <p style="font-size:28px; font-weight:900; color:#1d4ed8;">Rp {{ number_format($transaksi->biaya_total, 0, ',', '.') }}</p>
            </div>

            <p style="text-align:center; font-size:11.5px; color:#94a3b8; margin-top:14px;">
                Petugas: {{ $transaksi->user->nama_lengkap }}<br>
                {{ now()->format('d/m/Y H:i:s') }}
            </p>
        </div>

        {{-- Actions --}}
        <div style="padding:0 20px 20px; display:flex; gap:10px;">
            <a href="{{ route('petugas.transaksi.cetak', $transaksi->id_parkir) }}" target="_blank" class="btn-primary" style="flex:1; justify-content:center;">
                <i class="fa-solid fa-print"></i> Cetak PDF
            </a>
            <a href="{{ route('petugas.transaksi.index') }}" class="btn-ghost" style="flex:1; justify-content:center;">
                <i class="fa-solid fa-list"></i> Kembali
            </a>
        </div>
    </div>
</div>
@endsection
