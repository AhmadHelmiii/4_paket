<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar — Aplikasi Peminjaman Alat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/auth.css">
</head>
<body>

<div class="left-panel">
    <div class="badge-tag"><i class="bi bi-person-plus"></i> Buat Akun Baru</div>
    <h1>Mulai Pinjam Alat<br>Sekarang</h1>
    <p>Buat akun dalam hitungan detik dan nikmati kemudahan meminjam alat kapan saja.</p>
    <div class="feature-list">
        <div class="feature-item">
            <div class="step-num">1</div>
            <div>
                <strong>Buat Akun</strong>
                <span>Isi nama, email, dan password kamu</span>
            </div>
        </div>
        <div class="feature-item">
            <div class="step-num">2</div>
            <div>
                <strong>Pilih Alat</strong>
                <span>Cari alat yang tersedia dari katalog</span>
            </div>
        </div>
        <div class="feature-item">
            <div class="step-num">3</div>
            <div>
                <strong>Ajukan Peminjaman</strong>
                <span>Kirim pengajuan dan tunggu persetujuan petugas</span>
            </div>
        </div>
        <div class="feature-item">
            <div class="step-num">4</div>
            <div>
                <strong>Ambil & Kembalikan</strong>
                <span>Ambil alat dan kembalikan tepat waktu</span>
            </div>
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

        <h4 class="auth-title">Buat Akun Baru</h4>
        <p class="auth-subtitle">Daftar dan mulai pinjam alat hari ini</p>

        <div class="role-pill">
            <i class="bi bi-person-check"></i> Akun Peminjam
        </div>

        @if($errors->any())
        <div class="alert-error">
            <i class="bi bi-exclamation-circle-fill"></i>
            <ul class="mb-0 ps-2">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="field-group">
                <label class="field-label">Nama Lengkap</label>
                <div class="input-wrap">
                    <i class="bi bi-person field-icon"></i>
                    <input type="text" name="name" class="field-input @error('name') is-invalid @enderror"
                           value="{{ old('name') }}" placeholder="Nama lengkap kamu" required autofocus>
                </div>
            </div>
            <div class="field-group">
                <label class="field-label">Email</label>
                <div class="input-wrap">
                    <i class="bi bi-envelope field-icon"></i>
                    <input type="email" name="email" class="field-input @error('email') is-invalid @enderror"
                           value="{{ old('email') }}" placeholder="email@contoh.com" required>
                </div>
            </div>
            <div class="field-group">
                <label class="field-label">Password</label>
                <div class="input-wrap">
                    <i class="bi bi-lock field-icon"></i>
                    <input type="password" name="password" class="field-input @error('password') is-invalid @enderror"
                           placeholder="Minimal 8 karakter" required>
                </div>
            </div>
            <div class="field-group">
                <label class="field-label">Konfirmasi Password</label>
                <div class="input-wrap">
                    <i class="bi bi-lock-fill field-icon"></i>
                    <input type="password" name="password_confirmation" class="field-input"
                           placeholder="Ulangi password" required>
                </div>
            </div>
            <button type="submit" class="btn-auth">
                <i class="bi bi-person-plus"></i> Daftar Sekarang
            </button>
        </form>

        <div class="auth-divider"><span>atau</span></div>

        <p class="auth-switch">
            Sudah punya akun?
            <a href="{{ route('login') }}">Masuk di sini</a>
        </p>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
