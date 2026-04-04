@extends('layouts.app')
@section('title', 'Pengembalian')
@section('content')

<div class="page-header">
    <div class="page-header-left">
        <div class="breadcrumb-text">Pengembalian</div>
        <h2>Proses Pengembalian</h2>
        <p>Daftar peminjaman aktif yang perlu diproses pengembaliannya</p>
    </div>
</div>

<div class="card">
    <div class="table-wrap">
        <table class="data-table">
            <thead>
                <tr><th>Kode Pinjam</th><th>Peminjam</th><th>Alat</th><th>Tgl Kembali Rencana</th><th>Status</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                @forelse($peminjamans as $p)
                <tr>
                    <td style="color:var(--primary);font-weight:700;">{{ $p->kode_pinjam }}</td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <div class="avatar avatar-sm">{{ strtoupper(substr($p->peminjam->name, 0, 2)) }}</div>
                            <div>
                                <div>{{ $p->peminjam->name }}</div>
                                @if($p->konfirmasi_kembali)
                                <span class="badge badge-available" style="font-size:.65rem;">✓ Sudah konfirmasi</span>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td>{{ $p->details->count() }} alat</td>
                    <td>
                        {{ $p->tgl_kembali_rencana?->format('d M Y') }}
                        @if($p->tgl_kembali_rencana < today())
                        <span class="badge badge-ditolak ms-1">Terlambat</span>
                        @endif
                    </td>
                    <td><span class="badge badge-dipinjam">Dipinjam</span></td>
                    <td>
                        <a href="{{ route('pengembalian.show', $p) }}" class="btn btn-primary btn-sm">
                            <i class="bi bi-arrow-return-left"></i> Proses
                        </a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6"><div class="empty-state"><i class="bi bi-arrow-return-left"></i><p>Tidak ada peminjaman aktif</p></div></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($peminjamans->hasPages())
    <div class="card-footer">{{ $peminjamans->links() }}</div>
    @endif
</div>
@endsection
