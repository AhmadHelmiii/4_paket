@extends('layouts.app')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Selamat datang, ' . Auth::user()->nama_lengkap)

@section('content')
<div style="display:flex; flex-direction:column; gap:20px;">

    {{-- Stat Cards --}}
    <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:16px;">

        <div class="stat-card" style="position:relative; overflow:hidden;">
            <div style="position:absolute; top:-10px; right:-10px; width:80px; height:80px; background:linear-gradient(135deg,#dbeafe,#bfdbfe); border-radius:50%; opacity:0.6;"></div>
            <div style="display:flex; align-items:flex-start; justify-content:space-between; margin-bottom:14px;">
                <div style="width:42px; height:42px; background:linear-gradient(135deg,#2563eb,#1d4ed8); border-radius:12px; display:flex; align-items:center; justify-content:center; box-shadow:0 4px 12px rgba(37,99,235,0.3);">
                    <i class="fa-solid fa-car" style="color:#fff; font-size:17px;"></i>
                </div>
            </div>
            <p style="font-size:30px; font-weight:800; color:#0f172a; line-height:1;">{{ number_format($kendaraanAktif) }}</p>
            <p style="font-size:13px; font-weight:600; color:#475569; margin-top:4px;">Kendaraan Aktif</p>
            <p style="font-size:11.5px; color:#94a3b8; margin-top:2px;">Sedang parkir saat ini</p>
        </div>

        <div class="stat-card" style="position:relative; overflow:hidden;">
            <div style="position:absolute; top:-10px; right:-10px; width:80px; height:80px; background:linear-gradient(135deg,#d1fae5,#a7f3d0); border-radius:50%; opacity:0.6;"></div>
            <div style="display:flex; align-items:flex-start; justify-content:space-between; margin-bottom:14px;">
                <div style="width:42px; height:42px; background:linear-gradient(135deg,#059669,#047857); border-radius:12px; display:flex; align-items:center; justify-content:center; box-shadow:0 4px 12px rgba(5,150,105,0.3);">
                    <i class="fa-solid fa-right-left" style="color:#fff; font-size:17px;"></i>
                </div>
            </div>
            <p style="font-size:30px; font-weight:800; color:#0f172a; line-height:1;">{{ number_format($totalMasukHariIni) }}</p>
            <p style="font-size:13px; font-weight:600; color:#475569; margin-top:4px;">Transaksi Hari Ini</p>
            <p style="font-size:11.5px; color:#94a3b8; margin-top:2px;">Total kendaraan masuk</p>
        </div>

        <div class="stat-card" style="position:relative; overflow:hidden;">
            <div style="position:absolute; top:-10px; right:-10px; width:80px; height:80px; background:linear-gradient(135deg,#fef3c7,#fde68a); border-radius:50%; opacity:0.6;"></div>
            <div style="display:flex; align-items:flex-start; justify-content:space-between; margin-bottom:14px;">
                <div style="width:42px; height:42px; background:linear-gradient(135deg,#d97706,#b45309); border-radius:12px; display:flex; align-items:center; justify-content:center; box-shadow:0 4px 12px rgba(217,119,6,0.3);">
                    <i class="fa-solid fa-money-bill-wave" style="color:#fff; font-size:17px;"></i>
                </div>
            </div>
            <p style="font-size:22px; font-weight:800; color:#0f172a; line-height:1;">Rp {{ number_format($pendapatanHariIni,0,',','.') }}</p>
            <p style="font-size:13px; font-weight:600; color:#475569; margin-top:4px;">Pendapatan Hari Ini</p>
            <p style="font-size:11.5px; color:#94a3b8; margin-top:2px;">Dari transaksi selesai</p>
        </div>
    </div>

    {{-- Chart + Area --}}
    <div style="display:grid; grid-template-columns:2fr 1fr; gap:16px;">

        <div class="card" style="padding:20px;">
            <div style="margin-bottom:16px;">
                <p style="font-size:14px; font-weight:700; color:#0f172a;">Aktivitas Parkir</p>
                <p style="font-size:12px; color:#94a3b8; margin-top:2px;">Kendaraan masuk per jam hari ini</p>
            </div>
            <canvas id="parkingChart" height="90"></canvas>
        </div>

        <div class="card" style="padding:20px;">
            <p style="font-size:14px; font-weight:700; color:#0f172a; margin-bottom:16px;">Status Area Parkir</p>
            <div style="display:flex; flex-direction:column; gap:16px;">
                @forelse($areas as $area)
                <div>
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:6px;">
                        <span style="font-size:13px; font-weight:600; color:#334155;">{{ $area->nama_area }}</span>
                        <span style="font-size:11.5px; color:#64748b; background:#f1f5f9; padding:2px 8px; border-radius:99px;">{{ $area->terisi }}/{{ $area->kapasitas }}</span>
                    </div>
                    <div style="width:100%; background:#f1f5f9; border-radius:99px; height:7px; overflow:hidden;">
                        <div style="height:7px; border-radius:99px; transition:width 0.5s;
                            background: {{ $area->persentaseTerisi() >= 90 ? 'linear-gradient(90deg,#ef4444,#dc2626)' : ($area->persentaseTerisi() >= 70 ? 'linear-gradient(90deg,#f59e0b,#d97706)' : 'linear-gradient(90deg,#2563eb,#1d4ed8)') }};
                            width: {{ $area->persentaseTerisi() }}%;"></div>
                    </div>
                    <p style="font-size:11px; color:#94a3b8; margin-top:4px;">{{ $area->persentaseTerisi() }}% terisi &bull; Sisa {{ $area->sisaSlot() }} slot</p>
                </div>
                @empty
                <p style="font-size:13px; color:#94a3b8; text-align:center; padding:20px 0;">Belum ada area parkir</p>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Recent Transactions --}}
    <div class="card" style="overflow:hidden;">
        <div style="padding:16px 20px; border-bottom:1px solid #f1f5f9; display:flex; align-items:center; justify-content:space-between;">
            <div>
                <p style="font-size:14px; font-weight:700; color:#0f172a;">Transaksi Terbaru</p>
                <p style="font-size:12px; color:#94a3b8; margin-top:1px;">5 transaksi terakhir</p>
            </div>
            @if(Auth::user()->isPetugas())
            <a href="{{ route('petugas.transaksi.index') }}" style="font-size:12.5px; color:#2563eb; font-weight:600; text-decoration:none;">Lihat semua →</a>
            @endif
        </div>
        <table style="width:100%; border-collapse:collapse;">
            <thead>
                <tr style="background:#f8fafc;">
                    <th style="padding:10px 20px; text-align:left; font-size:11px; font-weight:700; color:#64748b; text-transform:uppercase; letter-spacing:0.05em;">Plat Nomor</th>
                    <th style="padding:10px 20px; text-align:left; font-size:11px; font-weight:700; color:#64748b; text-transform:uppercase; letter-spacing:0.05em;">Jenis</th>
                    <th style="padding:10px 20px; text-align:left; font-size:11px; font-weight:700; color:#64748b; text-transform:uppercase; letter-spacing:0.05em;">Area</th>
                    <th style="padding:10px 20px; text-align:left; font-size:11px; font-weight:700; color:#64748b; text-transform:uppercase; letter-spacing:0.05em;">Waktu Masuk</th>
                    <th style="padding:10px 20px; text-align:left; font-size:11px; font-weight:700; color:#64748b; text-transform:uppercase; letter-spacing:0.05em;">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transaksiTerbaru as $t)
                <tr class="table-row" style="border-top:1px solid #f8fafc;">
                    <td style="padding:13px 20px; font-size:13.5px; font-weight:700; color:#0f172a;">{{ $t->kendaraan->plat_nomor }}</td>
                    <td style="padding:13px 20px; font-size:13px; color:#475569; text-transform:capitalize;">{{ $t->kendaraan->jenis_kendaraan }}</td>
                    <td style="padding:13px 20px; font-size:13px; color:#475569;">{{ $t->area->nama_area }}</td>
                    <td style="padding:13px 20px; font-size:13px; color:#475569;">{{ $t->waktu_masuk->format('H:i') }}</td>
                    <td style="padding:13px 20px;">
                        @if($t->status === 'masuk')
                        <span class="badge" style="background:#dcfce7; color:#166534;"><span style="width:6px;height:6px;border-radius:50%;background:#22c55e;display:inline-block;margin-right:5px;"></span>Masuk</span>
                        @else
                        <span class="badge" style="background:#f1f5f9; color:#475569;"><span style="width:6px;height:6px;border-radius:50%;background:#94a3b8;display:inline-block;margin-right:5px;"></span>Selesai</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" style="padding:40px; text-align:center; color:#94a3b8; font-size:13px;">Belum ada transaksi hari ini</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
const ctx = document.getElementById('parkingChart').getContext('2d');
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: {!! json_encode($chartData['labels']) !!},
        datasets: [{
            data: {!! json_encode($chartData['data']) !!},
            backgroundColor: (ctx) => {
                const g = ctx.chart.ctx.createLinearGradient(0, 0, 0, 200);
                g.addColorStop(0, 'rgba(37,99,235,0.7)');
                g.addColorStop(1, 'rgba(37,99,235,0.05)');
                return g;
            },
            borderColor: '#2563eb',
            borderWidth: 2,
            borderRadius: 6,
            borderSkipped: false,
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false }, tooltip: { callbacks: { label: (c) => ` ${c.raw} kendaraan` } } },
        scales: {
            y: { beginAtZero: true, ticks: { stepSize: 1, font: { size: 11 }, color: '#94a3b8' }, grid: { color: 'rgba(0,0,0,0.04)', drawBorder: false } },
            x: { ticks: { font: { size: 10 }, color: '#94a3b8', maxRotation: 0 }, grid: { display: false } }
        }
    }
});
</script>
@endsection
