@extends('layouts.app')
@section('title', auth()->user()->isPeminjam() ? 'Katalog Alat' : 'Data Alat')
@section('content')

<div class="page-header">
    <div class="page-header-left">
        <div class="breadcrumb-text">{{ auth()->user()->isPeminjam() ? 'Katalog Alat' : 'Manajemen › Data Alat' }}</div>
        <h2>{{ auth()->user()->isPeminjam() ? 'Katalog Alat Tersedia' : 'Daftar Alat' }}</h2>
        <p>{{ auth()->user()->isPeminjam() ? 'Pilih alat yang ingin kamu pinjam' : 'Kelola inventaris peralatan dan pantau ketersediaan stok' }}</p>
    </div>
    @if(auth()->user()->isAdmin() || auth()->user()->isPetugas())
    <a href="{{ route('alat.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Tambah Alat Baru
    </a>
    @endif
    @if(auth()->user()->isPeminjam())
    <a href="{{ route('peminjaman.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Ajukan Peminjaman
    </a>
    @endif
</div>

{{-- Filter --}}
<div class="card mb-3">
    <div class="card-body" style="padding:.85rem 1.25rem;">
        <form method="GET" class="d-flex gap-2 flex-wrap align-items-center">
            <div style="position:relative;flex:1;min-width:200px;">
                <i class="bi bi-search" style="position:absolute;left:10px;top:50%;transform:translateY(-50%);color:var(--gray-400);font-size:.85rem;"></i>
                <input type="text" name="search" class="field-input" style="padding-left:2rem;" placeholder="Cari nama atau kode alat..." value="{{ request('search') }}">
            </div>
            <select name="kategori_id" class="field-select" style="width:180px;">
                <option value="">Semua Kategori</option>
                @foreach($kategoris as $k)
                <option value="{{ $k->id }}" {{ request('kategori_id') == $k->id ? 'selected' : '' }}>{{ $k->nama_kategori }}</option>
                @endforeach
            </select>
            @if(auth()->user()->isPeminjam())
            <select name="tersedia" class="field-select" style="width:160px;">
                <option value="">Semua Status</option>
                <option value="1" {{ request('tersedia') == '1' ? 'selected' : '' }}>Tersedia Saja</option>
            </select>
            @endif
            <button class="btn btn-primary btn-sm">Filter</button>
            <a href="{{ route('alat.index') }}" class="btn btn-outline btn-sm">Reset</a>
        </form>
    </div>
</div>

{{-- Tampilan grid untuk peminjam, tabel untuk admin/petugas --}}
@if(auth()->user()->isPeminjam())

<div class="row g-3">
    @forelse($alats as $alat)
    <div class="col-md-3 col-sm-6">
        <div class="card h-100" style="transition:box-shadow .2s,transform .2s;" onmouseover="this.style.boxShadow='var(--shadow)';this.style.transform='translateY(-2px)'" onmouseout="this.style.boxShadow='';this.style.transform=''">
            @if($alat->foto_url)
            <img src="{{ $alat->foto_url }}" style="width:100%;height:160px;object-fit:cover;">
            @else
            <div style="width:100%;height:160px;background:var(--gray-100);display:flex;align-items:center;justify-content:center;">
                <i class="bi bi-tools" style="font-size:2.5rem;color:var(--gray-300);"></i>
            </div>
            @endif
            <div class="card-body" style="padding:1rem;">
                <div class="d-flex justify-content-between align-items-start mb-1">
                    <span class="badge badge-kategori">{{ $alat->kategori->nama_kategori }}</span>
                    @if($alat->stok_tersedia > 0)
                    <span class="badge badge-available">Tersedia</span>
                    @else
                    <span class="badge badge-habis">Habis</span>
                    @endif
                </div>
                <div style="font-weight:700;font-size:.9rem;margin:.5rem 0 .25rem;color:var(--gray-900);">{{ $alat->nama_alat }}</div>
                <div style="font-size:.78rem;color:var(--gray-400);margin-bottom:.75rem;">
                    Stok: <span style="font-weight:700;color:{{ $alat->stok_tersedia > 0 ? 'var(--success)' : 'var(--danger)' }}">{{ $alat->stok_tersedia }} Unit</span>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('alat.show', $alat) }}" class="btn btn-outline btn-sm" style="flex:1;justify-content:center;">Detail</a>
                    @if($alat->stok_tersedia > 0)
                    <a href="{{ route('peminjaman.create') }}" class="btn btn-primary btn-sm" style="flex:1;justify-content:center;">Pinjam</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="card">
            <div class="empty-state"><i class="bi bi-tools"></i><p>Tidak ada alat ditemukan</p></div>
        </div>
    </div>
    @endforelse
