@extends('layouts.app')
@section('title', 'Kendaraan Keluar')
@section('page-title', 'Kendaraan Keluar')
@section('page-subtitle', 'Proses pembayaran dan checkout kendaraan')

@section('content')
<div style="max-width:520px; display:flex; flex-direction:column; gap:16px;">

    <x-form-card>
        <p style="font-size:14px; font-weight:700; color:#0f172a; margin-bottom:14px;">
            <i class="fa-solid fa-magnifying-glass" style="color:#2563eb; margin-right:8px;"></i>Cari Kendaraan
        </p>
        <form method="GET" action="{{ route('petugas.transaksi.checkout') }}" style="display:flex; gap:10px;">
            <input type="text" name="plat_nomor" value="{{ request('plat_nomor') }}"
                   class="input-field" placeholder="Masukkan plat nomor..."
                   style="flex:1; text-transform:uppercase; font-size:15px; font-weight:700; letter-spacing:0.05em;"
                   autofocus>
            <button type="submit" class="btn-primary">
                <i class="fa-solid fa-search"></i> Cari
            </button>
        </form>
    </x-form-card>

    @isset($transaksi)
    <div class="card" style="overflow:hidden;">
        <div style="background:linear-gradient(135deg,#0f172a,#1e293b); padding:20px;">
            <div style="display:flex; align-items:center; gap:12px;">
                <div style="width:46px; height:46px; border-radius:12px; background:rgba(255,255,255,0.1); display:flex; align-items:center; justify-content:center;">
                    <i class="fa-solid {{ $kendaraan->jenis_kendaraan === 'motor' ? 'fa-motorcycle' : ($kendaraan->jenis_kendaraan === 'mobil' ? 'fa-car' : 'fa-truck') }}" style="color:#fff; font-size:20px;"></i>
                </div>
                <div>
                    <p style="color:#fff; font-size:20px; font-weight:800; letter-spacing:0.05em;">{{ $kendaraan->plat_nomor }}</p>
                    <p style="color:#94a3b8; font-size:12.5px; text-transform:capitalize;">{{ $kendaraan->jenis_kendaraan }} &bull; {{ $transaksi->area->nama_area }}</p>
                </div>
            </div>
        </div>

        <div style="padding:20px;">
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px; margin-bottom:16px;">
                <div style="background:#f8fafc; border-radius:12px; padding:14px;">
                    <p style="font-size:11px; color:#94a3b8; font-weight:600; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:4px;">Waktu Masuk</p>
                    <p style="font-size:14px; font-weight:700; color:#0f172a;">{{ $transaksi->waktu_masuk->format('H:i') }}</p>
                    <p style="font-size:11.5px; color:#64748b;">{{ $transaksi->waktu_masuk->format('d/m/Y') }}</p>
                </div>
                <div style="background:#f8fafc; border-radius:12px; padding:14px;">
                    <p style="font-size:11px; color:#94a3b8; font-weight:600; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:4px;">Durasi</p>
                    <p style="font-size:14px; font-weight:700; color:#0f172a;">{{ $hasil['durasi'] }} jam</p>
                    <p style="font-size:11.5px; color:#64748b;">Tarif Rp {{ number_format($transaksi->tarif->tarif_per_jam,0,',','.') }}/jam</p>
                </div>
            </div>

            <div style="background:linear-gradient(135deg,#eff6ff,#dbeafe); border-radius:14px; padding:18px; text-align:center; margin-bottom:18px;">
                <p style="font-size:12px; color:#3b82f6; font-weight:600; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:4px;">Total Pembayaran</p>
                <p style="font-size:32px; font-weight:900; color:#1d4ed8;">Rp {{ number_format($hasil['biaya'],0,',','.') }}</p>
            </div>

            <form method="POST" action="{{ route('petugas.transaksi.proses-checkout', $transaksi->id_parkir) }}">
                @csrf
                <button type="submit" class="btn-success" style="width:100%; justify-content:center; padding:13px; font-size:14px;">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    Proses Keluar & Cetak Struk
                </button>
            </form>
        </div>
    </div>
    @endisset
</div>
@endsection
