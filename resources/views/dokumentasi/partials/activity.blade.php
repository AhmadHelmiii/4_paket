<div style="display:flex; flex-direction:column; gap:16px;">
    <div class="card" style="padding:24px;">
        <h2 style="font-size:15px; font-weight:700; color:#0f172a; margin-bottom:4px;">Activity Diagram</h2>
        <p style="font-size:12px; color:#94a3b8; margin-bottom:20px;">Alur aktivitas sistem dari sudut pandang proses bisnis</p>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">

        {{-- Activity: Login --}}
        <div>
            <p style="font-size:13px; font-weight:700; color:#2563eb; margin-bottom:12px; text-align:center;">Activity: Login</p>
            <svg width="100%" viewBox="0 0 260 600" xmlns="http://www.w3.org/2000/svg" style="font-family:Inter,sans-serif;">
                <defs><marker id="ac1" markerWidth="7" markerHeight="7" refX="5" refY="3" orient="auto"><path d="M0,0 L0,6 L7,3 z" fill="#475569"/></marker></defs>

                <!-- Swimlane headers -->
                <rect x="0" y="0" width="130" height="30" fill="#eff6ff" rx="0"/>
                <rect x="130" y="0" width="130" height="30" fill="#f0fdf4" rx="0"/>
                <text x="65" y="20" text-anchor="middle" fill="#2563eb" font-size="11" font-weight="700">User</text>
                <text x="195" y="20" text-anchor="middle" fill="#059669" font-size="11" font-weight="700">Sistem</text>
                <line x1="130" y1="0" x2="130" y2="600" stroke="#e2e8f0" stroke-width="1" stroke-dasharray="4,3"/>

                <!-- Start -->
                <circle cx="65" cy="60" r="14" fill="#0f172a"/>
                <line x1="65" y1="74" x2="65" y2="94" stroke="#475569" stroke-width="1.5" marker-end="url(#ac1)"/>

                <!-- Buka halaman login -->
                <rect x="10" y="94" width="110" height="34" rx="17" fill="#eff6ff" stroke="#2563eb" stroke-width="1.5"/>
                <text x="65" y="116" text-anchor="middle" fill="#1d4ed8" font-size="11" font-weight="600">Buka Halaman Login</text>
                <line x1="65" y1="128" x2="65" y2="148" stroke="#475569" stroke-width="1.5" marker-end="url(#ac1)"/>

                <!-- Input -->
                <rect x="10" y="148" width="110" height="34" rx="17" fill="#eff6ff" stroke="#2563eb" stroke-width="1.5"/>
                <text x="65" y="163" text-anchor="middle" fill="#1d4ed8" font-size="11" font-weight="600">Input Username</text>
                <text x="65" y="177" text-anchor="middle" fill="#1d4ed8" font-size="11" font-weight="600">&amp; Password</text>
                <line x1="65" y1="182" x2="65" y2="202" stroke="#475569" stroke-width="1.5" marker-end="url(#ac1)"/>

                <!-- Klik login -->
                <rect x="10" y="202" width="110" height="34" rx="17" fill="#eff6ff" stroke="#2563eb" stroke-width="1.5"/>
                <text x="65" y="224" text-anchor="middle" fill="#1d4ed8" font-size="11" font-weight="600">Klik Masuk</text>
                <!-- Arrow to system -->
                <line x1="120" y1="219" x2="140" y2="219" stroke="#475569" stroke-width="1.5" marker-end="url(#ac1)"/>

                <!-- Validasi -->
                <rect x="140" y="202" width="110" height="34" rx="17" fill="#f0fdf4" stroke="#059669" stroke-width="1.5"/>
                <text x="195" y="224" text-anchor="middle" fill="#166534" font-size="11" font-weight="600">Validasi Data</text>
                <line x1="195" y1="236" x2="195" y2="256" stroke="#475569" stroke-width="1.5" marker-end="url(#ac1)"/>

                <!-- Decision -->
                <polygon points="195,256 240,280 195,304 150,280" fill="#fef3c7" stroke="#d97706" stroke-width="1.5"/>
                <text x="195" y="284" text-anchor="middle" fill="#92400e" font-size="10" font-weight="600">Valid?</text>

                <!-- Yes -->
                <line x1="195" y1="304" x2="195" y2="324" stroke="#475569" stroke-width="1.5" marker-end="url(#ac1)"/>
                <text x="201" y="318" fill="#059669" font-size="9" font-weight="700">Ya</text>

                <!-- Buat session -->
                <rect x="140" y="324" width="110" height="34" rx="17" fill="#f0fdf4" stroke="#059669" stroke-width="1.5"/>
                <text x="195" y="346" text-anchor="middle" fill="#166534" font-size="11" font-weight="600">Buat Session</text>
                <line x1="195" y1="358" x2="195" y2="378" stroke="#475569" stroke-width="1.5" marker-end="url(#ac1)"/>

                <!-- Log -->
                <rect x="140" y="378" width="110" height="34" rx="17" fill="#f0fdf4" stroke="#059669" stroke-width="1.5"/>
                <text x="195" y="400" text-anchor="middle" fill="#166534" font-size="11" font-weight="600">Catat Log Login</text>
                <line x1="195" y1="412" x2="195" y2="432" stroke="#475569" stroke-width="1.5" marker-end="url(#ac1)"/>

                <!-- Redirect -->
                <rect x="140" y="432" width="110" height="34" rx="17" fill="#f0fdf4" stroke="#059669" stroke-width="1.5"/>
                <text x="195" y="454" text-anchor="middle" fill="#166534" font-size="11" font-weight="600">Redirect Dashboard</text>
                <line x1="140" y1="449" x2="120" y2="449" stroke="#475569" stroke-width="1.5" marker-end="url(#ac1)"/>

                <!-- Tampil dashboard -->
                <rect x="10" y="432" width="110" height="34" rx="17" fill="#eff6ff" stroke="#2563eb" stroke-width="1.5"/>
                <text x="65" y="454" text-anchor="middle" fill="#1d4ed8" font-size="11" font-weight="600">Tampil Dashboard</text>
                <line x1="65" y1="466" x2="65" y2="486" stroke="#475569" stroke-width="1.5" marker-end="url(#ac1)"/>

                <!-- No branch: error -->
                <line x1="150" y1="280" x2="130" y2="280" stroke="#ef4444" stroke-width="1.5"/>
                <line x1="130" y1="280" x2="130" y2="510" stroke="#ef4444" stroke-width="1.5"/>
                <text x="134" y="274" fill="#ef4444" font-size="9" font-weight="700">Tidak</text>
                <rect x="10" y="496" width="110" height="34" rx="17" fill="#fef2f2" stroke="#ef4444" stroke-width="1.5"/>
                <text x="65" y="518" text-anchor="middle" fill="#dc2626" font-size="11" font-weight="600">Tampil Pesan Error</text>
                <line x1="130" y1="510" x2="120" y2="510" stroke="#ef4444" stroke-width="1.5" marker-end="url(#ac1)"/>

                <!-- End -->
                <circle cx="65" cy="560" r="10" fill="#0f172a"/>
                <circle cx="65" cy="560" r="14" fill="none" stroke="#0f172a" stroke-width="2"/>
                <line x1="65" y1="530" x2="65" y2="546" stroke="#475569" stroke-width="1.5" marker-end="url(#ac1)"/>
            </svg>
        </div>

        {{-- Activity: Transaksi --}}
        <div>
            <p style="font-size:13px; font-weight:700; color:#059669; margin-bottom:12px; text-align:center;">Activity: Transaksi Parkir</p>
            <svg width="100%" viewBox="0 0 260 640" xmlns="http://www.w3.org/2000/svg" style="font-family:Inter,sans-serif;">
                <defs><marker id="ac2" markerWidth="7" markerHeight="7" refX="5" refY="3" orient="auto"><path d="M0,0 L0,6 L7,3 z" fill="#475569"/></marker></defs>

                <rect x="0" y="0" width="130" height="30" fill="#f0fdf4" rx="0"/>
                <rect x="130" y="0" width="130" height="30" fill="#eff6ff" rx="0"/>
                <text x="65" y="20" text-anchor="middle" fill="#059669" font-size="11" font-weight="700">Petugas</text>
                <text x="195" y="20" text-anchor="middle" fill="#2563eb" font-size="11" font-weight="700">Sistem</text>
                <line x1="130" y1="0" x2="130" y2="640" stroke="#e2e8f0" stroke-width="1" stroke-dasharray="4,3"/>

                <circle cx="65" cy="60" r="14" fill="#0f172a"/>
                <line x1="65" y1="74" x2="65" y2="94" stroke="#475569" stroke-width="1.5" marker-end="url(#ac2)"/>

                <rect x="10" y="94" width="110" height="34" rx="17" fill="#f0fdf4" stroke="#059669" stroke-width="1.5"/>
                <text x="65" y="116" text-anchor="middle" fill="#166534" font-size="11" font-weight="600">Input Data Kendaraan</text>
                <line x1="65" y1="128" x2="65" y2="148" stroke="#475569" stroke-width="1.5" marker-end="url(#ac2)"/>

                <rect x="10" y="148" width="110" height="34" rx="17" fill="#f0fdf4" stroke="#059669" stroke-width="1.5"/>
                <text x="65" y="170" text-anchor="middle" fill="#166534" font-size="11" font-weight="600">Pilih Area Parkir</text>
                <line x1="120" y1="165" x2="140" y2="165" stroke="#475569" stroke-width="1.5" marker-end="url(#ac2)"/>

                <rect x="140" y="148" width="110" height="34" rx="17" fill="#eff6ff" stroke="#2563eb" stroke-width="1.5"/>
                <text x="195" y="170" text-anchor="middle" fill="#1d4ed8" font-size="11" font-weight="600">Cek Slot Tersedia</text>
                <line x1="195" y1="182" x2="195" y2="202" stroke="#475569" stroke-width="1.5" marker-end="url(#ac2)"/>

                <rect x="140" y="202" width="110" height="34" rx="17" fill="#eff6ff" stroke="#2563eb" stroke-width="1.5"/>
                <text x="195" y="224" text-anchor="middle" fill="#1d4ed8" font-size="11" font-weight="600">Ambil Tarif Kendaraan</text>
                <line x1="195" y1="236" x2="195" y2="256" stroke="#475569" stroke-width="1.5" marker-end="url(#ac2)"/>

                <rect x="140" y="256" width="110" height="34" rx="17" fill="#eff6ff" stroke="#2563eb" stroke-width="1.5"/>
                <text x="195" y="278" text-anchor="middle" fill="#1d4ed8" font-size="11" font-weight="600">Simpan Transaksi</text>
                <line x1="195" y1="290" x2="195" y2="310" stroke="#475569" stroke-width="1.5" marker-end="url(#ac2)"/>

                <rect x="140" y="310" width="110" height="34" rx="17" fill="#eff6ff" stroke="#2563eb" stroke-width="1.5"/>
                <text x="195" y="332" text-anchor="middle" fill="#1d4ed8" font-size="11" font-weight="600">Update Slot Area</text>
                <line x1="140" y1="327" x2="120" y2="327" stroke="#475569" stroke-width="1.5" marker-end="url(#ac2)"/>

                <rect x="10" y="310" width="110" height="34" rx="17" fill="#f0fdf4" stroke="#059669" stroke-width="1.5"/>
                <text x="65" y="332" text-anchor="middle" fill="#166534" font-size="11" font-weight="600">Konfirmasi Masuk</text>
                <line x1="65" y1="344" x2="65" y2="364" stroke="#475569" stroke-width="1.5" marker-end="url(#ac2)"/>

                <!-- Keluar -->
                <rect x="10" y="364" width="110" height="34" rx="17" fill="#f0fdf4" stroke="#059669" stroke-width="1.5"/>
                <text x="65" y="386" text-anchor="middle" fill="#166534" font-size="11" font-weight="600">Input Plat Keluar</text>
                <line x1="120" y1="381" x2="140" y2="381" stroke="#475569" stroke-width="1.5" marker-end="url(#ac2)"/>

                <rect x="140" y="364" width="110" height="34" rx="17" fill="#eff6ff" stroke="#2563eb" stroke-width="1.5"/>
                <text x="195" y="386" text-anchor="middle" fill="#1d4ed8" font-size="11" font-weight="600">Hitung Durasi & Biaya</text>
                <line x1="195" y1="398" x2="195" y2="418" stroke="#475569" stroke-width="1.5" marker-end="url(#ac2)"/>

                <rect x="140" y="418" width="110" height="34" rx="17" fill="#eff6ff" stroke="#2563eb" stroke-width="1.5"/>
                <text x="195" y="440" text-anchor="middle" fill="#1d4ed8" font-size="11" font-weight="600">Update Transaksi</text>
                <line x1="195" y1="452" x2="195" y2="472" stroke="#475569" stroke-width="1.5" marker-end="url(#ac2)"/>

                <rect x="140" y="472" width="110" height="34" rx="17" fill="#eff6ff" stroke="#2563eb" stroke-width="1.5"/>
                <text x="195" y="494" text-anchor="middle" fill="#1d4ed8" font-size="11" font-weight="600">Generate Struk PDF</text>
                <line x1="140" y1="489" x2="120" y2="489" stroke="#475569" stroke-width="1.5" marker-end="url(#ac2)"/>

                <rect x="10" y="472" width="110" height="34" rx="17" fill="#f0fdf4" stroke="#059669" stroke-width="1.5"/>
                <text x="65" y="494" text-anchor="middle" fill="#166534" font-size="11" font-weight="600">Terima Struk</text>
                <line x1="65" y1="506" x2="65" y2="526" stroke="#475569" stroke-width="1.5" marker-end="url(#ac2)"/>

                <circle cx="65" cy="546" r="10" fill="#0f172a"/>
                <circle cx="65" cy="546" r="14" fill="none" stroke="#0f172a" stroke-width="2"/>
            </svg>
        </div>
        </div>
    </div>

    {{-- Row 2: Admin & Owner --}}
    <div class="card" style="padding:24px;">
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">

        {{-- Activity: Kelola Data Master (Admin) --}}
        <div>
            <p style="font-size:13px; font-weight:700; color:#dc2626; margin-bottom:4px; text-align:center;">Activity: Kelola Data Master</p>
            <p style="font-size:11px; color:#94a3b8; margin-bottom:12px; text-align:center;">Admin</p>
            <svg width="100%" viewBox="0 0 260 660" xmlns="http://www.w3.org/2000/svg" style="font-family:Inter,sans-serif;">
                <defs><marker id="ac3" markerWidth="7" markerHeight="7" refX="5" refY="3" orient="auto"><path d="M0,0 L0,6 L7,3 z" fill="#475569"/></marker></defs>

                <!-- Swimlane headers -->
                <rect x="0" y="0" width="130" height="30" fill="#fee2e2" rx="0"/>
                <rect x="130" y="0" width="130" height="30" fill="#eff6ff" rx="0"/>
                <text x="65" y="20" text-anchor="middle" fill="#dc2626" font-size="11" font-weight="700">Admin</text>
                <text x="195" y="20" text-anchor="middle" fill="#2563eb" font-size="11" font-weight="700">Sistem</text>
                <line x1="130" y1="0" x2="130" y2="660" stroke="#e2e8f0" stroke-width="1" stroke-dasharray="4,3"/>

                <!-- Start -->
                <circle cx="65" cy="55" r="14" fill="#0f172a"/>
                <line x1="65" y1="69" x2="65" y2="89" stroke="#475569" stroke-width="1.5" marker-end="url(#ac3)"/>

                <!-- Pilih menu -->
                <rect x="10" y="89" width="110" height="34" rx="17" fill="#fee2e2" stroke="#dc2626" stroke-width="1.5"/>
                <text x="65" y="111" text-anchor="middle" fill="#991b1b" font-size="11" font-weight="600">Pilih Menu Data</text>
                <line x1="65" y1="123" x2="65" y2="143" stroke="#475569" stroke-width="1.5" marker-end="url(#ac3)"/>

                <!-- Decision: aksi -->
                <polygon points="65,143 130,170 65,197 0,170" fill="#fef3c7" stroke="#d97706" stroke-width="1.5"/>
                <text x="65" y="167" text-anchor="middle" fill="#92400e" font-size="9" font-weight="600">Pilih</text>
                <text x="65" y="179" text-anchor="middle" fill="#92400e" font-size="9" font-weight="600">Aksi?</text>

                <!-- Tambah branch -->
                <line x1="65" y1="197" x2="65" y2="217" stroke="#475569" stroke-width="1.5" marker-end="url(#ac3)"/>
                <text x="71" y="212" fill="#475569" font-size="9">Tambah</text>
                <rect x="10" y="217" width="110" height="34" rx="17" fill="#fee2e2" stroke="#dc2626" stroke-width="1.5"/>
                <text x="65" y="239" text-anchor="middle" fill="#991b1b" font-size="11" font-weight="600">Isi Form Tambah</text>
                <line x1="120" y1="234" x2="140" y2="234" stroke="#475569" stroke-width="1.5" marker-end="url(#ac3)"/>

                <!-- Sistem validasi -->
                <rect x="140" y="217" width="110" height="34" rx="17" fill="#eff6ff" stroke="#2563eb" stroke-width="1.5"/>
                <text x="195" y="239" text-anchor="middle" fill="#1d4ed8" font-size="11" font-weight="600">Validasi Input</text>
                <line x1="195" y1="251" x2="195" y2="271" stroke="#475569" stroke-width="1.5" marker-end="url(#ac3)"/>

                <!-- Decision valid -->
                <polygon points="195,271 240,292 195,313 150,292" fill="#fef3c7" stroke="#d97706" stroke-width="1.5"/>
                <text x="195" y="296" text-anchor="middle" fill="#92400e" font-size="9" font-weight="600">Valid?</text>
                <line x1="195" y1="313" x2="195" y2="333" stroke="#475569" stroke-width="1.5" marker-end="url(#ac3)"/>
                <text x="201" y="327" fill="#059669" font-size="9" font-weight="700">Ya</text>

                <!-- Simpan -->
                <rect x="140" y="333" width="110" height="34" rx="17" fill="#eff6ff" stroke="#2563eb" stroke-width="1.5"/>
                <text x="195" y="355" text-anchor="middle" fill="#1d4ed8" font-size="11" font-weight="600">Simpan ke Database</text>
                <line x1="195" y1="367" x2="195" y2="387" stroke="#475569" stroke-width="1.5" marker-end="url(#ac3)"/>

                <!-- Catat log -->
                <rect x="140" y="387" width="110" height="34" rx="17" fill="#eff6ff" stroke="#2563eb" stroke-width="1.5"/>
                <text x="195" y="409" text-anchor="middle" fill="#1d4ed8" font-size="11" font-weight="600">Catat Log Aktivitas</text>
                <line x1="140" y1="404" x2="120" y2="404" stroke="#475569" stroke-width="1.5" marker-end="url(#ac3)"/>

                <!-- Notif sukses -->
                <rect x="10" y="387" width="110" height="34" rx="17" fill="#fee2e2" stroke="#dc2626" stroke-width="1.5"/>
                <text x="65" y="409" text-anchor="middle" fill="#991b1b" font-size="11" font-weight="600">Tampil Notifikasi</text>
                <line x1="65" y1="421" x2="65" y2="441" stroke="#475569" stroke-width="1.5" marker-end="url(#ac3)"/>

                <!-- Edit/Hapus branch dari decision aksi -->
                <line x1="130" y1="170" x2="210" y2="170" stroke="#475569" stroke-width="1.5"/>
                <line x1="210" y1="170" x2="210" y2="441" stroke="#475569" stroke-width="1.5"/>
                <text x="134" y="164" fill="#475569" font-size="9">Edit/Hapus</text>
                <line x1="210" y1="441" x2="120" y2="441" stroke="#475569" stroke-width="1.5" marker-end="url(#ac3)"/>

                <!-- Tidak valid -->
                <line x1="150" y1="292" x2="130" y2="292" stroke="#ef4444" stroke-width="1.5"/>
                <line x1="130" y1="292" x2="130" y2="470" stroke="#ef4444" stroke-width="1.5"/>
                <text x="134" y="286" fill="#ef4444" font-size="9" font-weight="700">Tidak</text>
                <rect x="10" y="456" width="110" height="34" rx="17" fill="#fef2f2" stroke="#ef4444" stroke-width="1.5"/>
                <text x="65" y="478" text-anchor="middle" fill="#dc2626" font-size="11" font-weight="600">Tampil Error</text>
                <line x1="130" y1="470" x2="120" y2="470" stroke="#ef4444" stroke-width="1.5" marker-end="url(#ac3)"/>
                <line x1="65" y1="490" x2="65" y2="510" stroke="#475569" stroke-width="1.5" marker-end="url(#ac3)"/>

                <!-- Data terupdate -->
                <rect x="10" y="441" width="110" height="34" rx="17" fill="#fee2e2" stroke="#dc2626" stroke-width="1.5"/>
                <text x="65" y="463" text-anchor="middle" fill="#991b1b" font-size="11" font-weight="600">Data Terupdate</text>

                <!-- End -->
                <circle cx="65" cy="580" r="10" fill="#0f172a"/>
                <circle cx="65" cy="580" r="14" fill="none" stroke="#0f172a" stroke-width="2"/>
                <line x1="65" y1="510" x2="65" y2="566" stroke="#475569" stroke-width="1.5" marker-end="url(#ac3)"/>
            </svg>
        </div>

        {{-- Activity: Lihat Laporan (Owner) --}}
        <div>
            <p style="font-size:13px; font-weight:700; color:#d97706; margin-bottom:4px; text-align:center;">Activity: Lihat Laporan</p>
            <p style="font-size:11px; color:#94a3b8; margin-bottom:12px; text-align:center;">Owner</p>
            <svg width="100%" viewBox="0 0 260 620" xmlns="http://www.w3.org/2000/svg" style="font-family:Inter,sans-serif;">
                <defs><marker id="ac4" markerWidth="7" markerHeight="7" refX="5" refY="3" orient="auto"><path d="M0,0 L0,6 L7,3 z" fill="#475569"/></marker></defs>

                <!-- Swimlane headers -->
                <rect x="0" y="0" width="130" height="30" fill="#fef3c7" rx="0"/>
                <rect x="130" y="0" width="130" height="30" fill="#eff6ff" rx="0"/>
                <text x="65" y="20" text-anchor="middle" fill="#d97706" font-size="11" font-weight="700">Owner</text>
                <text x="195" y="20" text-anchor="middle" fill="#2563eb" font-size="11" font-weight="700">Sistem</text>
                <line x1="130" y1="0" x2="130" y2="620" stroke="#e2e8f0" stroke-width="1" stroke-dasharray="4,3"/>

                <!-- Start -->
                <circle cx="65" cy="55" r="14" fill="#0f172a"/>
                <line x1="65" y1="69" x2="65" y2="89" stroke="#475569" stroke-width="1.5" marker-end="url(#ac4)"/>

                <!-- Buka laporan -->
                <rect x="10" y="89" width="110" height="34" rx="17" fill="#fef3c7" stroke="#d97706" stroke-width="1.5"/>
                <text x="65" y="111" text-anchor="middle" fill="#92400e" font-size="11" font-weight="600">Buka Menu Laporan</text>
                <line x1="120" y1="106" x2="140" y2="106" stroke="#475569" stroke-width="1.5" marker-end="url(#ac4)"/>

                <!-- Sistem load default -->
                <rect x="140" y="89" width="110" height="34" rx="17" fill="#eff6ff" stroke="#2563eb" stroke-width="1.5"/>
                <text x="195" y="111" text-anchor="middle" fill="#1d4ed8" font-size="11" font-weight="600">Load Data Hari Ini</text>
                <line x1="140" y1="106" x2="120" y2="106" stroke="#475569" stroke-width="1.5"/>
                <line x1="65" y1="123" x2="65" y2="143" stroke="#475569" stroke-width="1.5" marker-end="url(#ac4)"/>

                <!-- Set filter -->
                <rect x="10" y="143" width="110" height="34" rx="17" fill="#fef3c7" stroke="#d97706" stroke-width="1.5"/>
                <text x="65" y="165" text-anchor="middle" fill="#92400e" font-size="11" font-weight="600">Set Filter Tanggal</text>
                <line x1="65" y1="177" x2="65" y2="197" stroke="#475569" stroke-width="1.5" marker-end="url(#ac4)"/>

                <!-- Filter jenis -->
                <rect x="10" y="197" width="110" height="34" rx="17" fill="#fef3c7" stroke="#d97706" stroke-width="1.5"/>
                <text x="65" y="219" text-anchor="middle" fill="#92400e" font-size="11" font-weight="600">Pilih Jenis Kendaraan</text>
                <line x1="65" y1="231" x2="65" y2="251" stroke="#475569" stroke-width="1.5" marker-end="url(#ac4)"/>

                <!-- Klik filter -->
                <rect x="10" y="251" width="110" height="34" rx="17" fill="#fef3c7" stroke="#d97706" stroke-width="1.5"/>
                <text x="65" y="273" text-anchor="middle" fill="#92400e" font-size="11" font-weight="600">Klik Terapkan Filter</text>
                <line x1="120" y1="268" x2="140" y2="268" stroke="#475569" stroke-width="1.5" marker-end="url(#ac4)"/>

                <!-- Sistem query -->
                <rect x="140" y="251" width="110" height="34" rx="17" fill="#eff6ff" stroke="#2563eb" stroke-width="1.5"/>
                <text x="195" y="273" text-anchor="middle" fill="#1d4ed8" font-size="11" font-weight="600">Query Database</text>
                <line x1="195" y1="285" x2="195" y2="305" stroke="#475569" stroke-width="1.5" marker-end="url(#ac4)"/>

                <!-- Hitung total -->
                <rect x="140" y="305" width="110" height="34" rx="17" fill="#eff6ff" stroke="#2563eb" stroke-width="1.5"/>
                <text x="195" y="327" text-anchor="middle" fill="#1d4ed8" font-size="11" font-weight="600">Hitung Total &amp; Rekap</text>
                <line x1="195" y1="339" x2="195" y2="359" stroke="#475569" stroke-width="1.5" marker-end="url(#ac4)"/>

                <!-- Tampilkan -->
                <rect x="140" y="359" width="110" height="34" rx="17" fill="#eff6ff" stroke="#2563eb" stroke-width="1.5"/>
                <text x="195" y="381" text-anchor="middle" fill="#1d4ed8" font-size="11" font-weight="600">Tampilkan Hasil</text>
                <line x1="140" y1="376" x2="120" y2="376" stroke="#475569" stroke-width="1.5" marker-end="url(#ac4)"/>

                <!-- Owner lihat -->
                <rect x="10" y="359" width="110" height="34" rx="17" fill="#fef3c7" stroke="#d97706" stroke-width="1.5"/>
                <text x="65" y="381" text-anchor="middle" fill="#92400e" font-size="11" font-weight="600">Lihat Rekap Harian</text>
                <line x1="65" y1="393" x2="65" y2="413" stroke="#475569" stroke-width="1.5" marker-end="url(#ac4)"/>

                <!-- Decision: export? -->
                <polygon points="65,413 130,435 65,457 0,435" fill="#fef3c7" stroke="#d97706" stroke-width="1.5"/>
                <text x="65" y="431" text-anchor="middle" fill="#92400e" font-size="9" font-weight="600">Perlu</text>
                <text x="65" y="443" text-anchor="middle" fill="#92400e" font-size="9" font-weight="600">Detail?</text>

                <!-- Ya: lihat detail -->
                <line x1="65" y1="457" x2="65" y2="477" stroke="#475569" stroke-width="1.5" marker-end="url(#ac4)"/>
                <text x="71" y="471" fill="#059669" font-size="9" font-weight="700">Ya</text>
                <rect x="10" y="477" width="110" height="34" rx="17" fill="#fef3c7" stroke="#d97706" stroke-width="1.5"/>
                <text x="65" y="499" text-anchor="middle" fill="#92400e" font-size="11" font-weight="600">Lihat Detail Transaksi</text>
                <line x1="65" y1="511" x2="65" y2="531" stroke="#475569" stroke-width="1.5" marker-end="url(#ac4)"/>

                <!-- Tidak: langsung end -->
                <line x1="0" y1="435" x2="-10" y2="435" stroke="#475569" stroke-width="1.5"/>
                <line x1="-10" y1="435" x2="-10" y2="545" stroke="#475569" stroke-width="1.5"/>
                <line x1="-10" y1="545" x2="51" y2="545" stroke="#475569" stroke-width="1.5" marker-end="url(#ac4)"/>
                <text x="-8" y="429" fill="#475569" font-size="9" font-weight="700">Tidak</text>

                <!-- End -->
                <circle cx="65" cy="575" r="10" fill="#0f172a"/>
                <circle cx="65" cy="575" r="14" fill="none" stroke="#0f172a" stroke-width="2"/>
                <line x1="65" y1="531" x2="65" y2="561" stroke="#475569" stroke-width="1.5" marker-end="url(#ac4)"/>
            </svg>
        </div>

        </div>
    </div>
</div>
