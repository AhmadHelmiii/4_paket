<div class="card" style="padding:24px;">
    <h2 style="font-size:15px; font-weight:700; color:#0f172a; margin-bottom:4px;">Class Diagram</h2>
    <p style="font-size:12px; color:#94a3b8; margin-bottom:20px;">Struktur kelas, atribut, method, dan relasi antar model</p>

    <div style="overflow-x:auto;">
    <svg width="1100" height="620" viewBox="0 0 1100 620" xmlns="http://www.w3.org/2000/svg" style="font-family:Inter,sans-serif; min-width:1100px;">
        <defs>
            <marker id="cl1" markerWidth="10" markerHeight="10" refX="9" refY="3" orient="auto">
                <path d="M0,0 L0,6 L9,3 z" fill="#475569"/>
            </marker>
            <marker id="cl2" markerWidth="10" markerHeight="10" refX="0" refY="3" orient="auto">
                <path d="M0,3 L9,0 L9,6 z" fill="none" stroke="#475569" stroke-width="1.5"/>
            </marker>
            <filter id="cs" x="-5%" y="-5%" width="110%" height="110%">
                <feDropShadow dx="0" dy="2" stdDeviation="3" flood-color="rgba(0,0,0,0.07)"/>
            </filter>
        </defs>

        <!-- TbUser -->
        <g filter="url(#cs)">
            <rect x="20" y="20" width="200" height="220" rx="10" fill="#fff" stroke="#e2e8f0" stroke-width="1.5"/>
            <rect x="20" y="20" width="200" height="36" rx="10" fill="#2563eb"/>
            <rect x="20" y="44" width="200" height="12" fill="#2563eb"/>
            <text x="120" y="43" text-anchor="middle" fill="#fff" font-size="12" font-weight="800">«Model» TbUser</text>
            <!-- Attributes -->
            <line x1="20" y1="56" x2="220" y2="56" stroke="#e2e8f0" stroke-width="1"/>
            <text x="30" y="72" fill="#64748b" font-size="10.5">+ id_user: int</text>
            <text x="30" y="88" fill="#64748b" font-size="10.5">+ nama_lengkap: string</text>
            <text x="30" y="104" fill="#64748b" font-size="10.5">+ username: string</text>
            <text x="30" y="120" fill="#64748b" font-size="10.5">+ password: string</text>
            <text x="30" y="136" fill="#64748b" font-size="10.5">+ role: enum</text>
            <text x="30" y="152" fill="#64748b" font-size="10.5">+ status_aktif: tinyint</text>
            <!-- Methods -->
            <line x1="20" y1="160" x2="220" y2="160" stroke="#e2e8f0" stroke-width="1"/>
            <text x="30" y="176" fill="#1d4ed8" font-size="10.5">+ isAdmin(): bool</text>
            <text x="30" y="192" fill="#1d4ed8" font-size="10.5">+ isPetugas(): bool</text>
            <text x="30" y="208" fill="#1d4ed8" font-size="10.5">+ isOwner(): bool</text>
            <text x="30" y="224" fill="#1d4ed8" font-size="10.5">+ transaksi(): HasMany</text>
        </g>

        <!-- TbTarif -->
        <g filter="url(#cs)">
            <rect x="280" y="20" width="200" height="180" rx="10" fill="#fff" stroke="#e2e8f0" stroke-width="1.5"/>
            <rect x="280" y="20" width="200" height="36" rx="10" fill="#059669"/>
            <rect x="280" y="44" width="200" height="12" fill="#059669"/>
            <text x="380" y="43" text-anchor="middle" fill="#fff" font-size="12" font-weight="800">«Model» TbTarif</text>
            <line x1="280" y1="56" x2="480" y2="56" stroke="#e2e8f0" stroke-width="1"/>
            <text x="290" y="72" fill="#64748b" font-size="10.5">+ id_tarif: int</text>
            <text x="290" y="88" fill="#64748b" font-size="10.5">+ jenis_kendaraan: enum</text>
            <text x="290" y="104" fill="#64748b" font-size="10.5">+ tarif_per_jam: decimal</text>
            <line x1="280" y1="112" x2="480" y2="112" stroke="#e2e8f0" stroke-width="1"/>
            <text x="290" y="128" fill="#059669" font-size="10.5">+ transaksi(): HasMany</text>
        </g>

        <!-- TbAreaParkir -->
        <g filter="url(#cs)">
            <rect x="540" y="20" width="210" height="210" rx="10" fill="#fff" stroke="#e2e8f0" stroke-width="1.5"/>
            <rect x="540" y="20" width="210" height="36" rx="10" fill="#7c3aed"/>
            <rect x="540" y="44" width="210" height="12" fill="#7c3aed"/>
            <text x="645" y="43" text-anchor="middle" fill="#fff" font-size="12" font-weight="800">«Model» TbAreaParkir</text>
            <line x1="540" y1="56" x2="750" y2="56" stroke="#e2e8f0" stroke-width="1"/>
            <text x="550" y="72" fill="#64748b" font-size="10.5">+ id_area: int</text>
            <text x="550" y="88" fill="#64748b" font-size="10.5">+ nama_area: string</text>
            <text x="550" y="104" fill="#64748b" font-size="10.5">+ kapasitas: int</text>
            <text x="550" y="120" fill="#64748b" font-size="10.5">+ terisi: int</text>
            <line x1="540" y1="128" x2="750" y2="128" stroke="#e2e8f0" stroke-width="1"/>
            <text x="550" y="144" fill="#7c3aed" font-size="10.5">+ sisaSlot(): int</text>
            <text x="550" y="160" fill="#7c3aed" font-size="10.5">+ persentaseTerisi(): float</text>
            <text x="550" y="176" fill="#7c3aed" font-size="10.5">+ transaksi(): HasMany</text>
        </g>

        <!-- TbKendaraan -->
        <g filter="url(#cs)">
            <rect x="20" y="310" width="210" height="210" rx="10" fill="#fff" stroke="#e2e8f0" stroke-width="1.5"/>
            <rect x="20" y="310" width="210" height="36" rx="10" fill="#d97706"/>
            <rect x="20" y="334" width="210" height="12" fill="#d97706"/>
            <text x="125" y="333" text-anchor="middle" fill="#fff" font-size="12" font-weight="800">«Model» TbKendaraan</text>
            <line x1="20" y1="346" x2="230" y2="346" stroke="#e2e8f0" stroke-width="1"/>
            <text x="30" y="362" fill="#64748b" font-size="10.5">+ id_kendaraan: int</text>
            <text x="30" y="378" fill="#64748b" font-size="10.5">+ plat_nomor: string</text>
            <text x="30" y="394" fill="#64748b" font-size="10.5">+ jenis_kendaraan: string</text>
            <text x="30" y="410" fill="#64748b" font-size="10.5">+ warna: string</text>
            <text x="30" y="426" fill="#64748b" font-size="10.5">+ pemilik: string</text>
            <text x="30" y="442" fill="#64748b" font-size="10.5">+ id_user: int (FK)</text>
            <line x1="20" y1="450" x2="230" y2="450" stroke="#e2e8f0" stroke-width="1"/>
            <text x="30" y="466" fill="#d97706" font-size="10.5">+ transaksi(): HasMany</text>
            <text x="30" y="482" fill="#d97706" font-size="10.5">+ transaksiAktif(): HasOne</text>
        </g>

        <!-- TbTransaksi -->
        <g filter="url(#cs)">
            <rect x="300" y="260" width="220" height="300" rx="10" fill="#fff" stroke="#e2e8f0" stroke-width="1.5"/>
            <rect x="300" y="260" width="220" height="36" rx="10" fill="#0f172a"/>
            <rect x="300" y="284" width="220" height="12" fill="#0f172a"/>
            <text x="410" y="283" text-anchor="middle" fill="#fff" font-size="12" font-weight="800">«Model» TbTransaksi</text>
            <line x1="300" y1="296" x2="520" y2="296" stroke="#334155" stroke-width="1"/>
            <text x="310" y="312" fill="#64748b" font-size="10.5">+ id_parkir: int</text>
            <text x="310" y="328" fill="#64748b" font-size="10.5">+ id_kendaraan: int (FK)</text>
            <text x="310" y="344" fill="#64748b" font-size="10.5">+ waktu_masuk: datetime</text>
            <text x="310" y="360" fill="#64748b" font-size="10.5">+ waktu_keluar: datetime</text>
            <text x="310" y="376" fill="#64748b" font-size="10.5">+ id_tarif: int (FK)</text>
            <text x="310" y="392" fill="#64748b" font-size="10.5">+ durasi_jam: int</text>
            <text x="310" y="408" fill="#64748b" font-size="10.5">+ biaya_total: decimal</text>
            <text x="310" y="424" fill="#64748b" font-size="10.5">+ status: enum</text>
            <text x="310" y="440" fill="#64748b" font-size="10.5">+ id_user: int (FK)</text>
            <text x="310" y="456" fill="#64748b" font-size="10.5">+ id_area: int (FK)</text>
            <line x1="300" y1="464" x2="520" y2="464" stroke="#e2e8f0" stroke-width="1"/>
            <text x="310" y="480" fill="#475569" font-size="10.5">+ hitungBiaya(): array</text>
            <text x="310" y="496" fill="#475569" font-size="10.5">+ kendaraan(): BelongsTo</text>
            <text x="310" y="512" fill="#475569" font-size="10.5">+ tarif(): BelongsTo</text>
            <text x="310" y="528" fill="#475569" font-size="10.5">+ area(): BelongsTo</text>
            <text x="310" y="544" fill="#475569" font-size="10.5">+ user(): BelongsTo</text>
        </g>

        <!-- TbLogAktivitas -->
        <g filter="url(#cs)">
            <rect x="590" y="310" width="210" height="200" rx="10" fill="#fff" stroke="#e2e8f0" stroke-width="1.5"/>
            <rect x="590" y="310" width="210" height="36" rx="10" fill="#dc2626"/>
            <rect x="590" y="334" width="210" height="12" fill="#dc2626"/>
            <text x="695" y="333" text-anchor="middle" fill="#fff" font-size="12" font-weight="800">«Model» TbLogAktivitas</text>
            <line x1="590" y1="346" x2="800" y2="346" stroke="#e2e8f0" stroke-width="1"/>
            <text x="600" y="362" fill="#64748b" font-size="10.5">+ id_log: int</text>
            <text x="600" y="378" fill="#64748b" font-size="10.5">+ id_user: int (FK)</text>
            <text x="600" y="394" fill="#64748b" font-size="10.5">+ aktivitas: string</text>
            <text x="600" y="410" fill="#64748b" font-size="10.5">+ waktu_aktivitas: datetime</text>
            <line x1="590" y1="418" x2="800" y2="418" stroke="#e2e8f0" stroke-width="1"/>
            <text x="600" y="434" fill="#dc2626" font-size="10.5">+ catat(): static void</text>
            <text x="600" y="450" fill="#dc2626" font-size="10.5">+ user(): BelongsTo</text>
        </g>

        <!-- Controllers -->
        <g filter="url(#cs)">
            <rect x="820" y="20" width="260" height="560" rx="10" fill="#fff" stroke="#e2e8f0" stroke-width="1.5"/>
            <rect x="820" y="20" width="260" height="36" rx="10" fill="#0284c7"/>
            <rect x="820" y="44" width="260" height="12" fill="#0284c7"/>
            <text x="950" y="43" text-anchor="middle" fill="#fff" font-size="12" font-weight="800">«Controllers»</text>
            <line x1="820" y1="56" x2="1080" y2="56" stroke="#e2e8f0" stroke-width="1"/>
            @foreach([
                ['AuthController','login(), logout()'],
                ['DashboardController','index(), getChartData()'],
                ['UserController','index(), store(), update(), destroy()'],
                ['TarifController','index(), store(), update(), destroy()'],
                ['AreaController','index(), store(), update(), destroy()'],
                ['KendaraanController','index(), store(), update(), destroy()'],
                ['TransaksiController','index(), store(), checkout(), prosesCheckout(), struk(), cetakStruk()'],
                ['LaporanController','index()'],
                ['LogAktivitasController','index()'],
            ] as $i => $ctrl)
            <rect x="830" y="{{ 66 + $i * 56 }}" width="240" height="46" rx="8" fill="#f0f9ff" stroke="#bae6fd" stroke-width="1"/>
            <text x="840" y="{{ 84 + $i * 56 }}" fill="#0369a1" font-size="11" font-weight="700">{{ $ctrl[0] }}</text>
            <text x="840" y="{{ 100 + $i * 56 }}" fill="#64748b" font-size="10">{{ $ctrl[1] }}</text>
            @endforeach
        </g>

        <!-- Relation lines -->
        <!-- User → Kendaraan -->
        <line x1="120" y1="240" x2="120" y2="310" stroke="#94a3b8" stroke-width="1.5" stroke-dasharray="5,3" marker-end="url(#cl1)"/>
        <text x="126" y="280" fill="#94a3b8" font-size="9">1..N</text>
        <!-- User → Transaksi -->
        <line x1="220" y1="130" x2="300" y2="380" stroke="#94a3b8" stroke-width="1.5" stroke-dasharray="5,3" marker-end="url(#cl1)"/>
        <!-- User → Log -->
        <line x1="220" y1="80" x2="590" y2="360" stroke="#94a3b8" stroke-width="1.5" stroke-dasharray="5,3" marker-end="url(#cl1)"/>
        <!-- Kendaraan → Transaksi -->
        <line x1="230" y1="415" x2="300" y2="415" stroke="#94a3b8" stroke-width="1.5" stroke-dasharray="5,3" marker-end="url(#cl1)"/>
        <text x="248" y="408" fill="#94a3b8" font-size="9">1..N</text>
        <!-- Tarif → Transaksi -->
        <line x1="380" y1="200" x2="380" y2="260" stroke="#94a3b8" stroke-width="1.5" stroke-dasharray="5,3" marker-end="url(#cl1)"/>
        <text x="386" y="235" fill="#94a3b8" font-size="9">1..N</text>
        <!-- Area → Transaksi -->
        <line x1="590" y1="130" x2="520" y2="400" stroke="#94a3b8" stroke-width="1.5" stroke-dasharray="5,3" marker-end="url(#cl1)"/>
    </svg>
    </div>
</div>
