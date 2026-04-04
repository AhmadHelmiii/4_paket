<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Login — Aplikasi Peminjaman Alat')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
        }
        .auth-card {
            background: #fff;
            border-radius: 1rem;
            padding: 2.5rem;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 20px 60px rgba(0,0,0,.15);
        }
        .auth-logo { color: #4f46e5; font-weight: 800; font-size: 1.4rem; }
        .auth-logo span { color: #7c3aed; }
        .form-control:focus { border-color: #4f46e5; box-shadow: 0 0 0 .2rem rgba(79,70,229,.15); }
        .btn-auth { background: #4f46e5; border: none; padding: .65rem; font-weight: 600; }
        .btn-auth:hover { background: #3730a3; }
    </style>
</head>
<body>
    <div class="auth-card">
        <div class="text-center mb-4">
            <div class="auth-logo mb-1"><i class="bi bi-tools"></i> Peminjaman<span>Alat</span></div>
            <p class="text-muted small mb-0">Sistem Manajemen Peminjaman Alat</p>
        </div>
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
