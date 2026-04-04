@extends('layouts.app')
@section('title', 'Riwayat Pengembalian')
@section('content')

<div class="page-header">
    <div class="page-header-left">
        <div class="breadcrumb-text">Admin › Riwayat Pengembalian</div>
        <h2>Riwayat Pengembalian</h2>
        <p>Semua data pengembalian alat yang telah diproses</p>
    </div>
</div>

<div class="card">
    <div class="table-wrap">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Kode Pinjam</th>
                    <th>Peminjam</th>
                    <th>Alat</th>
                    <th>Tgl Kembali Aktual</th>
                    <th>Hari Terlambat</th>
                    <th>Denda</th>
                    <th>Diproses Oleh</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pengembalians as $p)
                <tr>
                    <td style="color:var(--primary);font-weight:700;">{{ $p->peminjaman->kode_pinjam }}</td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <div class="avatar avatar-sm">{{ strtoupper(substr($p->peminjaman->peminjam->name, 0, 2)) }}</div>
                            {{ $p->peminjaman->peminjam->name }}
                        </div>
                    </td>
                    <td>{{ $p->peminjaman->details->count() }} alat</td>
                    <td class="td-muted">{{ $p->tgl_kembali_aktual->format('d M Y') }}</td>
                    <td>
                        @if($p->hari_terlambat > 0)
                        <span class="badge badge-ditolak">{{ $p->hari_terlambat }} hari</span>
                        @else
                        <span class="badge badge-available">Tepat waktu</span>
                        @endif
                    </td>
                    <td>
                        <span style="{{ $p->denda > 0 ? 'color:var(--danger);font-weight:700;' : 'color:var(--gray-400);' }}">
                            Rp {{ number_format($p->denda, 0, ',', '.') }}
                        </span>
                    </td>
                    <td class="td-muted">{{ $p->petugas->name }}</td>
                    <td>
                        @if(auth()->user()->isAdmin())
                        <form method="POST" action="{{ route('pengembalian.destroy', $p) }}" onsubmit="return confirm('Hapus data pengembalian ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-outline-danger btn-icon btn-sm"><i class="bi bi-trash"></i></button>
                        </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="8"><div class="empty-state"><i class="bi bi-clock-history"></i><p>Belum ada riwayat pengembalian</p></div></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($pengembalians->hasPages())
    <div class="card-footer">{{ $pengembalians->links() }}</div>
    @endif
</div>
@endsection
