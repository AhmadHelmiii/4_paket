<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Aplikasi Peminjaman Alat')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/app.css">
    @stack('styles')
</head>
<body>

{{-- ===== SIDEBAR ===== --}}
<aside class="sidebar">
    <div class="sidebar-brand">
        <div class="brand-icon"><i class="bi bi-tools"></i></div>
        <div class="brand-text">
            <span class="brand-sub">Tool Management</span>
            <span class="brand-name">Peminjaman Alat</span>
        </div>
    </div>

    <nav class="sidebar-nav">
        <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="bi bi-grid-1x2"></i> Dashboard
        </a>

        @if(auth()->user()->isAdmin() || auth()->user()->isPetugas())
        <a href="{{ route('alat.index') }}" class="nav-item {{ request()->routeIs('alat.*') ? 'active' : '' }}">
            <i class="bi bi-tools"></i> Data Alat
        </a>
        @endif

        @if(auth()->user()->isPeminjam())
        <a href="{{ route('alat.index') }}" class="nav-item {{ request()->routeIs('alat.*') ? 'active' : '' }}">
            <i class="bi bi-tools"></i> Daftar Alat
        </a>
        @endif

        <a href="{{ route('peminjaman.index') }}" class="nav-item {{ request()->routeIs('peminjaman.*') ? 'active' : '' }}">
            <i class="bi bi-clipboard-check"></i> Peminjaman
            @php $pending = \App\Models\Peminjaman::where('status','menunggu')->count(); @endphp
            @if($pending > 0 && !auth()->user()->isPeminjam())
            <span class="nav-badge">{{ $pending }}</span>
            @endif
        </a>

        @if(auth()->user()->isAdmin() || auth()->user()->isPetugas())
        <a href="{{ route('pengembalian.index') }}" class="nav-item {{ request()->routeIs('pengembalian.*') ? 'active' : '' }}">
            <i class="bi bi-arrow-return-left"></i> Pengembalian
        </a>
        <a href="{{ route('laporan.index') }}" class="nav-item {{ request()->routeIs('laporan.*') ? 'active' : '' }}">
            <i class="bi bi-bar-chart-line"></i> Laporan
        </a>
        @endif

        @if(auth()->user()->isAdmin())
        <div class="nav-section-label">Admin</div>
        <a href="{{ route('admin.users.index') }}" class="nav-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
            <i class="bi bi-people"></i> Manajemen User
        </a>
        <a href="{{ route('admin.kategori.index') }}" class="nav-item {{ request()->routeIs('admin.kategori.*') ? 'active' : '' }}">
            <i class="bi bi-tags"></i> Kategori Alat
        </a>
        <a href="{{ route('pengembalian.semua') }}" class="nav-item {{ request()->routeIs('pengembalian.semua') ? 'active' : '' }}">
            <i class="bi bi-clock-history"></i> Riwayat Pengembalian
        </a>
        <a href="{{ route('admin.log.index') }}" class="nav-item {{ request()->routeIs('admin.log.*') ? 'active' : '' }}">
            <i class="bi bi-activity"></i> Log Aktivitas
        </a>
        @endif
    </nav>

    <div class="sidebar-footer">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-logout">
                <i class="bi bi-box-arrow-left"></i> Keluar
            </button>
        </form>
    </div>
</aside>

{{-- ===== MAIN ===== --}}
<div class="main-content">

    {{-- Topbar --}}
    <header class="topbar">
        <div class="topbar-search">
            <i class="bi bi-search"></i>
            <input type="text" placeholder="Cari alat atau peminjam...">
        </div>
        <div class="topbar-right">
            <a href="#" class="topbar-icon-btn"><i class="bi bi-bell"></i></a>
            <a href="#" class="topbar-icon-btn"><i class="bi bi-question-circle"></i></a>
            <div class="topbar-user">
                <div class="topbar-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</div>
                <div class="topbar-user-info">
                    <span class="topbar-user-name">{{ auth()->user()->name }}</span>
                    <span class="topbar-user-role">{{ auth()->user()->role }}</span>
                </div>
            </div>
        </div>
    </header>

    {{-- Page Content --}}
    <main class="page-content">

        {{-- Flash messages --}}
        @if(session('success'))
        <div class="alert-wrap">
            <div class="alert-success-custom">
                <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
            </div>
        </div>
        @endif
        @if(session('error'))
        <div class="alert-wrap">
            <div class="alert-error-custom">
                <i class="bi bi-exclamation-circle-fill"></i> {{ session('error') }}
            </div>
        </div>
        @endif
        @if($errors->any())
        <div class="alert-wrap">
            <div class="alert-error-custom" style="align-items:flex-start;">
                <i class="bi bi-exclamation-triangle-fill" style="margin-top:2px;flex-shrink:0;"></i>
                <ul style="margin:0;padding-left:1rem;">
                    @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
                </ul>
            </div>
        </div>
        @endif

        @yield('content')
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