</div>
@if($alats->hasPages())
<div class="mt-3">{{ $alats->links() }}</div>
@endif

@else

{{-- Tabel untuk admin/petugas --}}
<div class="card mb-3">
    <div class="table-wrap">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Kode Alat</th>
                    <th>Nama Alat</th>
                    <th>Kategori</th>
                    <th>Stok (T/A)</th>
                    <th>Kondisi</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($alats as $alat)
                <tr>
                    <td style="color:var(--primary);font-weight:700;">{{ $alat->kode_alat }}</td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            @if($alat->foto_url)
                            <img src="{{ $alat->foto_url }}" style="width:38px;height:38px;border-radius:8px;object-fit:cover;border:1px solid var(--gray-200);">
                            @else
                            <div style="width:38px;height:38px;border-radius:8px;background:var(--gray-100);display:flex;align-items:center;justify-content:center;">
                                <i class="bi bi-tools" style="color:var(--gray-400);"></i>
                            </div>
                            @endif
                            <span style="font-weight:600;">{{ $alat->nama_alat }}</span>
                        </div>
                    </td>
                    <td><span class="badge badge-kategori">{{ $alat->kategori->nama_kategori }}</span></td>
                    <td style="font-weight:600;">{{ $alat->stok_total }} / <span style="color:{{ $alat->stok_tersedia > 0 ? 'var(--success)' : 'var(--danger)' }}">{{ $alat->stok_tersedia }}</span></td>
                    <td>
                        @php $kc = ['baik'=>'badge-available','rusak ringan'=>'badge-menunggu','rusak berat'=>'badge-ditolak'][$alat->kondisi] ?? 'badge-kategori'; @endphp
                        <span class="badge {{ $kc }}">{{ ucfirst($alat->kondisi) }}</span>
                    </td>
                    <td>
                        @if($alat->stok_tersedia > 0)
                        <span class="badge badge-available">● Available</span>
                        @else
                        <span class="badge badge-habis">● Habis</span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('alat.show', $alat) }}" class="btn btn-outline btn-icon btn-sm" title="Detail"><i class="bi bi-eye"></i></a>
                            @if(auth()->user()->isAdmin() || auth()->user()->isPetugas())
                            <a href="{{ route('alat.edit', $alat) }}" class="btn btn-outline-primary btn-icon btn-sm" title="Edit"><i class="bi bi-pencil"></i></a>
                            @endif
                            @if(auth()->user()->isAdmin())
                            <form method="POST" action="{{ route('alat.destroy', $alat) }}" onsubmit="return confirm('Hapus alat ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-outline-danger btn-icon btn-sm" title="Hapus"><i class="bi bi-trash"></i></button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7"><div class="empty-state"><i class="bi bi-tools"></i><p>Tidak ada data alat</p></div></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($alats->hasPages())
    <div class="card-footer">{{ $alats->links() }}</div>
    @endif
</div>

<div class="row g-3">
    <div class="col-md-4"><div class="stat-card"><div class="stat-icon purple"><i class="bi bi-archive"></i></div><div><div class="stat-label">Total Aset</div><div class="stat-value">{{ $alats->total() }}</div></div></div></div>
    <div class="col-md-4"><div class="stat-card"><div class="stat-icon green"><i class="bi bi-check-circle"></i></div><div><div class="stat-label">Tersedia</div><div class="stat-value">{{ \App\Models\Alat::where('stok_tersedia','>',0)->count() }}</div></div></div></div>
    <div class="col-md-4"><div class="stat-card"><div class="stat-icon red"><i class="bi bi-exclamation-triangle"></i></div><div><div class="stat-label">Kondisi Rusak</div><div class="stat-value">{{ \App\Models\Alat::where('kondisi','!=','baik')->count() }}</div></div></div></div>
</div>
@endif

@endsection
