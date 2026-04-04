@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')

<div class="page-header">
    <div class="page-header-left">
        <div class="breadcrumb-text">Beranda Dashboard</div>
        <h2>Selamat Datang, {{ auth()->user()->name }} 👋</h2>
        <p>{{ now()->translatedFormat('l, d F Y') }}</p>
    </div>
    @if(auth()->user()->isPeminjam())
    <a href="{{ route('peminjaman.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Pinjam Alat Baru
    </a>
    @endif
</div>

{{-- ===== ADMIN ===== --}}
@if(auth()->user()->isAdmin())
<div class="row g-3 mb-4">
    <div class="col-md-3 col-sm-6">
        <div class="stat-card">
            <div class="stat-icon blue"><i class="bi bi-people"></i></div>
            <div>
                <div class="stat-label">Total Pengguna</div>
                <div class="stat-value">{{ $data['total_users'] }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="stat-card">
            <div class="stat-icon green"><i class="bi bi-tools"></i></div>
            <div>
                <div class="stat-label">Alat Tersedia</div>
                <div class="stat-value">{{ $data['total_alat'] }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="stat-card">
            <div class="stat-icon yellow"><i class="bi bi-clipboard-check"></i></div>
            <div>
                <div class="stat-label">Peminjaman Aktif</div>
                <div class="stat-value">{{ $data['peminjaman_aktif'] }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="stat-card">
            <div class="stat-icon red"><i class="bi bi-exclamation-triangle"></i></div>
            <div>
                <div class="stat-label">Terlambat Kembali</div>
                <div class="stat-value">{{ $data['terlambat'] }}</div>
            </div>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-md-7">
        <div class="card">
            <div class="card-header">
                <span class="card-header-title">Log Aktivitas Terbaru</span>
                <a href="{{ route('admin.log.index') }}" class="btn btn-outline btn-sm">Lihat Semua</a>
            </div>
            <div class="table-wrap">
                <table class="data-table">
                    <thead><tr><th>Pengguna</th><th>Aktivitas</th><th>Waktu</th></tr></thead>
                    <tbody>
                        @forelse($data['log_terbaru'] as $log)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="avatar avatar-sm">{{ strtoupper(substr($log->user->name ?? 'U', 0, 2)) }}</div>
                                    <span>{{ $log->user->name ?? '-' }}</span>
                                </div>
                            </td>
                            <td>
                                @php $c = ['login'=>'badge-dipinjam','create'=>'badge-available','update'=>'badge-menunggu','delete'=>'badge-ditolak'][$log->aksi] ?? 'badge-kategori'; @endphp
                                <span class="badge {{ $c }}">{{ ucfirst($log->aksi) }}</span>
                            </td>
                            <td class="td-muted">{{ $log->created_at->diffForHumans() }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="3"><div class="empty-state"><i class="bi bi-inbox"></i><p>Belum ada aktivitas</p></div></td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="card h-100">
            <div class="card-header">
                <span class="card-header-title">Permintaan Pending</span>
                <a href="{{ route('peminjaman.index') }}" class="btn btn-outline btn-sm">Semua</a>
            </div>
            <div class="card-body" style="padding:.75rem;">
                @forelse($data['pending'] as $p)
                <div style="border:1px solid var(--gray-200);border-radius:10px;padding:.85rem;margin-bottom:.6rem;">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <div style="font-weight:700;font-size:.875rem;color:var(--gray-800);">{{ $p->peminjam->name }}</div>
                            <div style="font-size:.75rem;color:var(--gray-400);">{{ $p->kode_pinjam }} · {{ $p->details->count() }} alat</div>
                        </div>
                        <span class="badge badge-menunggu">Pending</span>
                    </div>
                    <div class="d-flex gap-2">
                        <form method="POST" action="{{ route('peminjaman.aksi', $p) }}" class="d-inline">
                            @csrf <input type="hidden" name="aksi" value="setujui">
                            <button class="btn btn-success btn-sm">Approve</button>
                        </form>
                        <form method="POST" action="{{ route('peminjaman.aksi', $p) }}" class="d-inline">
                            @csrf <input type="hidden" name="aksi" value="tolak">
                            <button class="btn btn-outline-danger btn-sm">Reject</button>
                        </form>
                    </div>
                </div>
                @empty
                <div class="empty-state"><i class="bi bi-check-circle"></i><p>Tidak ada permintaan pending</p></div>
                @endforelse
            </div>
        </div>
    </div>
</div>

{{-- ===== PETUGAS ===== --}}
@elseif(auth()->user()->isPetugas())
<div class="row g-3 mb-4">
    <div class="col-md-4"><div class="stat-card"><div class="stat-icon green"><i class="bi bi-clipboard-check"></i></div><div><div class="stat-label">Peminjaman Aktif</div><div class="stat-value">{{ $data['peminjaman_aktif'] }}</div></div></div></div>
    <div class="col-md-4"><div class="stat-card"><div class="stat-icon yellow"><i class="bi bi-hourglass-split"></i></div><div><div class="stat-label">Menunggu Persetujuan</div><div class="stat-value">{{ $data['menunggu'] }}</div></div></div></div>
    <div class="col-md-4"><div class="stat-card"><div class="stat-icon red"><i class="bi bi-exclamation-triangle"></i></div><div><div class="stat-label">Terlambat</div><div class="stat-value">{{ $data['terlambat'] }}</div></div></div></div>
</div>
<div class="card">
    <div class="card-header"><span class="card-header-title">Permintaan Pending</span></div>
    <div class="card-body" style="padding:.75rem;">
        @forelse($data['pending'] as $p)
        <div style="border:1px solid var(--gray-200);border-radius:10px;padding:.85rem;margin-bottom:.6rem;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div style="font-weight:700;font-size:.875rem;">{{ $p->peminjam->name }}</div>
                    <div style="font-size:.75rem;color:var(--gray-400);">{{ $p->kode_pinjam }} · {{ $p->details->count() }} alat</div>
                </div>
                <a href="{{ route('peminjaman.show', $p) }}" class="btn btn-outline-primary btn-sm">Detail</a>
            </div>
        </div>
        @empty
        <div class="empty-state"><i class="bi bi-check-circle"></i><p>Tidak ada permintaan pending</p></div>
        @endforelse
    </div>
</div>

{{-- ===== PEMINJAM ===== --}}
@else
<div class="row g-3 mb-4">
    <div class="col-md-4"><div class="stat-card"><div class="stat-icon green"><i class="bi bi-clipboard-check"></i></div><div><div class="stat-label">Sedang Dipinjam</div><div class="stat-value">{{ $data['aktif'] }}</div></div></div></div>
    <div class="col-md-4"><div class="stat-card"><div class="stat-icon yellow"><i class="bi bi-hourglass-split"></i></div><div><div class="stat-label">Menunggu Persetujuan</div><div class="stat-value">{{ $data['menunggu'] }}</div></div></div></div>
    <div class="col-md-4"><div class="stat-card"><div class="stat-icon purple"><i class="bi bi-tools"></i></div><div><div class="stat-label">Alat Tersedia</div><div class="stat-value">{{ $data['alat_tersedia'] }}</div></div></div></div>
</div>
<div class="card">
    <div class="card-header">
        <span class="card-header-title">Peminjaman Saya</span>
        <a href="{{ route('peminjaman.index') }}" class="btn btn-outline btn-sm">Lihat Semua</a>
    </div>
    <div class="table-wrap">
        <table class="data-table">
            <thead><tr><th>Kode</th><th>Alat</th><th>Tgl Kembali</th><th>Status</th></tr></thead>
            <tbody>
                @forelse($data['peminjaman_saya'] as $p)
                <tr>
                    <td><a href="{{ route('peminjaman.show', $p) }}" style="color:var(--primary);font-weight:700;text-decoration:none;">{{ $p->kode_pinjam }}</a></td>
                    <td>{{ $p->details->count() }} alat</td>
                    <td class="td-muted">{{ $p->tgl_kembali_rencana?->format('d M Y') }}</td>
                    <td><span class="badge badge-{{ $p->status }}">{{ ucfirst($p->status) }}</span></td>
                </tr>
                @empty
                <tr><td colspan="4"><div class="empty-state"><i class="bi bi-inbox"></i><p>Belum ada peminjaman</p></div></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endif

@endsection
