<div class="card" style="padding:24px; margin-top:16px;">
    <h2 style="font-size:15px; font-weight:700; color:#0f172a; margin-bottom:4px;">Use Case Diagram</h2>
    <p style="font-size:12px; color:#94a3b8; margin-bottom:20px;">Interaksi aktor dengan fitur sistem aplikasi parkir</p>

    <div style="overflow-x:auto;">
    <svg width="1000" height="640" viewBox="0 0 1000 640" xmlns="http://www.w3.org/2000/svg" style="font-family:Inter,sans-serif; min-width:1000px;">
        <defs>
            <marker id="uc_arr" markerWidth="8" markerHeight="8" refX="6" refY="3" orient="auto">
                <path d="M0,0 L0,6 L8,3 z" fill="#94a3b8"/>
            </marker>
            <filter id="uc_shadow">
                <feDropShadow dx="0" dy="2" stdDeviation="3" flood-color="rgba(0,0,0,0.07)"/>
            </filter>
        </defs>

        <!-- System Boundary -->
        <rect x="160" y="40" width="680" height="560" rx="18" fill="#f8fafc" stroke="#cbd5e1" stroke-width="2" stroke-dasharray="10,5"/>
        <text x="500" y="72" text-anchor="middle" fill="#94a3b8" font-size="13" font-weight="700" letter-spacing="1">SISTEM APLIKASI PARKIR</text>

        <!-- ===== USE CASES ===== -->

        <!-- Login / Logout (tengah atas, semua role) -->
        <ellipse cx="500" cy="120" rx="80" ry="24" fill="#fff" stroke="#0f172a" stroke-width="2" filter="url(#uc_shadow)"/>
        <text x="500" y="125" text-anchor="middle" fill="#0f172a" font-size="12" font-weight="700">Login / Logout</text>

        <!-- ===== ADMIN USE CASES (kiri) ===== -->
        <ellipse cx="310" cy="210" rx="80" ry="22" fill="#fff" stroke="#dc2626" stroke-width="1.5" filter="url(#uc_shadow)"/>
        <text x="310" y="215" text-anchor="middle" fill="#dc2626" font-size="11.5" font-weight="600">Kelola User</text>

        <ellipse cx="310" cy="280" rx="80" ry="22" fill="#fff" stroke="#dc2626" stroke-width="1.5" filter="url(#uc_shadow)"/>
        <text x="310" y="285" text-anchor="middle" fill="#dc2626" font-size="11.5" font-weight="600">Kelola Tarif Parkir</text>

        <ellipse cx="310" cy="350" rx="80" ry="22" fill="#fff" stroke="#dc2626" stroke-width="1.5" filter="url(#uc_shadow)"/>
        <text x="310" y="355" text-anchor="middle" fill="#dc2626" font-size="11.5" font-weight="600">Kelola Area Parkir</text>

        <ellipse cx="310" cy="420" rx="80" ry="22" fill="#fff" stroke="#dc2626" stroke-width="1.5" filter="url(#uc_shadow)"/>
        <text x="310" y="425" text-anchor="middle" fill="#dc2626" font-size="11.5" font-weight="600">Kelola Kendaraan</text>

        <ellipse cx="310" cy="490" rx="80" ry="22" fill="#fff" stroke="#dc2626" stroke-width="1.5" filter="url(#uc_shadow)"/>
        <text x="310" y="495" text-anchor="middle" fill="#dc2626" font-size="11.5" font-weight="600">Lihat Log Aktivitas</text>

        <!-- ===== PETUGAS USE CASES (kanan atas) ===== -->
        <ellipse cx="690" cy="230" rx="85" ry="22" fill="#fff" stroke="#059669" stroke-width="1.5" filter="url(#uc_shadow)"/>
        <text x="690" y="235" text-anchor="middle" fill="#059669" font-size="11.5" font-weight="600">Catat Kendaraan Masuk</text>

        <ellipse cx="690" cy="310" rx="85" ry="22" fill="#fff" stroke="#059669" stroke-width="1.5" filter="url(#uc_shadow)"/>
        <text x="690" y="315" text-anchor="middle" fill="#059669" font-size="11.5" font-weight="600">Catat Kendaraan Keluar</text>

        <ellipse cx="690" cy="390" rx="85" ry="22" fill="#fff" stroke="#059669" stroke-width="1.5" filter="url(#uc_shadow)"/>
        <text x="690" y="395" text-anchor="middle" fill="#059669" font-size="11.5" font-weight="600">Cetak Struk Parkir</text>

        <!-- ===== OWNER USE CASES (bawah tengah) ===== -->
        <ellipse cx="500" cy="530" rx="110" ry="24" fill="#fff" stroke="#d97706" stroke-width="1.5" filter="url(#uc_shadow)"/>
        <text x="500" y="527" text-anchor="middle" fill="#d97706" font-size="11.5" font-weight="600">Lihat Rekap &amp; Laporan</text>
        <text x="500" y="542" text-anchor="middle" fill="#d97706" font-size="10" font-weight="500">Sesuai Rentang Waktu</text>

        <!-- ===== ACTORS ===== -->

        <!-- Admin (kiri) -->
        <g>
            <circle cx="70" cy="330" r="22" fill="#fee2e2" stroke="#dc2626" stroke-width="2"/>
            <text x="70" y="337" text-anchor="middle" font-size="18">👤</text>
            <line x1="70" y1="352" x2="70" y2="395" stroke="#dc2626" stroke-width="2"/>
            <line x1="40" y1="368" x2="100" y2="368" stroke="#dc2626" stroke-width="2"/>
            <line x1="70" y1="395" x2="48" y2="425" stroke="#dc2626" stroke-width="2"/>
            <line x1="70" y1="395" x2="92" y2="425" stroke="#dc2626" stroke-width="2"/>
            <text x="70" y="448" text-anchor="middle" fill="#dc2626" font-size="13" font-weight="800">Admin</text>
        </g>

        <!-- Petugas (kanan) -->
        <g>
            <circle cx="930" cy="310" r="22" fill="#dcfce7" stroke="#059669" stroke-width="2"/>
            <text x="930" y="317" text-anchor="middle" font-size="18">👤</text>
            <line x1="930" y1="332" x2="930" y2="375" stroke="#059669" stroke-width="2"/>
            <line x1="900" y1="348" x2="960" y2="348" stroke="#059669" stroke-width="2"/>
            <line x1="930" y1="375" x2="908" y2="405" stroke="#059669" stroke-width="2"/>
            <line x1="930" y1="375" x2="952" y2="405" stroke="#059669" stroke-width="2"/>
            <text x="930" y="428" text-anchor="middle" fill="#059669" font-size="13" font-weight="800">Petugas</text>
        </g>

        <!-- Owner (bawah) -->
        <g>
            <circle cx="500" cy="590" r="22" fill="#fef3c7" stroke="#d97706" stroke-width="2"/>
            <text x="500" y="597" text-anchor="middle" font-size="18">👤</text>
            <line x1="500" y1="612" x2="500" y2="628" stroke="#d97706" stroke-width="2"/>
            <text x="500" y="642" text-anchor="middle" fill="#d97706" font-size="13" font-weight="800">Owner</text>
        </g>

        <!-- ===== LINES: All → Login/Logout ===== -->
        <line x1="92" y1="320" x2="420" y2="128" stroke="#94a3b8" stroke-width="1.2" stroke-dasharray="5,3" marker-end="url(#uc_arr)"/>
        <line x1="908" y1="300" x2="580" y2="128" stroke="#94a3b8" stroke-width="1.2" stroke-dasharray="5,3" marker-end="url(#uc_arr)"/>
        <line x1="500" y1="590" x2="500" y2="554" stroke="#94a3b8" stroke-width="1.2" stroke-dasharray="5,3" marker-end="url(#uc_arr)"/>

        <!-- ===== LINES: Admin → use cases ===== -->
        <line x1="92" y1="315" x2="230" y2="215" stroke="#dc2626" stroke-width="1.3" marker-end="url(#uc_arr)"/>
        <line x1="92" y1="325" x2="230" y2="283" stroke="#dc2626" stroke-width="1.3" marker-end="url(#uc_arr)"/>
        <line x1="92" y1="335" x2="230" y2="352" stroke="#dc2626" stroke-width="1.3" marker-end="url(#uc_arr)"/>
        <line x1="92" y1="345" x2="230" y2="422" stroke="#dc2626" stroke-width="1.3" marker-end="url(#uc_arr)"/>
        <line x1="92" y1="355" x2="230" y2="492" stroke="#dc2626" stroke-width="1.3" marker-end="url(#uc_arr)"/>

        <!-- ===== LINES: Petugas → use cases ===== -->
        <line x1="908" y1="295" x2="775" y2="235" stroke="#059669" stroke-width="1.3" marker-end="url(#uc_arr)"/>
        <line x1="908" y1="310" x2="775" y2="312" stroke="#059669" stroke-width="1.3" marker-end="url(#uc_arr)"/>
        <line x1="908" y1="325" x2="775" y2="392" stroke="#059669" stroke-width="1.3" marker-end="url(#uc_arr)"/>

        <!-- ===== LINES: Owner → Rekap ===== -->
        <line x1="500" y1="590" x2="500" y2="554" stroke="#d97706" stroke-width="1.3" marker-end="url(#uc_arr)"/>

        <!-- ===== LEGEND ===== -->
        <rect x="165" y="580" width="320" height="36" rx="8" fill="#fff" stroke="#f1f5f9" stroke-width="1"/>
        <circle cx="185" cy="598" r="6" fill="#fee2e2" stroke="#dc2626" stroke-width="1.5"/>
        <text x="196" y="602" fill="#64748b" font-size="10.5">Admin</text>
        <circle cx="240" cy="598" r="6" fill="#dcfce7" stroke="#059669" stroke-width="1.5"/>
        <text x="251" y="602" fill="#64748b" font-size="10.5">Petugas</text>
        <circle cx="305" cy="598" r="6" fill="#fef3c7" stroke="#d97706" stroke-width="1.5"/>
        <text x="316" y="602" fill="#64748b" font-size="10.5">Owner</text>
        <line x1="360" y1="598" x2="378" y2="598" stroke="#94a3b8" stroke-width="1.2" stroke-dasharray="4,2"/>
        <text x="382" y="602" fill="#64748b" font-size="10.5">Semua Role</text>
    </svg>
    </div>
</div>
