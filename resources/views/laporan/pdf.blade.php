<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Peminjaman Alat</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 11px; color: #1f2937; }
        .header { text-align: center; margin-bottom: 20px; padding-bottom: 12px; border-bottom: 2px solid #4f46e5; }
        .header h1 { font-size: 16px; font-weight: 800; color: #4f46e5; margin-bottom: 2px; }
        .header p { font-size: 10px; color: #6b7280; }
        .meta { display: flex; justify-content: space-between; margin-bottom: 16px; font-size: 10px; color: #6b7280; }
        .summary { display: flex; gap: 12px; margin-bottom: 16px; }
        .summary-box { flex: 1; background: #f3f4f6; border-radius: 6px; padding: 10px 12px; }
        .summary-box .label { font-size: 9px; color: #9ca3af; text-transform: uppercase; letter-spacing: .05em; }
        .summary-box .value { font-size: 18px; font-weight: 800; color: #111827; margin-top: 2px; }
        table { width: 100%; border-collapse: collapse; font-size: 10px; }
        thead tr { background: #4f46e5; color: #fff; }
        thead th { padding: 7px 8px; text-align: left; font-weight: 700; font-size: 9px; text-transform: uppercase; letter-spacing: .04em; }
        tbody tr:nth-child(even) { background: #f9fafb; }
        tbody tr { border-bottom: 1px solid #e5e7eb; }
        tbody td { padding: 6px 8px; }
        .badge { display: inline-block; padding: 2px 7px; border-radius: 99px; font-size: 9px; font-weight: 700; }
        .badge-menunggu    { background: #fffbeb; color: #92400e; }
        .badge-dipinjam    { background: #ecfdf5; color: #065f46; }
        .badge-dikembalikan{ background: #eef2ff; color: #3730a3; }
        .badge-ditolak     { background: #fef2f2; color: #991b1b; }
        .denda-red { color: #dc2626; font-weight: 700; }
        .footer { margin-top: 20px; text-align: right; font-size: 9px; color: #9ca3af; }
        .ttd-area { margin-top: 30px; display: flex; justify-content: flex-end; }
        .ttd-box { text-align: center; font-size: 10px; }
        .ttd-box .ttd-line { margin-top: 50px; border-top: 1px solid #374151; padding-top: 4px; width: 160px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN PEMINJAMAN ALAT</h1>
        <p>Aplikasi Peminjaman Alat — Sistem Manajemen Inventaris</p>
    </div>

    <div class="meta">
        <span>Periode: {{ $tglMulai }} s/d {{ $tglSelesai }}</span>
        <span>Dicetak: {{ now()->format('d M Y, H:i') }}</span>
    </div>

    <div class="summary">
        <div class="summary-box">
            <div class="label">Total Transaksi</div>
            <div class="value">{{ $peminjamans->count() }}</div>
        </div>
        <div class="summary-box">
            <div class="label">Sedang Dipinjam</div>
            <div class="value">{{ $totalAktif }}</div>
        </div>
        <div class="summary-box">
            <div class="label">Total Denda</div>
            <div class="value" style="font-size:13px;">Rp {{ number_format($totalDenda,0,',','.') }}</div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Kode Pinjam</th>
                <th>Peminjam</th>
                <th>Alat</th>
                <th>Tgl Pinjam</th>
                <th>Tgl Kembali Rencana</th>
                <th>Tgl Kembali Aktual</th>
                <th>Status</th>
                <th>Hari Terlambat</th>
                <th>Denda</th>
            </tr>
        </thead>
        <tbody>
            @forelse($peminjamans as $i => $p)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td style="font-weight:700;color:#4f46e5;">{{ $p->kode_pinjam }}</td>
                <td>{{ $p->peminjam->name }}</td>
                <td>{{ $p->details->count() }} alat</td>
                <td>{{ $p->tgl_pinjam?->format('d/m/Y') ?? '-' }}</td>
                <td>{{ $p->tgl_kembali_rencana?->format('d/m/Y') }}</td>
                <td>{{ $p->pengembalian?->tgl_kembali_aktual?->format('d/m/Y') ?? '-' }}</td>
                <td><span class="badge badge-{{ $p->status }}">{{ ucfirst($p->status) }}</span></td>
                <td style="text-align:center;">{{ $p->pengembalian?->hari_terlambat ?? '-' }}</td>
                <td class="{{ ($p->pengembalian?->denda ?? 0) > 0 ? 'denda-red' : '' }}">
                    {{ $p->pengembalian ? 'Rp '.number_format($p->pengembalian->denda,0,',','.') : '-' }}
                </td>
            </tr>
            @empty
            <tr><td colspan="10" style="text-align:center;padding:20px;color:#9ca3af;">Tidak ada data</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="ttd-area">
        <div class="ttd-box">
            <div>Petugas / Admin</div>
            <div class="ttd-line">( ........................... )</div>
        </div>
    </div>

    <div class="footer">Dokumen ini digenerate otomatis oleh Sistem Peminjaman Alat</div>
</body>
</html>
