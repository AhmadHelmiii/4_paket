@extends('layouts.app')
@section('title', 'Dashboard Admin')

@section('content')
<div class="mb-4 d-flex align-items-center justify-content-between">
    <div>
        <div style="font-size:13px;color:#6B7280;">Beranda Dashboard</div>
        <h4 class="fw-bold mb-0">Selamat Datang, {{ auth()->user()->name }}</h4>
    </div>
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-lg me-1"></i> Input Data Baru
    </a>
</div>

{{-- Stat Cards --}}
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="stat-card">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <div class="stat-icon" style="background:#EEF2FF;color:#4F46E5;"><i class="bi bi-people"></i></div>
            </div>
            <div class="stat-value">{{ number_format($stats['total_user']) }}</div>
            <div class="stat-label">Total Pengguna</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <div class="stat-icon" style="background:#ECFDF5;color:#059669;"><i class="bi bi-tools"></i></div>
            </div>
            <div class="stat-value">{{ number_format($stats['alat_tersedia']) }}</div>
            <div class="stat-label">Alat Tersedia</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <div class="stat-icon" style="background:#EFF6FF;color:#2563EB;"><i class="bi bi-box-arrow-right"></i></div>
            </div>
            <div class="stat-value">{{ number_format($stats['peminjaman_aktif']) }}</div>
            <div class="stat-label">Peminjaman Aktif</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <div class="stat-icon" style="background:#FEF2F2;color:#DC2626;"><i class="bi bi-exclamation-triangle"></i></div>
                @if($stats['terlambat_kembali'] > 0)
                    <span class="badge bg-danger" style="font-size:10px;">ALERTA</span>
                @endif
            </div>
            <div class="stat-value">{{ number_format($stats['terlambat_kembali']) }}</div>
            <div class="stat-label">Terlambat Kembali</div>
        </div>
    </div>
</div>

<div class="row g-3">
    {{-- Log Aktivitas --}}
    <div class="col-md-7">
        <div class="table-card">
            <div class="table-header">
                <div>
                    <div class="fw-600" style="font-weight:600;">Log Aktivitas Terbaru</div>
                    <div style="font-size:12px;color:#9CA3AF;">Data pembaruan sistem waktu nyata</div>
                </div>
                <a href="{{ route('admin.log.index') }}" class="btn btn-sm btn-light" style="font-size:12px;">Lihat Semua</a>
            </div>
            <table class="table table-hover">
                <thead><tr><th>Pengguna</th><th>Aktivitas</th><th>Waktu</th></tr></thead>
                <tbody>
                    @forelse($log_terbaru as $log)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width:28px;height:28px;font-size:11px;font-weight:700;flex-shrink:0;">
                                    {{ strtoupper(substr($log->user->name ?? 'U', 0, 2)) }}
                                </div>
                                <div>
                                    <div style="font-size:13px;font-weight:600;">{{ $log->user->name ?? '-' }}</div>
                                </div>
                            </div>
                        </td>
                        <td><span class="status-badge badge-dipinjam">{{ ucfirst($log->aksi) }}</span></td>
                        <td style="font-size:12px;color:#9CA3AF;">{{ $log->created_at->diffForHumans() }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="3" class="text-center text-muted py-4">Belum ada aktivitas</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Permintaan Pending --}}
    <div class="col-md-5">
        <div class="table-card">
            <div class="table-header">
                <div class="fw-600" style="font-weight:600;">Permintaan Pending</div>
            </div>
            <div class="p-3">
                @forelse($pending as $p)
                <div class="border rounded-3 p-3 mb-2">
                    <div class="d-flex align-items-center justify-content-between mb-1">
                        <div style="font-size:13px;font-weight:600;">{{ $p->details->first()?->alat?->nama_alat ?? 'Beberapa alat' }}</div>
                        @if($p->details->count() > 1)
                            <span class="badge bg-warning text-dark" style="font-size:10px;">+{{ $p->details->count()-1 }} lainnya</span>
                        @endif
                    </div>
                    <div style="font-size:12px;color:#9CA3AF;">Oleh: {{ $p->peminjam->name }}</div>
                    <div class="d-flex gap-2 mt-2">
                        <form method="POST" action="{{ route('petugas.pinjam.aksi', $p->id) }}">
                            @csrf
                            <input type="hidden" name="aksi" value="setujui">
                            <button class="btn btn-sm btn-success" style="font-size:12px;">Approve</button>
                        </form>
                        <form method="POST" action="{{ route('petugas.pinjam.aksi', $p->id) }}">
                            @csrf
                            <input type="hidden" name="aksi" value="tolak">
                            <button class="btn btn-sm btn-outline-danger" style="font-size:12px;">Reject</button>
                        </form>
                    </div>
                </div>
                @empty
                <div class="text-center text-muted py-4" style="font-size:13px;">Tidak ada permintaan pending</div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
