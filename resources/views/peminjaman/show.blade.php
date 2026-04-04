@extends('layouts.app')
@section('title', 'Detail Peminjaman')
@section('content')

<div class="page-header">
    <div class="page-header-left">
        <div class="breadcrumb-text">Peminjaman › Detail</div>
        <h2>{{ $peminjaman->kode_pinjam }}</h2>
    </div>
    <a href="{{ route('peminjaman.index') }}" class="btn btn-outline">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="row g-3">
    {{-- Kolom kiri: detail --}}
    <div class="col-md-8">
        <div class="card mb-3">
            <div class="card-header">
                <span class="card-header-title">Detail Peminjaman</span>
                <span class="badge badge-{{ $peminjaman->status }}" style="padding:.35rem .85rem;">
                    {{ ucfirst($peminjaman->status) }}
                </span>
            </div>
            <div class="card-body">
                <div class="row g-3 mb-3">
                    <div class="col-md-4">
                        <div style="font-size:.75rem;color:var(--gray-400);font-weight:600;text-transform:uppercase;letter-spacing:.05em;">Peminjam</div>
                        <div style="font-weight:700;margin-top:.2rem;">{{ $peminjaman->peminjam->name }}</div>
                    </div>
                    <div class="col-md-4">
                        <div style="font-size:.75rem;color:var(--gray-400);font-weight:600;text-transform:uppercase;letter-spacing:.05em;">Tanggal Pinjam</div>
                        <div style="font-weight:700;margin-top:.2rem;">{{ $peminjaman->tgl_pinjam?->format('d M Y') ?? '-' }}</div>
                    </div>
                    <div class="col-md-4">
                        <div style="font-size:.75rem;color:var(--gray-400);font-weight:600;text-transform:uppercase;letter-spacing:.05em;">Tgl Kembali Rencana</div>
                        <div style="font-weight:700;margin-top:.2rem;">{{ $peminjaman->tgl_kembali_rencana?->format('d M Y') }}</div>
                    </div>
                </div>

                @if($peminjaman->catatan)
                <div style="background:var(--gray-50);border-radius:8px;padding:.75rem 1rem;font-size:.85rem;color:var(--gray-600);margin-bottom:1rem;">
                    <span style="font-weight:600;">Catatan:</span> {{ $peminjaman->catatan }}
                </div>
                @endif

                <div style="font-size:.8rem;font-weight:700;color:var(--gray-700);margin-bottom:.6rem;">Daftar Alat yang Dipinjam</div>
                <div class="table-wrap">
                    <table class="data-table">
                        <thead><tr><th>Alat</th><th>Kode</th><th>Jumlah</th><th>Kondisi Akhir</th></tr></thead>
                        <tbody>
                            @foreach($peminjaman->details as $d)
                            <tr>
                                <td style="font-weight:600;">{{ $d->alat->nama_alat }}</td>
                                <td style="color:var(--primary);font-weight:600;">{{ $d->alat->kode_alat }}</td>
                                <td>{{ $d->jumlah }}</td>
                                <td>
                                    @if($d->kondisi_akhir)
                                    @php $kc = ['baik'=>'badge-available','rusak ringan'=>'badge-menunggu','rusak berat'=>'badge-ditolak'][$d->kondisi_akhir] ?? 'badge-kategori'; @endphp
                                    <span class="badge {{ $kc }}">{{ ucfirst($d->kondisi_akhir) }}</span>
                                    @else
                                    <span class="td-muted">-</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Data pengembalian jika sudah dikembalikan --}}
        @if($peminjaman->pengembalian)
        <div class="card">
            <div class="card-header">
                <span class="card-header-title">Data Pengembalian</span>
                <span class="badge badge-dikembalikan">Selesai</span>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <div style="font-size:.75rem;color:var(--gray-400);font-weight:600;text-transform:uppercase;letter-spacing:.05em;">Tgl Kembali Aktual</div>
                        <div style="font-weight:700;margin-top:.2rem;">{{ $peminjaman->pengembalian->tgl_kembali_aktual->format('d M Y') }}</div>
                    </div>
                    <div class="col-md-4">
                        <div style="font-size:.75rem;color:var(--gray-400);font-weight:600;text-transform:uppercase;letter-spacing:.05em;">Hari Terlambat</div>
                        <div style="font-weight:700;margin-top:.2rem;">
                            @if($peminjaman->pengembalian->hari_terlambat > 0)
                            <span style="color:var(--danger);">{{ $peminjaman->pengembalian->hari_terlambat }} hari</span>
                            @else
                            <span style="color:var(--success);">Tepat waktu</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div style="font-size:.75rem;color:var(--gray-400);font-weight:600;text-transform:uppercase;letter-spacing:.05em;">Denda</div>
                        <div style="font-weight:800;font-size:1.1rem;margin-top:.2rem;color:{{ $peminjaman->pengembalian->denda > 0 ? 'var(--danger)' : 'var(--success)' }};">
                            Rp {{ number_format($peminjaman->pengembalian->denda, 0, ',', '.') }}
                        </div>
                    </div>
                </div>
                @if($peminjaman->pengembalian->keterangan)
                <div style="background:var(--gray-50);border-radius:8px;padding:.75rem 1rem;font-size:.85rem;color:var(--gray-600);margin-top:1rem;">
                    <span style="font-weight:600;">Keterangan:</span> {{ $peminjaman->pengembalian->keterangan }}
                </div>
                @endif
            </div>
        </div>
        @endif
    </div>

    {{-- Kolom kanan: aksi --}}
    <div class="col-md-4">

        {{-- PETUGAS/ADMIN: Setujui atau tolak --}}
        @if((auth()->user()->isPetugas() || auth()->user()->isAdmin()) && $peminjaman->status === 'menunggu')
        <div class="card mb-3">
            <div class="card-header"><span class="card-header-title">Proses Persetujuan</span></div>
            <div class="card-body">
                <form method="POST" action="{{ route('peminjaman.aksi', $peminjaman) }}">
                    @csrf
                    <div class="field-group">
                        <label class="field-label">Catatan Petugas</label>
                        <textarea name="catatan_petugas" class="field-textarea" rows="3" placeholder="Opsional..."></textarea>
                    </div>
                    <div class="d-flex flex-column gap-2 mt-2">
                        <button type="submit" name="aksi" value="setujui" class="btn btn-success">
                            <i class="bi bi-check-lg"></i> Setujui Peminjaman
                        </button>
                        <button type="submit" name="aksi" value="tolak" class="btn btn-outline-danger"
                            onclick="return confirm('Yakin ingin menolak?')">
                            <i class="bi bi-x-lg"></i> Tolak Peminjaman
                        </button>
                    </div>
                </form>
            </div>
        </div>
        @endif

        {{-- PETUGAS/ADMIN: Proses pengembalian --}}
        @if((auth()->user()->isPetugas() || auth()->user()->isAdmin()) && in_array($peminjaman->status, ['dipinjam', 'menunggu_konfirmasi']))
        <div class="card mb-3">
            <div class="card-header">
                <span class="card-header-title">Proses Pengembalian</span>
                @if($peminjaman->status === 'menunggu_konfirmasi')
                <span class="badge badge-menunggu_konfirmasi">Peminjam sudah konfirmasi</span>
                @endif
            </div>
            <div class="card-body">
                @if($peminjaman->catatan_kembali)
                <div style="background:#eff6ff;border-radius:8px;padding:.65rem .9rem;font-size:.825rem;color:#1e40af;margin-bottom:1rem;">
                    <i class="bi bi-chat-left-text me-1"></i>
                    <span style="font-weight:600;">Catatan peminjam:</span> {{ $peminjaman->catatan_kembali }}
                </div>
                @endif
                <a href="{{ route('pengembalian.show', $peminjaman) }}" class="btn btn-primary" style="width:100%;">
                    <i class="bi bi-arrow-return-left"></i> Proses Pengembalian
                </a>
            </div>
        </div>
        @endif

        {{-- PEMINJAM: Konfirmasi sudah mengembalikan --}}
        @if(auth()->user()->isPeminjam() && $peminjaman->status === 'dipinjam')
        <div class="card mb-3" style="border-color:#fbbf24;">
            <div class="card-header" style="background:#fffbeb;">
                <span class="card-header-title" style="color:#92400e;">
                    <i class="bi bi-info-circle me-1"></i> Sudah Mengembalikan?
                </span>
            </div>
            <div class="card-body">
                <p style="font-size:.85rem;color:var(--gray-600);margin-bottom:1rem;">
                    Jika kamu sudah mengembalikan alat ke petugas, klik tombol di bawah untuk memberitahu petugas agar segera diproses.
                </p>
                <form method="POST" action="{{ route('peminjaman.konfirmasi', $peminjaman) }}">
                    @csrf
                    <div class="field-group">
                        <label class="field-label">Catatan (opsional)</label>
                        <textarea name="catatan_kembali" class="field-textarea" rows="2" placeholder="Kondisi alat, keterangan, dll..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" style="width:100%;"
                        onclick="return confirm('Konfirmasi bahwa kamu sudah mengembalikan alat ke petugas?')">
                        <i class="bi bi-check-circle"></i> Konfirmasi Sudah Dikembalikan
                    </button>
                </form>
            </div>
        </div>
        @endif

        {{-- PEMINJAM: Sudah konfirmasi, menunggu petugas --}}
        @if(auth()->user()->isPeminjam() && $peminjaman->status === 'menunggu_konfirmasi')
        <div class="card mb-3" style="border-color:#a5b4fc;">
            <div class="card-header" style="background:#eef2ff;">
                <span class="card-header-title" style="color:var(--primary);">
                    <i class="bi bi-hourglass-split me-1"></i> Menunggu Konfirmasi Petugas
                </span>
            </div>
            <div class="card-body">
                <p style="font-size:.85rem;color:var(--gray-600);margin:0;">
                    Kamu sudah mengkonfirmasi pengembalian. Petugas sedang memproses dan memverifikasi kondisi alat.
                </p>
                @if($peminjaman->catatan_kembali)
                <div style="margin-top:.75rem;background:var(--gray-50);border-radius:8px;padding:.65rem .9rem;font-size:.825rem;color:var(--gray-600);">
                    <span style="font-weight:600;">Catatan kamu:</span> {{ $peminjaman->catatan_kembali }}
                </div>
                @endif
            </div>
        </div>
        @endif

        {{-- Info petugas --}}
        <div class="card">
            <div class="card-header"><span class="card-header-title">Info Petugas</span></div>
            <div class="card-body">
                <div style="font-size:.75rem;color:var(--gray-400);font-weight:600;text-transform:uppercase;letter-spacing:.05em;">Diproses oleh</div>
                <div style="font-weight:700;margin-top:.3rem;">{{ $peminjaman->petugas?->name ?? 'Belum diproses' }}</div>
                @if($peminjaman->catatan_petugas)
                <div style="margin-top:.75rem;font-size:.85rem;color:var(--gray-600);">
                    <span style="font-weight:600;">Catatan:</span> {{ $peminjaman->catatan_petugas }}
                </div>
                @endif
            </div>
        </div>

    </div>
</div>
@endsection
