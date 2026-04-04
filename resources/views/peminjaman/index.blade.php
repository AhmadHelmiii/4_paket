@extends('layouts.app')
@section('title', 'Peminjaman')
@section('content')

<div class="page-header">
    <div class="page-header-left">
        <div class="breadcrumb-text">Peminjaman</div>
        <h2>Daftar Peminjaman</h2>
    </div>
    @if(auth()->user()->isPeminjam())
    <a href="{{ route('peminjaman.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Ajukan Peminjaman
    </a>
    @endif
</div>

<div class="card">
    <div class="table-wrap">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Kode Pinjam</th>
                    @if(!auth()->user()->isPeminjam())<th>Peminjam</th>@endif
                    <th>Alat</th>
                    <th>Tgl Pinjam</th>
                    <th>Tgl Kembali</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($peminjamans as $p)
                <tr>
                    <td>
                        <a href="{{ route('peminjaman.show', $p) }}" style="color:var(--primary);font-weight:700;text-decoration:none;">
                            {{ $p->kode_pinjam }}
                        </a>
                    </td>
                    @if(!auth()->user()->isPeminjam())
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <div class="avatar avatar-sm">{{ strtoupper(substr($p->peminjam->name, 0, 2)) }}</div>
                            {{ $p->peminjam->name }}
                        </div>
                    </td>
                    @endif
                    <td style="font-weight:600;">{{ $p->details->count() }} alat</td>
                    <td class="td-muted">{{ $p->tgl_pinjam?->format('d M Y') ?? '-' }}</td>
                    <td class="td-muted">
                        {{ $p->tgl_kembali_rencana?->format('d M Y') }}
                        @if($p->status === 'dipinjam' && $p->tgl_kembali_rencana < today())
                        <span class="badge badge-ditolak ms-1">Terlambat</span>
                        @endif
                    </td>
                    <td><span class="badge badge-{{ $p->status }}">{{ ucfirst($p->status) }}</span></td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('peminjaman.show', $p) }}" class="btn btn-outline btn-icon btn-sm"><i class="bi bi-eye"></i></a>
                            @if((auth()->user()->isPetugas() || auth()->user()->isAdmin()) && $p->status === 'dipinjam')
                            <a href="{{ route('pengembalian.show', $p) }}" class="btn btn-outline-primary btn-icon btn-sm" title="Proses Kembali"><i class="bi bi-arrow-return-left"></i></a>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7"><div class="empty-state"><i class="bi bi-clipboard-x"></i><p>Tidak ada data peminjaman</p></div></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($peminjamans->hasPages())
    <div class="card-footer">{{ $peminjamans->links() }}</div>
    @endif
</div>
@endsection
