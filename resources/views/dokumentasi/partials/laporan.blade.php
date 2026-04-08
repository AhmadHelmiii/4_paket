<div style="display:flex; flex-direction:column; gap:16px; margin-top:16px;">

    <div style="display:grid; grid-template-columns:1fr 1fr 1fr; gap:16px;">

        <div class="card" style="padding:20px; border-top:4px solid #22c55e;">
            <div style="display:flex; align-items:center; gap:10px; margin-bottom:16px;">
                <div style="width:36px; height:36px; background:linear-gradient(135deg,#22c55e,#16a34a); border-radius:10px; display:flex; align-items:center; justify-content:center;">
                    <i class="fa-solid fa-check" style="color:#fff; font-size:15px;"></i>
                </div>
                <p style="font-size:14px; font-weight:700; color:#166534;">Fitur Berjalan</p>
            </div>
            @foreach(['Login & Logout (3 role)','CRUD User','CRUD Tarif Parkir','CRUD Area Parkir','CRUD Kendaraan','Transaksi Masuk & Keluar','Hitung Biaya Otomatis','Cetak Struk PDF','Log Aktivitas User','Rekap Laporan Owner','Search & Filter Data','Dashboard dengan Chart','Middleware Role Access'] as $item)
            <div style="display:flex; align-items:center; gap:8px; padding:6px 0; border-bottom:1px solid #f0fdf4;">
                <i class="fa-solid fa-circle-check" style="color:#22c55e; font-size:12px; flex-shrink:0;"></i>
                <span style="font-size:12.5px; color:#374151;">{{ $item }}</span>
            </div>
            @endforeach
        </div>

        <div class="card" style="padding:20px; border-top:4px solid #ef4444;">
            <div style="display:flex; align-items:center; gap:10px; margin-bottom:16px;">
                <div style="width:36px; height:36px; background:linear-gradient(135deg,#ef4444,#dc2626); border-radius:10px; display:flex; align-items:center; justify-content:center;">
                    <i class="fa-solid fa-bug" style="color:#fff; font-size:15px;"></i>
                </div>
                <p style="font-size:14px; font-weight:700; color:#991b1b;">Bug / Keterbatasan</p>
            </div>
            @foreach(['Cetak PDF butuh install DomPDF via composer','Belum ada notifikasi real-time slot penuh','Belum ada fitur lupa/reset password','Export laporan ke Excel belum tersedia','Belum ada validasi format plat nomor','Tidak ada konfirmasi email saat buat akun'] as $item)
            <div style="display:flex; align-items:flex-start; gap:8px; padding:6px 0; border-bottom:1px solid #fef2f2;">
                <i class="fa-solid fa-circle-xmark" style="color:#ef4444; font-size:12px; flex-shrink:0; margin-top:2px;"></i>
                <span style="font-size:12.5px; color:#374151;">{{ $item }}</span>
            </div>
            @endforeach
        </div>

        <div class="card" style="padding:20px; border-top:4px solid #2563eb;">
            <div style="display:flex; align-items:center; gap:10px; margin-bottom:16px;">
                <div style="width:36px; height:36px; background:linear-gradient(135deg,#2563eb,#1d4ed8); border-radius:10px; display:flex; align-items:center; justify-content:center;">
                    <i class="fa-solid fa-rocket" style="color:#fff; font-size:15px;"></i>
                </div>
                <p style="font-size:14px; font-weight:700; color:#1d4ed8;">Rencana Pengembangan</p>
            </div>
            @foreach(['Notifikasi otomatis slot hampir penuh','Export laporan ke Excel (Laravel Excel)','Scan QR Code untuk kendaraan masuk','Integrasi payment gateway digital','Aplikasi mobile untuk petugas','Backup database otomatis terjadwal','Multi-cabang parkir','Statistik pendapatan bulanan/tahunan'] as $item)
            <div style="display:flex; align-items:center; gap:8px; padding:6px 0; border-bottom:1px solid #eff6ff;">
                <i class="fa-solid fa-circle-arrow-right" style="color:#2563eb; font-size:12px; flex-shrink:0;"></i>
                <span style="font-size:12.5px; color:#374151;">{{ $item }}</span>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Tech Stack --}}
    <div class="card" style="padding:20px;">
        <p style="font-size:14px; font-weight:700; color:#0f172a; margin-bottom:16px;">Tech Stack yang Digunakan</p>
        <div style="display:grid; grid-template-columns:repeat(4,1fr); gap:12px;">
            @foreach([
                ['fa-laravel','Laravel 13','Backend Framework','#ef4444'],
                ['fa-php','PHP 8.3','Server Language','#7c3aed'],
                ['fa-database','MySQL 8','Database','#f59e0b'],
                ['fa-brands fa-html5','Blade + SVG','Frontend Template','#ea580c'],
                ['fa-brands fa-js','Alpine.js','JS Interactivity','#eab308'],
                ['fa-chart-bar','Chart.js','Data Visualization','#2563eb'],
                ['fa-file-pdf','DomPDF','PDF Generator','#dc2626'],
                ['fa-server','Laragon','Dev Environment','#059669'],
            ] as $tech)
            <div style="background:#f8fafc; border-radius:12px; padding:14px; text-align:center; border:1px solid #f1f5f9;">
                <i class="fa-brands {{ $tech[0] }}" style="font-size:24px; color:{{ $tech[3] }}; display:block; margin-bottom:8px;"></i>
                <p style="font-size:13px; font-weight:700; color:#0f172a;">{{ $tech[1] }}</p>
                <p style="font-size:11px; color:#94a3b8; margin-top:2px;">{{ $tech[2] }}</p>
            </div>
            @endforeach
        </div>
    </div>

</div>
