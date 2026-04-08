<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Parking Excellence')</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Inter', sans-serif; background: #f0f4f8; }
        [x-cloak] { display: none !important; }
        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 99px; }

        .app-wrap { display: flex; height: 100vh; overflow: hidden; }

        /* ── Sidebar ── */
        .sidebar {
            width: 240px;
            background: #fff;
            border-right: 1px solid #e8edf2;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            transition: width 0.25s ease;
        }
        .sidebar.collapsed { width: 64px; }

        .sidebar-logo {
            padding: 16px 14px;
            border-bottom: 1px solid #f1f5f9;
            flex-shrink: 0;
        }
        .sidebar-logo-inner { display: flex; align-items: center; gap: 10px; overflow: hidden; }
        .sidebar-logo-icon {
            width: 36px; height: 36px; flex-shrink: 0;
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            border-radius: 10px; display: flex; align-items: center; justify-content: center;
            box-shadow: 0 4px 12px rgba(37,99,235,0.3);
        }
        .sidebar-logo-text { overflow: hidden; white-space: nowrap; }
        .sidebar-logo-text .brand { color: #0f172a; font-weight: 800; font-size: 14px; line-height: 1.3; }
        .sidebar-logo-text .sub { color: #94a3b8; font-size: 11px; }

        .sidebar-user {
            padding: 12px 14px;
            border-bottom: 1px solid #f1f5f9;
            flex-shrink: 0;
            overflow: hidden;
        }
        .sidebar-user-inner { display: flex; align-items: center; gap: 10px; white-space: nowrap; }
        .sidebar-avatar {
            width: 34px; height: 34px; border-radius: 50%; flex-shrink: 0;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            display: flex; align-items: center; justify-content: center;
        }
        .sidebar-avatar span { color: #fff; font-weight: 700; font-size: 13px; }
        .sidebar-user-name { color: #0f172a; font-size: 13px; font-weight: 600; line-height: 1.3; }
        .sidebar-badge { font-size: 10.5px; font-weight: 600; padding: 2px 8px; border-radius: 99px; display: inline-block; margin-top: 2px; }
        .badge-admin   { background: #fee2e2; color: #991b1b; }
        .badge-petugas { background: #dcfce7; color: #166534; }
        .badge-owner   { background: #fef3c7; color: #92400e; }

        .sidebar-nav { flex: 1; overflow-y: auto; overflow-x: hidden; padding: 10px 8px; }

        .section-label {
            font-size: 10px; font-weight: 700; letter-spacing: 0.08em;
            text-transform: uppercase; color: #94a3b8;
            padding: 0 10px; margin: 14px 0 5px;
            white-space: nowrap; overflow: hidden;
        }

        .nav-item {
            display: flex; align-items: center; gap: 10px;
            padding: 9px 12px; border-radius: 10px;
            color: #64748b; font-size: 13.5px; font-weight: 500;
            transition: all 0.15s; text-decoration: none; white-space: nowrap;
            width: 100%; border: none; cursor: pointer; background: none;
        }
        .nav-item:hover { background: #f1f5f9; color: #0f172a; }
        .nav-item.active { background: linear-gradient(135deg, #2563eb, #1d4ed8); color: #fff; box-shadow: 0 4px 12px rgba(37,99,235,0.25); }
        .nav-item .icon { width: 18px; text-align: center; flex-shrink: 0; font-size: 14px; }
        .nav-item .label { overflow: hidden; }
        .nav-item.logout { color: #ef4444; }
        .nav-item.logout:hover { background: #fef2f2; color: #dc2626; }

        .sidebar-footer { padding: 10px 8px; border-top: 1px solid #f1f5f9; flex-shrink: 0; }

        /* ── Main ── */
        .main-wrap { flex: 1; display: flex; flex-direction: column; overflow: hidden; min-width: 0; }

        .topbar {
            background: #fff;
            border-bottom: 1px solid #e8edf2;
            padding: 0 24px;
            height: 60px;
            display: flex; align-items: center; justify-content: space-between;
            flex-shrink: 0;
        }
        .topbar-left { display: flex; align-items: center; gap: 14px; }
        .topbar-toggle {
            width: 34px; height: 34px; border-radius: 8px;
            border: 1.5px solid #e2e8f0; background: #f8fafc;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; color: #64748b; transition: all 0.15s;
        }
        .topbar-toggle:hover { background: #f1f5f9; }
        .topbar-title { font-size: 16px; font-weight: 700; color: #0f172a; line-height: 1.2; }
        .topbar-sub { font-size: 11.5px; color: #94a3b8; margin-top: 1px; }
        .topbar-right { display: flex; align-items: center; gap: 12px; }
        .topbar-date p:first-child { font-size: 12px; color: #64748b; font-weight: 500; text-align: right; }
        .topbar-date p:last-child  { font-size: 11px; color: #94a3b8; text-align: right; }
        .topbar-avatar {
            width: 36px; height: 36px; border-radius: 50%;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            display: flex; align-items: center; justify-content: center;
        }
        .topbar-avatar span { color: #fff; font-weight: 700; font-size: 13px; }

        .main-content { flex: 1; overflow-y: auto; padding: 24px; }

        /* ── Components ── */
        .card { background: #fff; border-radius: 16px; border: 1px solid #f1f5f9; box-shadow: 0 1px 3px rgba(0,0,0,0.04); }
        .stat-card { background: #fff; border-radius: 16px; border: 1px solid #f1f5f9; padding: 20px; box-shadow: 0 1px 3px rgba(0,0,0,0.04); transition: transform 0.2s, box-shadow 0.2s; }
        .stat-card:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(0,0,0,0.08); }

        .btn-primary { display: inline-flex; align-items: center; gap: 7px; background: linear-gradient(135deg, #2563eb, #1d4ed8); color: #fff; font-size: 13px; font-weight: 600; padding: 9px 18px; border-radius: 10px; border: none; cursor: pointer; transition: all 0.15s; text-decoration: none; box-shadow: 0 2px 8px rgba(37,99,235,0.3); }
        .btn-primary:hover { background: linear-gradient(135deg, #1d4ed8, #1e40af); transform: translateY(-1px); }
        .btn-success { display: inline-flex; align-items: center; gap: 7px; background: linear-gradient(135deg, #059669, #047857); color: #fff; font-size: 13px; font-weight: 600; padding: 9px 18px; border-radius: 10px; border: none; cursor: pointer; transition: all 0.15s; text-decoration: none; box-shadow: 0 2px 8px rgba(5,150,105,0.3); }
        .btn-success:hover { transform: translateY(-1px); }
        .btn-ghost { display: inline-flex; align-items: center; gap: 7px; background: #f8fafc; color: #475569; font-size: 13px; font-weight: 500; padding: 9px 18px; border-radius: 10px; border: 1.5px solid #e2e8f0; cursor: pointer; transition: all 0.15s; text-decoration: none; }
        .btn-ghost:hover { background: #f1f5f9; }

        .input-field { width: 100%; border: 1.5px solid #e2e8f0; border-radius: 10px; padding: 9px 14px; font-size: 13.5px; color: #1e293b; background: #fff; transition: all 0.15s; outline: none; font-family: 'Inter', sans-serif; }
        .input-field:focus { border-color: #2563eb; box-shadow: 0 0 0 3px rgba(37,99,235,0.1); }
        select.input-field { cursor: pointer; }

        .badge { display: inline-flex; align-items: center; padding: 3px 10px; border-radius: 99px; font-size: 11.5px; font-weight: 600; }
        .table-row:hover td { background: #f8fafc; }

        .flash-success { display: flex; align-items: center; gap: 10px; background: #f0fdf4; border: 1.5px solid #bbf7d0; color: #166534; padding: 12px 16px; border-radius: 12px; font-size: 13.5px; margin-bottom: 16px; }
        .flash-error   { display: flex; align-items: center; gap: 10px; background: #fef2f2; border: 1.5px solid #fecaca; color: #991b1b; padding: 12px 16px; border-radius: 12px; font-size: 13.5px; margin-bottom: 16px; }
        .flash-btn { margin-left: auto; background: none; border: none; cursor: pointer; font-size: 14px; }
    </style>
</head>
<body>
<div class="app-wrap" x-data="{ open: true }">

    {{-- SIDEBAR --}}
    <aside class="sidebar" :class="{ 'collapsed': !open }">

        <div class="sidebar-logo">
            <div class="sidebar-logo-inner">
                <div class="sidebar-logo-icon">
                    <i class="fa-solid fa-square-parking" style="color:#fff; font-size:16px;"></i>
                </div>
                <div class="sidebar-logo-text" x-show="open">
                    <div class="brand">Parking Excellence</div>
                    <div class="sub">Management System</div>
                </div>
            </div>
        </div>

        <div class="sidebar-user" x-show="open">
            <div class="sidebar-user-inner">
                <div class="sidebar-avatar">
                    <span>{{ strtoupper(substr(Auth::user()->nama_lengkap, 0, 1)) }}</span>
                </div>
                <div>
                    <div class="sidebar-user-name">{{ Auth::user()->nama_lengkap }}</div>
                    <span class="sidebar-badge {{ Auth::user()->role === 'admin' ? 'badge-admin' : (Auth::user()->role === 'petugas' ? 'badge-petugas' : 'badge-owner') }}">
                        {{ ucfirst(Auth::user()->role) }}
                    </span>
                </div>
            </div>
        </div>

        <nav class="sidebar-nav">
            <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-gauge-high icon"></i>
                <span class="label" x-show="open">Dashboard</span>
            </a>

            @if(Auth::user()->isAdmin())
            <div class="section-label" x-show="open">Admin</div>
            <a href="{{ route('admin.user.index') }}" class="nav-item {{ request()->routeIs('admin.user.*') ? 'active' : '' }}">
                <i class="fa-solid fa-users icon"></i>
                <span class="label" x-show="open">Manajemen User</span>
            </a>
            <a href="{{ route('admin.tarif.index') }}" class="nav-item {{ request()->routeIs('admin.tarif.*') ? 'active' : '' }}">
                <i class="fa-solid fa-tags icon"></i>
                <span class="label" x-show="open">Tarif Parkir</span>
            </a>
            <a href="{{ route('admin.area.index') }}" class="nav-item {{ request()->routeIs('admin.area.*') ? 'active' : '' }}">
                <i class="fa-solid fa-map-location-dot icon"></i>
                <span class="label" x-show="open">Area Parkir</span>
            </a>
            <a href="{{ route('admin.kendaraan.index') }}" class="nav-item {{ request()->routeIs('admin.kendaraan.*') ? 'active' : '' }}">
                <i class="fa-solid fa-car icon"></i>
                <span class="label" x-show="open">Data Kendaraan</span>
            </a>
            <a href="{{ route('admin.log.index') }}" class="nav-item {{ request()->routeIs('admin.log.*') ? 'active' : '' }}">
                <i class="fa-solid fa-clipboard-list icon"></i>
                <span class="label" x-show="open">Log Aktivitas</span>
            </a>
            @endif

            @if(Auth::user()->isPetugas())
            <div class="section-label" x-show="open">Petugas</div>
            <a href="{{ route('petugas.transaksi.index') }}" class="nav-item {{ request()->routeIs('petugas.transaksi.*') ? 'active' : '' }}">
                <i class="fa-solid fa-right-left icon"></i>
                <span class="label" x-show="open">Transaksi</span>
            </a>
            @endif

            @if(Auth::user()->isOwner())
            <div class="section-label" x-show="open">Owner</div>
            <a href="{{ route('owner.laporan.index') }}" class="nav-item {{ request()->routeIs('owner.laporan.*') ? 'active' : '' }}">
                <i class="fa-solid fa-chart-bar icon"></i>
                <span class="label" x-show="open">Laporan & Rekap</span>
            </a>
            @endif
        </nav>

        <div class="sidebar-footer">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="nav-item logout" style="width:100%;">
                    <i class="fa-solid fa-right-from-bracket icon"></i>
                    <span class="label" x-show="open">Logout</span>
                </button>
            </form>
        </div>
    </aside>

    {{-- MAIN --}}
    <div class="main-wrap">
        <header class="topbar">
            <div class="topbar-left">
                <button class="topbar-toggle" @click="open = !open">
                    <i class="fa-solid fa-bars" style="font-size:13px;"></i>
                </button>
                <div>
                    <div class="topbar-title">@yield('page-title', 'Dashboard')</div>
                    <div class="topbar-sub">@yield('page-subtitle', '')</div>
                </div>
            </div>
            <div class="topbar-right">
                <div class="topbar-date">
                    <p>{{ now()->isoFormat('dddd') }}</p>
                    <p>{{ now()->isoFormat('D MMMM Y') }}</p>
                </div>
                <div class="topbar-avatar">
                    <span>{{ strtoupper(substr(Auth::user()->nama_lengkap, 0, 1)) }}</span>
                </div>
            </div>
        </header>

        <main class="main-content">
            @if(session('success'))
            <div class="flash-success" x-data="{show:true}" x-show="show" x-init="setTimeout(()=>show=false,4000)">
                <i class="fa-solid fa-circle-check" style="color:#22c55e; flex-shrink:0;"></i>
                <span>{{ session('success') }}</span>
                <button class="flash-btn" @click="show=false" style="color:#86efac;"><i class="fa-solid fa-xmark"></i></button>
            </div>
            @endif
            @if(session('error'))
            <div class="flash-error" x-data="{show:true}" x-show="show" x-init="setTimeout(()=>show=false,5000)">
                <i class="fa-solid fa-circle-xmark" style="color:#ef4444; flex-shrink:0;"></i>
                <span>{{ session('error') }}</span>
                <button class="flash-btn" @click="show=false" style="color:#fca5a5;"><i class="fa-solid fa-xmark"></i></button>
            </div>
            @endif

            @yield('content')
        </main>
    </div>
</div>
</body>
</html>
