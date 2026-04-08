<div style="display:flex; flex-direction:column; gap:16px;">

    <div class="card" style="padding:24px;">
        <h2 style="font-size:15px; font-weight:700; color:#0f172a; margin-bottom:4px;">Dokumentasi Debugging</h2>
        <p style="font-size:12px; color:#94a3b8; margin-bottom:20px;">Catatan error yang ditemukan selama pengembangan dan cara penyelesaiannya</p>

        <div style="display:flex; flex-direction:column; gap:12px;">

            @php
            $bugs = [
                [
                    'no' => 1,
                    'error' => 'PHP Fatal error: Composer detected issues in your platform: Your Composer dependencies require a PHP version >= 8.3.0',
                    'lokasi' => 'vendor/composer/platform_check.php',
                    'penyebab' => 'PHP yang aktif di terminal adalah versi 8.2.30 (dari FlyEnv), sedangkan project Laravel membutuhkan PHP >= 8.3.0.',
                    'solusi' => 'Mengganti PHP aktif ke versi 8.3 melalui Laragon (klik kanan → PHP → php-8.3.30), kemudian menjalankan perintah artisan dari terminal Laragon bukan dari terminal IDE.',
                    'status' => 'fixed',
                ],
                [
                    'no' => 2,
                    'error' => 'SQLSTATE[42S02]: Base table or view not found: 1146 Table aplikasi-parkir.tb_user doesn\'t exist',
                    'lokasi' => 'app/Http/Controllers/AuthController.php:32',
                    'penyebab' => 'Migration untuk tabel-tabel custom (tb_user, tb_kendaraan, dll) belum dijalankan. Hanya migration bawaan Laravel yang sudah berjalan.',
                    'solusi' => 'Menjalankan php artisan migrate dari terminal Laragon untuk membuat semua tabel custom sesuai migration yang telah dibuat.',
                    'status' => 'fixed',
                ],
                [
                    'no' => 3,
                    'error' => 'Symfony\Component\Routing\Exception\RouteNotFoundException: Route [transaksi.index] not defined',
                    'lokasi' => 'app/Http/Controllers/TransaksiController.php',
                    'penyebab' => 'Route transaksi menggunakan prefix petugas sehingga nama route yang benar adalah petugas.transaksi.index, bukan transaksi.index.',
                    'solusi' => 'Mengubah semua redirect di TransaksiController dari route(\'transaksi.index\') menjadi route(\'petugas.transaksi.index\') dan route(\'petugas.transaksi.struk\').',
                    'status' => 'fixed',
                ],
                [
                    'no' => 4,
                    'error' => 'Halaman kendaraan keluar tidak menampilkan hasil pencarian kendaraan',
                    'lokasi' => 'app/Http/Controllers/TransaksiController.php - method checkout()',
                    'penyebab' => 'Method checkout() menggunakan $request->validate() yang melempar exception saat plat_nomor kosong (GET request pertama kali), sehingga halaman tidak bisa dibuka tanpa parameter.',
                    'solusi' => 'Mengubah logic checkout() agar hanya memproses pencarian jika $request->filled(\'plat_nomor\'), dan mengembalikan view dengan variabel null jika belum ada input.',
                    'status' => 'fixed',
                ],
                [
                    'no' => 5,
                    'error' => 'Tampilan sidebar berantakan - teks menu numpuk dan warna background tidak sesuai',
                    'lokasi' => 'resources/views/layouts/app.blade.php',
                    'penyebab' => 'Tailwind CSS CDN melakukan override pada class @apply di dalam tag <style>, sehingga style sidebar tidak ter-apply dengan benar.',
                    'solusi' => 'Menghapus Tailwind CDN dan menggantinya dengan pure CSS menggunakan class dan inline style yang tidak bisa di-override.',
                    'status' => 'fixed',
                ],
                [
                    'no' => 6,
                    'error' => 'Cetak struk PDF menghasilkan error: Target class [dompdf.wrapper] does not exist',
                    'lokasi' => 'app/Http/Controllers/TransaksiController.php - method cetakStruk()',
                    'penyebab' => 'Package barryvdh/laravel-dompdf belum diinstall via Composer.',
                    'solusi' => 'Menjalankan composer require barryvdh/laravel-dompdf dari terminal Laragon untuk menginstall package DomPDF.',
                    'status' => 'pending',
                ],
            ];
            @endphp

            @foreach($bugs as $bug)
            <div style="border:1px solid #f1f5f9; border-radius:12px; overflow:hidden;">
                <div style="display:flex; align-items:center; justify-content:space-between; padding:12px 16px; background:{{ $bug['status'] === 'fixed' ? '#f0fdf4' : '#fef2f2' }}; border-bottom:1px solid #f1f5f9;">
                    <div style="display:flex; align-items:center; gap:10px;">
                        <span style="width:24px; height:24px; border-radius:50%; background:{{ $bug['status'] === 'fixed' ? '#22c55e' : '#ef4444' }}; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                            <i class="fa-solid {{ $bug['status'] === 'fixed' ? 'fa-check' : 'fa-clock' }}" style="color:#fff; font-size:10px;"></i>
                        </span>
                        <span style="font-size:13px; font-weight:700; color:#0f172a;">Bug #{{ $bug['no'] }}</span>
                    </div>
                    <span style="font-size:11px; font-weight:700; padding:3px 10px; border-radius:99px; background:{{ $bug['status'] === 'fixed' ? '#dcfce7' : '#fee2e2' }}; color:{{ $bug['status'] === 'fixed' ? '#166534' : '#991b1b' }};">
                        {{ $bug['status'] === 'fixed' ? '✓ Terselesaikan' : '⏳ Pending' }}
                    </span>
                </div>
                <div style="padding:14px 16px; display:flex; flex-direction:column; gap:10px;">
                    <div>
                        <p style="font-size:10.5px; font-weight:700; color:#94a3b8; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:4px;">Pesan Error</p>
                        <code style="font-size:12px; color:#dc2626; background:#fef2f2; padding:6px 10px; border-radius:6px; display:block; font-family:monospace; line-height:1.5;">{{ $bug['error'] }}</code>
                    </div>
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:10px;">
                        <div>
                            <p style="font-size:10.5px; font-weight:700; color:#94a3b8; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:4px;">Lokasi</p>
                            <code style="font-size:11.5px; color:#475569; background:#f8fafc; padding:5px 10px; border-radius:6px; display:block; font-family:monospace;">{{ $bug['lokasi'] }}</code>
                        </div>
                        <div>
                            <p style="font-size:10.5px; font-weight:700; color:#94a3b8; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:4px;">Penyebab</p>
                            <p style="font-size:12.5px; color:#374151; line-height:1.5;">{{ $bug['penyebab'] }}</p>
                        </div>
                    </div>
                    <div>
                        <p style="font-size:10.5px; font-weight:700; color:#94a3b8; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:4px;">Solusi</p>
                        <p style="font-size:12.5px; color:#374151; line-height:1.5; background:#f0fdf4; padding:8px 12px; border-radius:8px; border-left:3px solid #22c55e;">{{ $bug['solusi'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>
