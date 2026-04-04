<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Aplikasi Peminjaman Alat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/auth.css">
</head>
<body>

<div class="left-panel">
    <div class="badge-tag"><i class="bi bi-shield-check"></i> Sistem Manajemen Alat</div>
    <h1>Kelola Peminjaman<br>Alat dengan Mudah</h1>
    <p>Platform terpadu untuk mengelola inventaris, peminjaman, dan pengembalian alat secara efisien dan terorganisir.</p>
    <div class="feature-list">
        <div class="feature-item">
            <div class="icon-wrap"><i class="bi bi-tools"></i></div>
            <span>Manajemen inventaris alat real-time</span>
        </div>
        <div class="feature-item">
            <div class="icon-wrap"><i class="bi bi-clipboard-check"></i></div>
            <span>Proses peminjaman & persetujuan digital</span>
        </div>
        <div class="feature-item">
            <div class="icon-wrap"><i class="bi bi-bar-chart-line"></i></div>
            <span>Laporan & log aktivitas lengkap</span>
        </div>
        <div class="feature-item">
            <div class="icon-wrap"><i class="bi bi-people"></i></div>
            <span>3 level akses: Admin, Petugas, Peminjam</span>
        </div>
    </div>
</div>

<div class="right-panel">
    <div class="auth-box">
        <div class="brand-logo">
            <div class="logo-icon"><i class="bi bi-tools"></i></div>
            <div class="logo-text">
                <span class="logo-sub">Tool Management</span>
                <span class="logo-name">Peminjaman Alat</span>
            </div>
        </div>

        <h4 class="auth-title">Selamat Datang</h4>
        <p class="auth-subtitle">Masuk ke akun Anda untuk melanjutkan</p>

        @if($errors->any())
        <div class="alert-error">
            <i class="bi bi-exclamation-circle-fill"></i>
            <span>{{ $errors->first() }}</span>
        </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="field-group">
                <label class="field-label">Email</label>
                <div class="input-wrap">
                    <i class="bi bi-envelope field-icon"></i>
                    <input type="email" name="email" class="field-input"
                           value="{{ old('email') }}" placeholder="email@contoh.com" required autofocus>
                </div>
            </div>
            <div class="field-group">
                <label class="field-label">Password</label>
                <div class="input-wrap">
                    <i class="bi bi-lock field-icon"></i>
                    <input type="password" name="password" class="field-input"
                           placeholder="Masukkan password" required>
                </div>
            </div>
            <div class="remember-row">
                <label class="remember-label">
                    <input type="checkbox" name="remember"> Ingat saya
                </label>
            </div>
            <button type="submit" class="btn-auth">
                <i class="bi bi-box-arrow-in-right"></i> Masuk
            </button>
        </form>

        <div class="auth-divider"><span>atau</span></div>

        <p class="auth-switch">
            Belum punya akun?
            <a href="{{ route('register') }}">Daftar sebagai Peminjam</a>
        </p>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
