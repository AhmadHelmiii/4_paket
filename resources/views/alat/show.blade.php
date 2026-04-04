@extends('layouts.app')
@section('title', 'Detail Alat')
@section('content')

<div class="page-header">
    <div class="page-header-left">
        <div class="breadcrumb-text">{{ auth()->user()->isPeminjam() ? 'Katalog Alat' : 'Data Alat' }} › Detail</div>
        <h2>{{ $alat->nama_alat }}</h2>
    </div>
    <a href="{{ route('alat.index') }}" class="btn btn-outline"><i class="bi bi-arrow-left"></i> Kembali</a>
</div>

<div class="row g-3">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body text-center" style="padding:1.5rem;">
                @if($alat->foto_url)
                <img src="{{ $alat->foto_url }}" class="img-fluid rounded mb-3" style="max-height:220px;object-fit:cover;border-radius:10px!important;">
                @else
                <div style="height:180px;background:var(--gray-100);border-radius:10px;display:flex;align-items:center;justify-content:center;margin-bottom:1rem;">
                    <i class="bi bi-tools" style="font-size:3rem;color:var(--gray-300);"></i>
                </div>
                @endif
                <div style="font-weight:800;font-size:1.05rem;color:var(--gray-900);margin-bottom:.4rem;">{{ $alat->nama_alat }}</div>
                <span class="badge badge-kategori">{{ $alat->kode_alat }}</span>

                @if(auth()->user()->isPeminjam() && $alat->stok_tersedia > 0)
                <div style="margin-top:1rem;">
                    <a href="{{ route('peminjaman.create') }}" class="btn btn-primary" style="width:100%;">
                        <i class="bi bi-plus-lg"></i> Pinjam Alat Ini
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header"><span class="card-header-title">Informasi Alat</span></div>
            <div class="card-body">
                <table style="width:100%;border-collapse:collapse;">
                    <tr style="border-bottom:1px solid var(--gray-100);">
                        <td style="padding:.65rem 0;color:var(--gray-400);font-size:.825rem;width:40%;">Kategori</td>
                        <td style="padding:.65rem 0;font-weight:600;">{{ $alat->kategori->nama_kategori }}</td>
                    </tr>
                    <tr style="border-bottom:1px solid var(--gray-100);">
                        <td style="padding:.65rem 0;color:var(--gray-400);font-size:.825rem;">Stok Total</td>
                        <td style="padding:.65rem 0;font-weight:600;">{{ $alat->stok_total }}</td>
                    </tr>
                    <tr style="border-bottom:1px solid var(--gray-100);">
                        <td style="padding:.65rem 0;color:var(--gray-400);font-size:.825rem;">Stok Tersedia</td>
                        <td style="padding:.65rem 0;">
                            <span style="font-weight:800;font-size:1.1rem;color:{{ $alat->stok_tersedia > 0 ? 'var(--success)' : 'var(--danger)' }};">
                                {{ $alat->stok_tersedia }}
                            </span>
                            @if($alat->stok_tersedia > 0)
                            <span class="badge badge-available ms-2">Tersedia</span>
                            @else
                            <span class="badge badge-habis ms-2">Habis</span>
                            @endif
                        </td>
                    </tr>
                    <tr style="border-bottom:1px solid var(--gray-100);">
                        <td style="padding:.65rem 0;color:var(--gray-400);font-size:.825rem;">Kondisi</td>
                        <td style="padding:.65rem 0;">
                            @php $kc = ['baik'=>'badge-available','rusak ringan'=>'badge-menunggu','rusak berat'=>'badge-ditolak'][$alat->kondisi] ?? 'badge-kategori'; @endphp
                            <span class="badge {{ $kc }}">{{ ucfirst($alat->kondisi) }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:.65rem 0;color:var(--gray-400);font-size:.825rem;">Deskripsi</td>
                        <td style="padding:.65rem 0;color:var(--gray-600);">{{ $alat->deskripsi ?? '-' }}</td>
                    </tr>
                </table>
            </div>
        </div>

        @if(auth()->user()->isAdmin() || auth()->user()->isPetugas())
        <div class="d-flex gap-2 mt-3">
            <a href="{{ route('alat.edit', $alat) }}" class="btn btn-primary">
                <i class="bi bi-pencil"></i> Edit Alat
            </a>
        </div>
        @endif
    </div>
</div>
@endsection
