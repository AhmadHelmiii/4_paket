<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dokumentasi - Parking Excellence</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Inter', sans-serif; background: #f0f4f8; }
        ::-webkit-scrollbar { width: 5px; } ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 99px; }
        .topbar { background: #fff; border-bottom: 1px solid #e2e8f0; padding: 0 32px; height: 60px; display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: 100; }
        .topbar-brand { display: flex; align-items: center; gap: 10px; text-decoration: none; }
        .topbar-icon { width: 34px; height: 34px; background: linear-gradient(135deg,#2563eb,#1d4ed8); border-radius: 9px; display: flex; align-items: center; justify-content: center; }
        .topbar-title { font-size: 15px; font-weight: 800; color: #0f172a; }
        .topbar-sub { font-size: 11px; color: #94a3b8; }
        .content { max-width: 1200px; margin: 0 auto; padding: 28px 24px; }
        .card { background: #fff; border-radius: 16px; border: 1px solid #f1f5f9; box-shadow: 0 1px 3px rgba(0,0,0,0.04); }
        .stat-card { background: #fff; border-radius: 16px; border: 1px solid #f1f5f9; padding: 20px; box-shadow: 0 1px 3px rgba(0,0,0,0.04); }
        .badge { display: inline-flex; align-items: center; padding: 3px 10px; border-radius: 99px; font-size: 11.5px; font-weight: 600; }
        .table-row:hover td { background: #f8fafc; }
    </style>
</head>
<body>
    <header class="topbar">
        <a href="/dokumentasi" class="topbar-brand">
            <div class="topbar-icon">
                <i class="fa-solid fa-square-parking" style="color:#fff; font-size:15px;"></i>
            </div>
            <div>
                <div class="topbar-title">Parking Excellence</div>
                <div class="topbar-sub">Dokumentasi Sistem</div>
            </div>
        </a>
        @auth
        <a href="{{ route('dashboard') }}" style="font-size:13px; font-weight:600; color:#2563eb; text-decoration:none; padding:8px 16px; background:#eff6ff; border-radius:9px;">
            <i class="fa-solid fa-arrow-left" style="margin-right:6px;"></i>Kembali ke Aplikasi
        </a>
        @endauth
    </header>
    <div class="content">
        @yield('content')
    </div>
</body>
</html>
