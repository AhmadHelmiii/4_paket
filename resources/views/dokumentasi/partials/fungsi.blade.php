<div class="card" style="padding:24px; margin-top:16px;">
    <h2 style="font-size:15px; font-weight:700; color:#0f172a; margin-bottom:4px;">Dokumentasi Fungsi & Method</h2>
    <p style="font-size:12px; color:#94a3b8; margin-bottom:20px;">Deskripsi lengkap setiap fungsi utama pada modul program</p>

    <div style="display:flex; flex-direction:column; gap:10px;">
        @foreach([
            ['TbTransaksi::hitungBiaya()','Model','#7c3aed','Menghitung durasi parkir dalam jam (dibulatkan ke atas) dan total biaya berdasarkan tarif per jam.','Input: waktu_masuk (datetime), tarif_per_jam (decimal)','Output: array [durasi (int), biaya (decimal), keluar (datetime)]'],
            ['TbAreaParkir::sisaSlot()','Model','#059669','Mengembalikan jumlah slot parkir yang masih tersedia dengan mengurangi kapasitas dengan jumlah terisi.','Input: kapasitas (int), terisi (int)','Output: integer (sisa slot)'],
            ['TbAreaParkir::persentaseTerisi()','Model','#059669','Menghitung persentase penggunaan slot parkir dalam bentuk float 0-100.','Input: kapasitas (int), terisi (int)','Output: float (0.0 - 100.0)'],
            ['TbLogAktivitas::catat()','Model (static)','#dc2626','Mencatat aktivitas pengguna ke tabel log. Dipanggil di setiap aksi penting seperti login, CRUD, transaksi.','Input: id_user (int), aktivitas (string)','Output: void'],
            ['AuthController::login()','Controller','#2563eb','Memvalidasi kredensial user, mengecek status_aktif, membuat session, dan mencatat log login.','Input: Request (username, password)','Output: redirect dashboard / back with error'],
            ['AuthController::logout()','Controller','#2563eb','Mencatat log logout, menghapus session, dan redirect ke halaman login.','Input: Request','Output: redirect login'],
            ['TransaksiController::store()','Controller','#d97706','Memproses kendaraan masuk: validasi input, cek duplikat parkir, ambil tarif, upsert kendaraan, insert transaksi, increment slot area.','Input: Request (plat_nomor, jenis_kendaraan, id_area, warna, pemilik)','Output: redirect transaksi.index'],
            ['TransaksiController::checkout()','Controller','#d97706','Mencari kendaraan berdasarkan plat nomor dan menampilkan detail transaksi aktif beserta estimasi biaya.','Input: Request (plat_nomor via GET)','Output: view checkout dengan data transaksi'],
            ['TransaksiController::prosesCheckout()','Controller','#d97706','Memproses kendaraan keluar: hitung biaya final, update transaksi, decrement slot area, catat log.','Input: TbTransaksi (route model binding)','Output: redirect struk'],
            ['TransaksiController::cetakStruk()','Controller','#7c3aed','Generate PDF struk parkir menggunakan DomPDF dari view struk-pdf.blade.php dan stream ke browser.','Input: TbTransaksi (route model binding)','Output: PDF stream'],
            ['DashboardController::getChartData()','Controller (private)','#0284c7','Mengambil jumlah kendaraan masuk per jam untuk 24 jam hari ini, digunakan sebagai data Chart.js di dashboard.','Input: -','Output: array [labels (array string), data (array int)]'],
            ['LaporanController::index()','Controller','#059669','Menampilkan rekap transaksi dengan filter tanggal dan jenis kendaraan, termasuk rekapitulasi harian.','Input: Request (dari, sampai, jenis_kendaraan)','Output: view laporan dengan data transaksi & rekap'],
        ] as $fn)
        <div style="border:1px solid #f1f5f9; border-radius:12px; overflow:hidden;">
            <div style="background:{{ $fn[2] }}10; border-bottom:1px solid {{ $fn[2] }}20; padding:12px 16px; display:flex; align-items:center; justify-content:space-between; gap:12px;">
                <code style="font-size:13px; font-weight:700; color:{{ $fn[2] }}; font-family:monospace;">{{ $fn[0] }}</code>
                <span style="font-size:11px; background:{{ $fn[2] }}15; color:{{ $fn[2] }}; padding:3px 10px; border-radius:99px; white-space:nowrap; font-weight:600;">{{ $fn[1] }}</span>
            </div>
            <div style="padding:12px 16px;">
                <p style="font-size:13px; color:#374151; margin-bottom:8px;">{{ $fn[3] }}</p>
                <div style="display:flex; gap:16px; flex-wrap:wrap;">
                    <span style="font-size:11.5px; color:#64748b; background:#f8fafc; padding:4px 10px; border-radius:6px; font-family:monospace;">📥 {{ $fn[4] }}</span>
                    <span style="font-size:11.5px; color:#64748b; background:#f8fafc; padding:4px 10px; border-radius:6px; font-family:monospace;">📤 {{ $fn[5] }}</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
