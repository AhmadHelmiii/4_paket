<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk Parkir #{{ $transaksi->id_parkir }}</title>
    <style>
        body { font-family: 'Courier New', monospace; font-size: 12px; margin: 0; padding: 20px; color: #333; }
        .center { text-align: center; }
        .header { background: #1e293b; color: white; padding: 15px; text-align: center; border-radius: 8px 8px 0 0; }
        .header h1 { margin: 0; font-size: 18px; }
        .header p { margin: 4px 0 0; font-size: 11px; color: #94a3b8; }
        .body { border: 1px solid #e2e8f0; border-top: none; padding: 15px; border-radius: 0 0 8px 8px; }
        .row { display: flex; justify-content: space-between; padding: 5px 0; border-bottom: 1px dashed #e2e8f0; }
        .row:last-child { border-bottom: none; }
        .label { color: #64748b; }
        .value { font-weight: bold; }
        .total { font-size: 16px; color: #2563eb; }
        .divider { border-top: 1px dashed #e2e8f0; margin: 10px 0; }
        .no-trx { color: #94a3b8; font-size: 11px; text-align: center; padding-bottom: 10px; border-bottom: 1px dashed #e2e8f0; margin-bottom: 10px; }
        .footer { text-align: center; color: #94a3b8; font-size: 10px; margin-top: 10px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Parking Excellence</h1>
        <p>Struk Parkir Resmi</p>
    </div>
    <div class="body">
        <div class="no-trx">No. Transaksi: #{{ str_pad($transaksi->id_parkir, 6, '0', STR_PAD_LEFT) }}</div>

        <div class="row"><span class="label">Plat Nomor</span><span class="value">{{ $transaksi->kendaraan->plat_nomor }}</span></div>
        <div class="row"><span class="label">Jenis Kendaraan</span><span class="value">{{ ucfirst($transaksi->kendaraan->jenis_kendaraan) }}</span></div>
        <div class="row"><span class="label">Area Parkir</span><span class="value">{{ $transaksi->area->nama_area }}</span></div>
        <div class="row"><span class="label">Waktu Masuk</span><span class="value">{{ $transaksi->waktu_masuk->format('d/m/Y H:i') }}</span></div>
        <div class="row"><span class="label">Waktu Keluar</span><span class="value">{{ $transaksi->waktu_keluar?->format('d/m/Y H:i') ?? '-' }}</span></div>
        <div class="row"><span class="label">Durasi</span><span class="value">{{ $transaksi->durasi_jam }} jam</span></div>
        <div class="row"><span class="label">Tarif/Jam</span><span class="value">Rp {{ number_format($transaksi->tarif->tarif_per_jam, 0, ',', '.') }}</span></div>
        <div class="divider"></div>
        <div class="row"><span class="label" style="font-weight:bold">TOTAL BAYAR</span><span class="value total">Rp {{ number_format($transaksi->biaya_total, 0, ',', '.') }}</span></div>

        <div class="footer">
            Petugas: {{ $transaksi->user->nama_lengkap }}<br>
            Dicetak: {{ now()->format('d/m/Y H:i:s') }}<br><br>
            Terima kasih telah menggunakan layanan kami
        </div>
    </div>
</body>
</html>
