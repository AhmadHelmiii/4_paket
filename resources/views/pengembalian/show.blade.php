@extends('layouts.app')
@section('title', 'Proses Pengembalian')
@section('content')
<div class="mb-4">
    <p class="text-muted small mb-0">Pengembalian › Proses</p>
    <h3 class="fw-bold mb-0">Proses Pengembalian</h3>
    <div class="text-muted small">Sesi Aktif: {{ now()->format('d M Y, H:i') }}</div>
</div>
<div class="row g-3">
    <div class="col-md-7">
        <div class="card mb-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span class="fw-semibold">Detail Peminjaman</span>
                <span class="badge badge-status-dipinjam px-3 py-2">STATUS: AKTIF</span>
            </div>
            <div class="card-body">
                <div class="row g-2 mb-3">
                    <div class="col-md-4"><div class="text-muted small">Peminjam</div><div class="fw-semibold">{{ $peminjaman->peminjam->name }}</div><div class="text-muted" style="font-size:.75rem;">ID: {{ $peminjaman->kode_pinjam }}</div></div>
                    <div class="col-md-4"><div class="text-muted small">Tanggal Pinjam</div><div class="fw-semibold">{{ $peminjaman->tgl_pinjam?->format('d M Y') }}</div></div>
                    <div class="col-md-4"><div class="text-muted small">Tanggal Kembali Rencana</div><div class="fw-semibold">{{ $peminjaman->tgl_kembali_rencana?->format('d M Y') }}</div></div>
                </div>
                <h6 class="fw-semibold">Daftar Alat yang Dipinjam</h6>
                <form method="POST" action="{{ route('pengembalian.store', $peminjaman) }}" id="formKembali">
                @csrf
                <table class="table table-sm table-bordered">
                    <thead class="table-light"><tr><th>Alat</th><th>Kode Seri</th><th>Jml</th><th>Kondisi Akhir</th></tr></thead>
                    <tbody>
                        @foreach($peminjaman->details as $d)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="rounded bg-warning bg-opacity-25 p-1"><i class="bi bi-tools text-warning"></i></div>
                                    {{ $d->alat->nama_alat }}
                                </div>
                            </td>
                            <td class="text-muted small">{{ $d->alat->kode_alat }}</td>
                            <td>{{ $d->jumlah }}</td>
                            <td>
                                <select name="kondisi_akhir[{{ $d->id }}]" class="form-select form-select-sm" required>
                                    <option value="baik">Baik</option>
                                    <option value="rusak ringan">Rusak Ringan</option>
                                    <option value="rusak berat">Rusak Berat</option>
                                </select>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mb-3">
                    <label class="form-label fw-semibold small">Tanggal Pengembalian Aktual <span class="text-danger">*</span></label>
                    <input type="date" name="tgl_kembali" class="form-control form-control-sm" value="{{ today()->toDateString() }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold small">Keterangan</label>
                    <textarea name="keterangan" class="form-control form-control-sm" rows="2" placeholder="Catatan kondisi alat..."></textarea>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="card mb-3" style="border-color:#fee2e2;">
            <div class="card-header fw-semibold" style="background:#fff5f5;">
                <i class="bi bi-receipt me-2 text-danger"></i>Kalkulasi Denda
            </div>
            <div class="card-body">
                <div class="text-center mb-3">
                    <div class="fw-bold" style="font-size:2rem;color:#dc2626;">Rp {{ number_format($estimasiDenda, 0, ',', '.') }}</div>
                    @if($hariTerlambat > 0)
                    <span class="badge bg-danger">TERLAMBAT {{ $hariTerlambat }} HARI</span>
                    @else
                    <span class="badge bg-success">TEPAT WAKTU</span>
                    @endif
                </div>
                <table class="table table-sm table-borderless mb-0">
                    <tr><td class="text-muted small">Biaya Keterlambatan</td><td class="text-end small">Rp {{ number_format($hariTerlambat * 5000, 0, ',', '.') }}</td></tr>
                    <tr class="fw-bold"><td>Total Denda</td><td class="text-end text-danger">Rp {{ number_format($estimasiDenda, 0, ',', '.') }}</td></tr>
                </table>
                <div class="text-muted" style="font-size:.7rem;">*Denda dihitung ulang berdasarkan tanggal aktual pengembalian</div>
            </div>
        </div>
        <div class="d-grid gap-2">
            <button type="submit" form="formKembali" class="btn btn-primary">
                <i class="bi bi-check-circle me-1"></i> Proses Pengembalian
            </button>
            <a href="{{ route('pengembalian.index') }}" class="btn btn-outline-secondary">Batal</a>
        </div>
    </div>
</div>
@endsection
