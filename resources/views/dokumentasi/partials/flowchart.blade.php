<div style="display:flex; flex-direction:column; gap:16px;">
    <div class="card" style="padding:24px;">
        <h2 style="font-size:15px; font-weight:700; color:#0f172a; margin-bottom:4px;">Flowchart Sistem Usulan</h2>
        <p style="font-size:12px; color:#94a3b8; margin-bottom:20px;">Alur proses utama pada aplikasi parkir berbasis web</p>

        <div style="display:grid; grid-template-columns:1fr 1fr 1fr; gap:20px;">

        {{-- Flowchart 1: Login --}}
        <div>
            <p style="font-size:13px; font-weight:700; color:#2563eb; margin-bottom:16px; text-align:center;">1. Proses Login</p>
            <svg width="100%" viewBox="0 0 200 420" xmlns="http://www.w3.org/2000/svg" style="font-family:Inter,sans-serif;">
                <defs>
                    <marker id="f1" markerWidth="7" markerHeight="7" refX="5" refY="3" orient="auto">
                        <path d="M0,0 L0,6 L7,3 z" fill="#475569"/>
                    </marker>
                </defs>

                <!-- Mulai -->
                <ellipse cx="100" cy="30" rx="55" ry="20" fill="#0f172a"/>
                <text x="100" y="35" text-anchor="middle" fill="#fff" font-size="12" font-weight="700">Mulai</text>
                <line x1="100" y1="50" x2="100" y2="70" stroke="#475569" stroke-width="1.5" marker-end="url(#f1)"/>

                <!-- Input -->
                <polygon points="20,70 180,70 180,110 20,110" fill="#eff6ff" stroke="#2563eb" stroke-width="1.5"/>
                <text x="100" y="86" text-anchor="middle" fill="#1d4ed8" font-size="11" font-weight="600">Masukkan Username</text>
                <text x="100" y="101" text-anchor="middle" fill="#1d4ed8" font-size="11" font-weight="600">&amp; Password</text>
                <line x1="100" y1="110" x2="100" y2="130" stroke="#475569" stroke-width="1.5" marker-end="url(#f1)"/>

                <!-- Decision -->
                <polygon points="100,130 180,162 100,194 20,162" fill="#fef3c7" stroke="#d97706" stroke-width="1.5"/>
                <text x="100" y="158" text-anchor="middle" fill="#92400e" font-size="11" font-weight="600">Data</text>
                <text x="100" y="172" text-anchor="middle" fill="#92400e" font-size="11" font-weight="600">Valid?</text>

                <!-- Tidak -->
                <line x1="20" y1="162" x2="10" y2="162" stroke="#ef4444" stroke-width="1.5"/>
                <line x1="10" y1="162" x2="10" y2="310" stroke="#ef4444" stroke-width="1.5"/>
                <text x="13" y="156" fill="#ef4444" font-size="9" font-weight="700">Tidak</text>
                <rect x="20" y="296" width="120" height="28" rx="8" fill="#fef2f2" stroke="#ef4444" stroke-width="1.5"/>
                <text x="80" y="315" text-anchor="middle" fill="#dc2626" font-size="11" font-weight="600">Tampil Error</text>
                <line x1="10" y1="310" x2="20" y2="310" stroke="#ef4444" stroke-width="1.5" marker-end="url(#f1)"/>

                <!-- Ya -->
                <line x1="100" y1="194" x2="100" y2="214" stroke="#475569" stroke-width="1.5" marker-end="url(#f1)"/>
                <text x="106" y="208" fill="#059669" font-size="9" font-weight="700">Ya</text>

                <!-- Simpan Session -->
                <rect x="30" y="214" width="140" height="28" rx="8" fill="#dcfce7" stroke="#059669" stroke-width="1.5"/>
                <text x="100" y="233" text-anchor="middle" fill="#166534" font-size="11" font-weight="600">Login Berhasil</text>
                <line x1="100" y1="242" x2="100" y2="262" stroke="#475569" stroke-width="1.5" marker-end="url(#f1)"/>

                <!-- Buka Dashboard -->
                <rect x="30" y="262" width="140" height="28" rx="8" fill="#dcfce7" stroke="#059669" stroke-width="1.5"/>
                <text x="100" y="281" text-anchor="middle" fill="#166534" font-size="11" font-weight="600">Buka Dashboard</text>
                <line x1="100" y1="290" x2="100" y2="350" stroke="#475569" stroke-width="1.5" marker-end="url(#f1)"/>

                <!-- Selesai -->
                <ellipse cx="100" cy="370" rx="55" ry="20" fill="#0f172a"/>
                <text x="100" y="375" text-anchor="middle" fill="#fff" font-size="12" font-weight="700">Selesai</text>
                <line x1="80" y1="324" x2="80" y2="350" stroke="#475569" stroke-width="1.5"/>
                <line x1="80" y1="350" x2="100" y2="350" stroke="#475569" stroke-width="1.5"/>
            </svg>
        </div>

        {{-- Flowchart 2: Kendaraan Masuk --}}
        <div>
            <p style="font-size:13px; font-weight:700; color:#059669; margin-bottom:16px; text-align:center;">2. Kendaraan Masuk</p>
            <svg width="100%" viewBox="0 0 200 460" xmlns="http://www.w3.org/2000/svg" style="font-family:Inter,sans-serif;">
                <defs>
                    <marker id="f2" markerWidth="7" markerHeight="7" refX="5" refY="3" orient="auto">
                        <path d="M0,0 L0,6 L7,3 z" fill="#475569"/>
                    </marker>
                </defs>

                <ellipse cx="100" cy="30" rx="55" ry="20" fill="#0f172a"/>
                <text x="100" y="35" text-anchor="middle" fill="#fff" font-size="12" font-weight="700">Mulai</text>
                <line x1="100" y1="50" x2="100" y2="70" stroke="#475569" stroke-width="1.5" marker-end="url(#f2)"/>

                <!-- Input -->
                <polygon points="20,70 180,70 180,110 20,110" fill="#f0fdf4" stroke="#059669" stroke-width="1.5"/>
                <text x="100" y="86" text-anchor="middle" fill="#166534" font-size="11" font-weight="600">Masukkan Plat, Jenis</text>
                <text x="100" y="101" text-anchor="middle" fill="#166534" font-size="11" font-weight="600">&amp; Pilih Area Parkir</text>
                <line x1="100" y1="110" x2="100" y2="130" stroke="#475569" stroke-width="1.5" marker-end="url(#f2)"/>

                <!-- Decision -->
                <polygon points="100,130 180,162 100,194 20,162" fill="#fef3c7" stroke="#d97706" stroke-width="1.5"/>
                <text x="100" y="155" text-anchor="middle" fill="#92400e" font-size="10" font-weight="600">Sudah</text>
                <text x="100" y="169" text-anchor="middle" fill="#92400e" font-size="10" font-weight="600">Parkir?</text>

                <!-- Ya = error -->
                <line x1="180" y1="162" x2="190" y2="162" stroke="#ef4444" stroke-width="1.5"/>
                <line x1="190" y1="162" x2="190" y2="310" stroke="#ef4444" stroke-width="1.5"/>
                <text x="182" y="156" fill="#ef4444" font-size="9" font-weight="700">Ya</text>
                <rect x="60" y="296" width="120" height="28" rx="8" fill="#fef2f2" stroke="#ef4444" stroke-width="1.5"/>
                <text x="120" y="315" text-anchor="middle" fill="#dc2626" font-size="11" font-weight="600">Tampil Error</text>
                <line x1="190" y1="310" x2="180" y2="310" stroke="#ef4444" stroke-width="1.5" marker-end="url(#f2)"/>

                <!-- Tidak -->
                <line x1="100" y1="194" x2="100" y2="214" stroke="#475569" stroke-width="1.5" marker-end="url(#f2)"/>
                <text x="106" y="208" fill="#059669" font-size="9" font-weight="700">Tidak</text>

                <!-- Catat waktu masuk -->
                <rect x="30" y="214" width="140" height="28" rx="8" fill="#dcfce7" stroke="#059669" stroke-width="1.5"/>
                <text x="100" y="233" text-anchor="middle" fill="#166534" font-size="11" font-weight="600">Rekam Waktu Masuk</text>
                <line x1="100" y1="242" x2="100" y2="262" stroke="#475569" stroke-width="1.5" marker-end="url(#f2)"/>

                <!-- Simpan Transaksi -->
                <rect x="30" y="262" width="140" height="28" rx="8" fill="#dcfce7" stroke="#059669" stroke-width="1.5"/>
                <text x="100" y="281" text-anchor="middle" fill="#166534" font-size="11" font-weight="600">Data Parkir Tersimpan</text>
                <line x1="100" y1="290" x2="100" y2="390" stroke="#475569" stroke-width="1.5" marker-end="url(#f2)"/>

                <ellipse cx="100" cy="410" rx="55" ry="20" fill="#0f172a"/>
                <text x="100" y="415" text-anchor="middle" fill="#fff" font-size="12" font-weight="700">Selesai</text>
                <line x1="120" y1="324" x2="120" y2="390" stroke="#475569" stroke-width="1.5"/>
                <line x1="120" y1="390" x2="100" y2="390" stroke="#475569" stroke-width="1.5"/>
            </svg>
        </div>

        {{-- Flowchart 3: Kendaraan Keluar --}}
        <div>
            <p style="font-size:13px; font-weight:700; color:#7c3aed; margin-bottom:16px; text-align:center;">3. Kendaraan Keluar</p>
            <svg width="100%" viewBox="0 0 200 500" xmlns="http://www.w3.org/2000/svg" style="font-family:Inter,sans-serif;">
                <defs>
                    <marker id="f3" markerWidth="7" markerHeight="7" refX="5" refY="3" orient="auto">
                        <path d="M0,0 L0,6 L7,3 z" fill="#475569"/>
                    </marker>
                </defs>

                <ellipse cx="100" cy="30" rx="55" ry="20" fill="#0f172a"/>
                <text x="100" y="35" text-anchor="middle" fill="#fff" font-size="12" font-weight="700">Mulai</text>
                <line x1="100" y1="50" x2="100" y2="70" stroke="#475569" stroke-width="1.5" marker-end="url(#f3)"/>

                <!-- Input plat -->
                <polygon points="20,70 180,70 180,100 20,100" fill="#f5f3ff" stroke="#7c3aed" stroke-width="1.5"/>
                <text x="100" y="90" text-anchor="middle" fill="#6d28d9" font-size="11" font-weight="600">Masukkan Plat Nomor</text>
                <line x1="100" y1="100" x2="100" y2="120" stroke="#475569" stroke-width="1.5" marker-end="url(#f3)"/>

                <!-- Decision: ditemukan? -->
                <polygon points="100,120 180,150 100,180 20,150" fill="#fef3c7" stroke="#d97706" stroke-width="1.5"/>
                <text x="100" y="146" text-anchor="middle" fill="#92400e" font-size="10" font-weight="600">Kendaraan</text>
                <text x="100" y="160" text-anchor="middle" fill="#92400e" font-size="10" font-weight="600">Ditemukan?</text>

                <!-- Tidak = error -->
                <line x1="20" y1="150" x2="10" y2="150" stroke="#ef4444" stroke-width="1.5"/>
                <line x1="10" y1="150" x2="10" y2="310" stroke="#ef4444" stroke-width="1.5"/>
                <text x="13" y="144" fill="#ef4444" font-size="9" font-weight="700">Tidak</text>
                <rect x="20" y="296" width="120" height="28" rx="8" fill="#fef2f2" stroke="#ef4444" stroke-width="1.5"/>
                <text x="80" y="315" text-anchor="middle" fill="#dc2626" font-size="11" font-weight="600">Tampil Error</text>
                <line x1="10" y1="310" x2="20" y2="310" stroke="#ef4444" stroke-width="1.5" marker-end="url(#f3)"/>

                <!-- Ya -->
                <line x1="100" y1="180" x2="100" y2="200" stroke="#475569" stroke-width="1.5" marker-end="url(#f3)"/>
                <text x="106" y="194" fill="#059669" font-size="9" font-weight="700">Ya</text>

                <!-- Hitung durasi & biaya -->
                <rect x="25" y="200" width="150" height="28" rx="8" fill="#f5f3ff" stroke="#7c3aed" stroke-width="1.5"/>
                <text x="100" y="219" text-anchor="middle" fill="#6d28d9" font-size="11" font-weight="600">Hitung Lama Parkir &amp; Biaya</text>
                <line x1="100" y1="228" x2="100" y2="248" stroke="#475569" stroke-width="1.5" marker-end="url(#f3)"/>

                <!-- Update transaksi -->
                <rect x="25" y="248" width="150" height="28" rx="8" fill="#f5f3ff" stroke="#7c3aed" stroke-width="1.5"/>
                <text x="100" y="267" text-anchor="middle" fill="#6d28d9" font-size="11" font-weight="600">Tandai Kendaraan Keluar</text>
                <line x1="100" y1="276" x2="100" y2="296" stroke="#475569" stroke-width="1.5" marker-end="url(#f3)"/>

                <!-- Cetak struk -->
                <rect x="25" y="296" width="150" height="28" rx="8" fill="#f5f3ff" stroke="#7c3aed" stroke-width="1.5"/>
                <text x="100" y="315" text-anchor="middle" fill="#6d28d9" font-size="11" font-weight="600">Buat &amp; Cetak Struk</text>
                <line x1="100" y1="324" x2="100" y2="420" stroke="#475569" stroke-width="1.5" marker-end="url(#f3)"/>

                <ellipse cx="100" cy="440" rx="55" ry="20" fill="#0f172a"/>
                <text x="100" y="445" text-anchor="middle" fill="#fff" font-size="12" font-weight="700">Selesai</text>
                <line x1="80" y1="324" x2="80" y2="420" stroke="#475569" stroke-width="1.5"/>
                <line x1="80" y1="420" x2="100" y2="420" stroke="#475569" stroke-width="1.5"/>
            </svg>
        </div>

        </div>
    </div>
</div>
