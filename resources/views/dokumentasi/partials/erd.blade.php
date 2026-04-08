<div class="card" style="padding:24px; margin-top:16px;">
    <h2 style="font-size:15px; font-weight:700; color:#0f172a; margin-bottom:4px;">Entity Relationship Diagram</h2>
    <p style="font-size:12px; color:#94a3b8; margin-bottom:20px;">Relasi antar tabel database aplikasi parkir</p>

    <div style="overflow-x:auto;">
    <svg width="900" height="560" viewBox="0 0 900 560" xmlns="http://www.w3.org/2000/svg" style="font-family:Inter,sans-serif; min-width:900px;">
        <defs>
            <marker id="arrow" markerWidth="8" markerHeight="8" refX="6" refY="3" orient="auto">
                <path d="M0,0 L0,6 L8,3 z" fill="#94a3b8"/>
            </marker>
            <filter id="shadow" x="-10%" y="-10%" width="120%" height="120%">
                <feDropShadow dx="0" dy="2" stdDeviation="3" flood-color="rgba(0,0,0,0.08)"/>
            </filter>
        </defs>

        <!-- tb_user -->
        <g filter="url(#shadow)">
            <rect x="20" y="20" width="180" height="180" rx="12" fill="#fff" stroke="#e2e8f0" stroke-width="1.5"/>
            <rect x="20" y="20" width="180" height="36" rx="12" fill="#2563eb"/>
            <rect x="20" y="44" width="180" height="12" fill="#2563eb"/>
            <text x="110" y="43" text-anchor="middle" fill="#fff" font-size="13" font-weight="700">tb_user</text>
            <line x1="20" y1="56" x2="200" y2="56" stroke="#f1f5f9" stroke-width="1"/>
            <text x="36" y="74" fill="#f59e0b" font-size="11" font-weight="700">🔑 id_user</text>
            <text x="36" y="92" fill="#64748b" font-size="11">nama_lengkap</text>
            <text x="36" y="108" fill="#64748b" font-size="11">username</text>
            <text x="36" y="124" fill="#64748b" font-size="11">password</text>
            <text x="36" y="140" fill="#64748b" font-size="11">role</text>
            <text x="36" y="156" fill="#64748b" font-size="11">status_aktif</text>
        </g>

        <!-- tb_tarif -->
        <g filter="url(#shadow)">
            <rect x="360" y="20" width="180" height="130" rx="12" fill="#fff" stroke="#e2e8f0" stroke-width="1.5"/>
            <rect x="360" y="20" width="180" height="36" rx="12" fill="#059669"/>
            <rect x="360" y="44" width="180" height="12" fill="#059669"/>
            <text x="450" y="43" text-anchor="middle" fill="#fff" font-size="13" font-weight="700">tb_tarif</text>
            <line x1="360" y1="56" x2="540" y2="56" stroke="#f1f5f9" stroke-width="1"/>
            <text x="376" y="74" fill="#f59e0b" font-size="11" font-weight="700">🔑 id_tarif</text>
            <text x="376" y="92" fill="#64748b" font-size="11">jenis_kendaraan</text>
            <text x="376" y="108" fill="#64748b" font-size="11">tarif_per_jam</text>
        </g>

        <!-- tb_area_parkir -->
        <g filter="url(#shadow)">
            <rect x="700" y="20" width="180" height="130" rx="12" fill="#fff" stroke="#e2e8f0" stroke-width="1.5"/>
            <rect x="700" y="20" width="180" height="36" rx="12" fill="#7c3aed"/>
            <rect x="700" y="44" width="180" height="12" fill="#7c3aed"/>
            <text x="790" y="43" text-anchor="middle" fill="#fff" font-size="13" font-weight="700">tb_area_parkir</text>
            <line x1="700" y1="56" x2="880" y2="56" stroke="#f1f5f9" stroke-width="1"/>
            <text x="716" y="74" fill="#f59e0b" font-size="11" font-weight="700">🔑 id_area</text>
            <text x="716" y="92" fill="#64748b" font-size="11">nama_area</text>
            <text x="716" y="108" fill="#64748b" font-size="11">kapasitas</text>
            <text x="716" y="124" fill="#64748b" font-size="11">terisi</text>
        </g>

        <!-- tb_kendaraan -->
        <g filter="url(#shadow)">
            <rect x="20" y="260" width="180" height="180" rx="12" fill="#fff" stroke="#e2e8f0" stroke-width="1.5"/>
            <rect x="20" y="260" width="180" height="36" rx="12" fill="#d97706"/>
            <rect x="20" y="284" width="180" height="12" fill="#d97706"/>
            <text x="110" y="283" text-anchor="middle" fill="#fff" font-size="13" font-weight="700">tb_kendaraan</text>
            <line x1="20" y1="296" x2="200" y2="296" stroke="#f1f5f9" stroke-width="1"/>
            <text x="36" y="314" fill="#f59e0b" font-size="11" font-weight="700">🔑 id_kendaraan</text>
            <text x="36" y="330" fill="#64748b" font-size="11">plat_nomor</text>
            <text x="36" y="346" fill="#64748b" font-size="11">jenis_kendaraan</text>
            <text x="36" y="362" fill="#64748b" font-size="11">warna</text>
            <text x="36" y="378" fill="#64748b" font-size="11">pemilik</text>
            <text x="36" y="394" fill="#ef4444" font-size="11">🔗 id_user (FK)</text>
        </g>

        <!-- tb_transaksi -->
        <g filter="url(#shadow)">
            <rect x="340" y="220" width="220" height="260" rx="12" fill="#fff" stroke="#e2e8f0" stroke-width="1.5"/>
            <rect x="340" y="220" width="220" height="36" rx="12" fill="#0f172a"/>
            <rect x="340" y="244" width="220" height="12" fill="#0f172a"/>
            <text x="450" y="243" text-anchor="middle" fill="#fff" font-size="13" font-weight="700">tb_transaksi</text>
            <line x1="340" y1="256" x2="560" y2="256" stroke="#334155" stroke-width="1"/>
            <text x="356" y="274" fill="#f59e0b" font-size="11" font-weight="700">🔑 id_parkir</text>
            <text x="356" y="292" fill="#ef4444" font-size="11">🔗 id_kendaraan (FK)</text>
            <text x="356" y="308" fill="#64748b" font-size="11">waktu_masuk</text>
            <text x="356" y="324" fill="#64748b" font-size="11">waktu_keluar</text>
            <text x="356" y="340" fill="#ef4444" font-size="11">🔗 id_tarif (FK)</text>
            <text x="356" y="356" fill="#64748b" font-size="11">durasi_jam</text>
            <text x="356" y="372" fill="#64748b" font-size="11">biaya_total</text>
            <text x="356" y="388" fill="#64748b" font-size="11">status</text>
            <text x="356" y="404" fill="#ef4444" font-size="11">🔗 id_user (FK)</text>
            <text x="356" y="420" fill="#ef4444" font-size="11">🔗 id_area (FK)</text>
        </g>

        <!-- tb_log_aktivitas -->
        <g filter="url(#shadow)">
            <rect x="680" y="260" width="200" height="150" rx="12" fill="#fff" stroke="#e2e8f0" stroke-width="1.5"/>
            <rect x="680" y="260" width="200" height="36" rx="12" fill="#dc2626"/>
            <rect x="680" y="284" width="200" height="12" fill="#dc2626"/>
            <text x="780" y="283" text-anchor="middle" fill="#fff" font-size="13" font-weight="700">tb_log_aktivitas</text>
            <line x1="680" y1="296" x2="880" y2="296" stroke="#f1f5f9" stroke-width="1"/>
            <text x="696" y="314" fill="#f59e0b" font-size="11" font-weight="700">🔑 id_log</text>
            <text x="696" y="330" fill="#ef4444" font-size="11">🔗 id_user (FK)</text>
            <text x="696" y="346" fill="#64748b" font-size="11">aktivitas</text>
            <text x="696" y="362" fill="#64748b" font-size="11">waktu_aktivitas</text>
        </g>

        <!-- Relations -->
        <!-- user → kendaraan -->
        <line x1="110" y1="200" x2="110" y2="260" stroke="#94a3b8" stroke-width="1.5" stroke-dasharray="5,3" marker-end="url(#arrow)"/>
        <text x="116" y="234" fill="#94a3b8" font-size="10">1:N</text>

        <!-- user → transaksi -->
        <line x1="200" y1="110" x2="340" y2="320" stroke="#94a3b8" stroke-width="1.5" stroke-dasharray="5,3" marker-end="url(#arrow)"/>

        <!-- user → log -->
        <line x1="200" y1="80" x2="680" y2="310" stroke="#94a3b8" stroke-width="1.5" stroke-dasharray="5,3" marker-end="url(#arrow)"/>

        <!-- kendaraan → transaksi -->
        <line x1="200" y1="350" x2="340" y2="350" stroke="#94a3b8" stroke-width="1.5" stroke-dasharray="5,3" marker-end="url(#arrow)"/>
        <text x="256" y="344" fill="#94a3b8" font-size="10">1:N</text>

        <!-- tarif → transaksi -->
        <line x1="450" y1="150" x2="450" y2="220" stroke="#94a3b8" stroke-width="1.5" stroke-dasharray="5,3" marker-end="url(#arrow)"/>
        <text x="456" y="190" fill="#94a3b8" font-size="10">1:N</text>

        <!-- area → transaksi -->
        <line x1="700" y1="85" x2="560" y2="380" stroke="#94a3b8" stroke-width="1.5" stroke-dasharray="5,3" marker-end="url(#arrow)"/>

        <!-- Legend -->
        <rect x="20" y="490" width="860" height="50" rx="10" fill="#f8fafc" stroke="#f1f5f9" stroke-width="1"/>
        <text x="36" y="510" fill="#64748b" font-size="11" font-weight="700">LEGEND:</text>
        <rect x="100" y="498" width="14" height="14" rx="3" fill="#f59e0b"/>
        <text x="120" y="510" fill="#64748b" font-size="11">Primary Key</text>
        <rect x="210" y="498" width="14" height="14" rx="3" fill="#ef4444"/>
        <text x="230" y="510" fill="#64748b" font-size="11">Foreign Key</text>
        <line x1="320" y1="505" x2="360" y2="505" stroke="#94a3b8" stroke-width="1.5" stroke-dasharray="5,3"/>
        <text x="368" y="510" fill="#64748b" font-size="11">Relasi (FK Reference)</text>
        <text x="36" y="530" fill="#94a3b8" font-size="10">tb_transaksi adalah tabel pusat yang menghubungkan tb_kendaraan, tb_tarif, tb_area_parkir, dan tb_user</text>
    </svg>
    </div>
</div>
