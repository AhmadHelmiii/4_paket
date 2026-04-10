@extends('layouts.app')
@section('title', 'Manajemen User')
@section('page-title', 'Manajemen User')
@section('page-subtitle', 'Kelola akun pengguna sistem')

@section('content')
@php
    $totalUsers   = $users->total();
    $totalAdmin   = \App\Models\TbUser::where('role','admin')->count();
    $totalOwner   = \App\Models\TbUser::where('role','owner')->count();
    $totalPetugas = \App\Models\TbUser::where('role','petugas')->count();
@endphp

<div style="display:flex; flex-direction:column; gap:20px;">

    {{-- Header + Tambah --}}
    <div style="display:flex; align-items:center; justify-content:space-between;">
        <div>
            <h2 style="font-size:22px; font-weight:800; color:#0f172a; margin:0;">Manajemen User</h2>
            <p style="font-size:13px; color:#94a3b8; margin:3px 0 0;">Kelola akses dan kredensial pengguna sistem</p>
        </div>
        <a href="{{ route('admin.user.create') }}" class="btn-primary" style="display:flex; align-items:center; gap:8px; padding:10px 20px; font-size:13.5px;">
            <i class="fa-solid fa-user-plus"></i> Tambah User
        </a>
    </div>

    {{-- Stat Cards --}}
    <div style="display:grid; grid-template-columns:repeat(4,1fr); gap:14px;">
        <div class="card" style="padding:18px 20px;">
            <p style="font-size:11px; font-weight:700; color:#94a3b8; text-transform:uppercase; letter-spacing:0.06em; margin:0 0 8px;">Total Users</p>
            <p style="font-size:28px; font-weight:800; color:#0f172a; margin:0; line-height:1;">{{ $totalUsers }}</p>
        </div>
        <div class="card" style="padding:18px 20px; border-top:3px solid #ef4444;">
            <p style="font-size:11px; font-weight:700; color:#94a3b8; text-transform:uppercase; letter-spacing:0.06em; margin:0 0 8px;">Admin</p>
            <p style="font-size:28px; font-weight:800; color:#ef4444; margin:0; line-height:1;">{{ $totalAdmin }}</p>
        </div>
        <div class="card" style="padding:18px 20px; border-top:3px solid #f59e0b;">
            <p style="font-size:11px; font-weight:700; color:#94a3b8; text-transform:uppercase; letter-spacing:0.06em; margin:0 0 8px;">Owner</p>
            <p style="font-size:28px; font-weight:800; color:#f59e0b; margin:0; line-height:1;">{{ $totalOwner }}</p>
        </div>
        <div class="card" style="padding:18px 20px; border-top:3px solid #22c55e;">
            <p style="font-size:11px; font-weight:700; color:#94a3b8; text-transform:uppercase; letter-spacing:0.06em; margin:0 0 8px;">Petugas</p>
            <p style="font-size:28px; font-weight:800; color:#22c55e; margin:0; line-height:1;">{{ $totalPetugas }}</p>
        </div>
    </div>

    {{-- Search & Filter --}}
    <div class="card" style="padding:16px 20px;">
        <form method="GET" action="{{ route('admin.user.index') }}" style="display:flex; gap:10px; align-items:center; flex-wrap:wrap;">
            <div style="position:relative; flex:1; min-width:200px;">
                <i class="fa-solid fa-search" style="position:absolute; left:12px; top:50%; transform:translateY(-50%); color:#94a3b8; font-size:13px;"></i>
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Cari nama atau username..."
                       style="width:100%; padding:9px 12px 9px 36px; border:1.5px solid #e2e8f0; border-radius:10px; font-size:13.5px; outline:none; transition:all 0.15s; background:#f8fafc; box-sizing:border-box;"
                       onfocus="this.style.borderColor='#2563eb';this.style.background='#fff'"
                       onblur="this.style.borderColor='#e2e8f0';this.style.background='#f8fafc'">
            </div>
            <select name="role" onchange="this.form.submit()"
                    style="padding:9px 14px; border:1.5px solid #e2e8f0; border-radius:10px; font-size:13.5px; color:#374151; background:#f8fafc; outline:none; cursor:pointer;">
                <option value="">Semua Role</option>
                <option value="admin"   {{ request('role') === 'admin'   ? 'selected' : '' }}>Admin</option>
                <option value="petugas" {{ request('role') === 'petugas' ? 'selected' : '' }}>Petugas</option>
                <option value="owner"   {{ request('role') === 'owner'   ? 'selected' : '' }}>Owner</option>
            </select>
            <button type="submit" class="btn-primary" style="padding:9px 18px;">
                <i class="fa-solid fa-search"></i> Cari
            </button>
            @if(request('search') || request('role'))
            <a href="{{ route('admin.user.index') }}" style="padding:9px 14px; border:1.5px solid #e2e8f0; border-radius:10px; font-size:13px; color:#64748b; text-decoration:none; background:#f8fafc;">
                <i class="fa-solid fa-xmark"></i> Reset
            </a>
            @endif
        </form>
    </div>

    {{-- Result count --}}
    <div style="font-size:13px; color:#64748b; font-weight:500; padding:0 2px;">
        Menampilkan <strong style="color:#0f172a;">{{ $users->firstItem() ?? 0 }}–{{ $users->lastItem() ?? 0 }}</strong> dari <strong style="color:#0f172a;">{{ $users->total() }}</strong> user
    </div>

    {{-- Table --}}
    <div class="card" style="overflow:hidden;">
        <table style="width:100%; border-collapse:collapse;">
            <thead>
                <tr style="background:#f8fafc; border-bottom:2px solid #f1f5f9;">
                    <th style="padding:12px 20px; text-align:left; font-size:11px; font-weight:700; color:#64748b; text-transform:uppercase; letter-spacing:0.06em;">Nama Lengkap</th>
                    <th style="padding:12px 20px; text-align:left; font-size:11px; font-weight:700; color:#64748b; text-transform:uppercase; letter-spacing:0.06em;">Username</th>
                    <th style="padding:12px 20px; text-align:left; font-size:11px; font-weight:700; color:#64748b; text-transform:uppercase; letter-spacing:0.06em;">Role</th>
                    <th style="padding:12px 20px; text-align:left; font-size:11px; font-weight:700; color:#64748b; text-transform:uppercase; letter-spacing:0.06em;">Status</th>
                    <th style="padding:12px 20px; text-align:right; font-size:11px; font-weight:700; color:#64748b; text-transform:uppercase; letter-spacing:0.06em;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                @php
                    $avatarColors = [
                        'admin'   => ['bg' => 'linear-gradient(135deg,#ef4444,#dc2626)', 'text' => '#fff'],
                        'owner'   => ['bg' => 'linear-gradient(135deg,#f59e0b,#d97706)', 'text' => '#fff'],
                        'petugas' => ['bg' => 'linear-gradient(135deg,#22c55e,#16a34a)', 'text' => '#fff'],
                    ];
                    $ac = $avatarColors[$user->role] ?? ['bg' => 'linear-gradient(135deg,#6366f1,#8b5cf6)', 'text' => '#fff'];
                    $initials = collect(explode(' ', $user->nama_lengkap))->take(2)->map(fn($w) => strtoupper(substr($w,0,1)))->implode('');
                @endphp
                <tr class="table-row" style="border-top:1px solid #f1f5f9; transition:background 0.15s;">
                    <td style="padding:14px 20px;">
                        <div style="display:flex; align-items:center; gap:12px;">
                            <div style="width:38px; height:38px; border-radius:50%; background:{{ $ac['bg'] }}; display:flex; align-items:center; justify-content:center; flex-shrink:0; box-shadow:0 2px 8px rgba(0,0,0,0.12);">
                                <span style="color:{{ $ac['text'] }}; font-weight:700; font-size:13px;">{{ $initials }}</span>
                            </div>
                            <div>
                                <p style="font-size:13.5px; font-weight:700; color:#0f172a; margin:0;">{{ $user->nama_lengkap }}</p>
                                <p style="font-size:11.5px; color:#94a3b8; margin:2px 0 0;">ID #{{ $user->id_user }}</p>
                            </div>
                        </div>
                    </td>
                    <td style="padding:14px 20px;">
                        <span style="font-size:13px; color:#475569; font-family:monospace; background:#f8fafc; padding:3px 8px; border-radius:6px; border:1px solid #e2e8f0;">{{ $user->username }}</span>
                    </td>
                    <td style="padding:14px 20px;">
                        @if($user->role === 'admin')
                        <span class="badge" style="background:#fee2e2; color:#991b1b; font-weight:700;">
                            <i class="fa-solid fa-shield-halved" style="margin-right:4px; font-size:10px;"></i>Admin
                        </span>
                        @elseif($user->role === 'petugas')
                        <span class="badge" style="background:#dcfce7; color:#166534; font-weight:700;">
                            <i class="fa-solid fa-id-badge" style="margin-right:4px; font-size:10px;"></i>Petugas
                        </span>
                        @else
                        <span class="badge" style="background:#fef3c7; color:#92400e; font-weight:700;">
                            <i class="fa-solid fa-crown" style="margin-right:4px; font-size:10px;"></i>Owner
                        </span>
                        @endif
                    </td>
                    <td style="padding:14px 20px;">
                        @if($user->status_aktif)
                        <span class="badge" style="background:#dcfce7; color:#166534;">
                            <span style="width:6px;height:6px;border-radius:50%;background:#22c55e;display:inline-block;margin-right:5px;"></span>Aktif
                        </span>
                        @else
                        <span class="badge" style="background:#f1f5f9; color:#64748b;">
                            <span style="width:6px;height:6px;border-radius:50%;background:#94a3b8;display:inline-block;margin-right:5px;"></span>Nonaktif
                        </span>
                        @endif
                    </td>
                    <td style="padding:14px 20px;">
                        <div style="display:flex; align-items:center; gap:8px; justify-content:flex-end;">
                            <a href="{{ route('admin.user.edit', $user->id_user) }}"
                               title="Edit"
                               style="width:34px; height:34px; border-radius:8px; background:#eff6ff; display:flex; align-items:center; justify-content:center; text-decoration:none; transition:background 0.15s;"
                               onmouseover="this.style.background='#dbeafe'" onmouseout="this.style.background='#eff6ff'">
                                <i class="fa-solid fa-pen-to-square" style="color:#2563eb; font-size:13px;"></i>
                            </a>
                            @if($user->id_user !== Auth::id())
                            <form method="POST" action="{{ route('admin.user.destroy', $user->id_user) }}" onsubmit="return confirm('Hapus user {{ $user->nama_lengkap }}?')">
                                @csrf @method('DELETE')
                                <button type="submit" title="Hapus"
                                    style="width:34px; height:34px; border-radius:8px; background:#fef2f2; border:none; cursor:pointer; display:flex; align-items:center; justify-content:center; transition:background 0.15s;"
                                    onmouseover="this.style.background='#fee2e2'" onmouseout="this.style.background='#fef2f2'">
                                    <i class="fa-solid fa-trash" style="color:#dc2626; font-size:13px;"></i>
                                </button>
                            </form>
                            @else
                            <div style="width:34px; height:34px;"></div>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="padding:60px; text-align:center;">
                        <i class="fa-solid fa-users-slash" style="font-size:32px; color:#e2e8f0; display:block; margin-bottom:12px;"></i>
                        <p style="color:#94a3b8; font-size:13.5px; margin:0;">Tidak ada user ditemukan</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        @if($users->hasPages())
        <div style="padding:14px 20px; border-top:1px solid #f1f5f9; display:flex; align-items:center; justify-content:space-between;">
            <p style="font-size:12.5px; color:#94a3b8; margin:0;">Halaman {{ $users->currentPage() }} dari {{ $users->lastPage() }}</p>
            {{ $users->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
