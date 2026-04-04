@extends('layouts.app')
@section('title', 'Laporan Peminjaman')
@section('content')

<div class="page-header">
    <div class="page-header-left">
        <div class="breadcrumb-text">Laporan</div>
        <h2>Laporan Peminjaman</h2>
        <p>Rekap data peminjaman alat dengan filter periode</p>
    </div>
    <a href="{{ route('laporan.pdf', request()->query()) }}" class="btn btn-danger" target="_blank">
        <i class="bi bi-file-earmark-pdf"></i> Export PDF
    </a>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-4"><div class="stat-card"><div class="stat-icon green"><i class="bi bi-clipboard-check"></i></div><div><div class="stat-label">Pinjaman Aktif</div><div class="stat-value">{{ $totalAktif }}</div></div></div></div>
    <div class="col-md-4"><div class="stat-card"><div class="stat-icon blue"><i class="bi bi-people"></i></div><div><div class="stat-label">Total Peminjam</div><div class="stat-value">{{ $totalPeminjam }}</div></div></div></div>
    <div class="col-md-4"><div class="stat-card"><div class="stat-icon red"><i class="bi bi-cash-stack"></i></div><div><div class="stat-label">Total Denda</div><div class="stat-value" style="font-size:1.2rem;">Rp {{ number_format($totalDenda,0,',','.') }}</div></div></div></div>
</div>

<div class="card mb-3">
    <div class="card-body" style="padding:.85rem 1.25rem;">
        <form method="GET" class="d-flex gap-2 flex-wrap align-items-center">
            <input type="date" name="tgl_mulai" class="field-input" style="width:160px;" value="{{ request('tgl_mulai') }}" placeholder="Dari">
            <input type="date" name="tgl_selesai" class="field-input" style="width:160px;" value="{{ request('tgl_selesai') }}" placeholder="Sampai">
            <select name="status" class="field-select" style="width:150px;">
                <option value="">Semua Status</option>
                @foreach(['menunggu','dipinjam','dikembalikan','ditolak'] as $s)
                <option value="{{ $s }}" {{ request('status') == $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                @endforeach
            </select>
            <select name="peminjam_id" class="field-select" style="width:180px;">
                <option value="">Semua Peminjam</option>
                @foreach($peminjams as $u)
                <option value="{{ $u->id }}" {{ request('peminjam_id') == $u->id ? 'selected' : '' }}>{{ $u->name }}</option>
                @endforeach
            </select>
            <button class="btn btn-primary btn-sm">Filter</button>
            <a href="{{ route('laporan.index') }}" class="btn btn-outline btn-sm">Reset</a>
        </form>
    </div>
</div>

<div class="card">
    <div class="table-wrap">
        <table class="data-table">
            <thead>
                <tr><th>ID Pinjam</th><th>Peminjam</th><th>Alat</th><th>Tgl Pinjam</th><th>Tgl Kembali</th><th>Status</th><th>Denda</th></tr>
            </thead>
            <tbody>
                @forelse($peminjamans as $p)
                <tr>
                    <td style="color:var(--primary);font-weight:700;">{{ $p->kode_pinjam }}</td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <div class="avatar avatar-sm">{{ strtoupper(substr($p->peminjam->name, 0, 2)) }}</div>
                            {{ $p->peminjam->name }}
                        </div>
                    </td>
                    <td>{{ $p->details->count() }} alat</td>
                    <td class="td-muted">{{ $p->tgl_pinjam?->format('d M Y') ?? '-' }}</td>
                    <td class="td-muted">{{ $p->tgl_kembali_rencana?->format('d M Y') }}</td>
                    <td><span class="badge badge-{{ $p->status }}">{{ ucfirst($p->status) }}</span></td>
                    <td>
                        @if($p->pengembalian)
                        <span style="{{ $p->pengembalian->denda > 0 ? 'color:var(--danger);font-weight:700;' : 'color:var(--gray-400);' }}">
                            Rp {{ number_format($p->pengembalian->denda,0,',','.') }}
                        </span>
                        @else
                        <span class="td-muted">-</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="7"><div class="empty-state"><i class="bi bi-bar-chart-line"></i><p>Tidak ada data</p></div></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($peminjamans->hasPages())
    <div class="card-footer">{{ $peminjamans->links() }}</div>
    @endif
</div>
@endsection
