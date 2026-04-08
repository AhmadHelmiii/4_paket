@extends('layouts.app')
@section('title', 'Manajemen User')
@section('page-title', 'Manajemen User')
@section('page-subtitle', 'Kelola akun pengguna sistem')

@section('content')
<div style="display:flex; flex-direction:column; gap:16px;">
    {{-- Search & Filter --}}
    <div class="card" style="padding:16px 20px;">
        <form method="GET" action="{{ route('admin.user.index') }}" style="display:flex; gap:10px; align-items:center; flex-wrap:wrap;">
            <div style="position:relative; flex:1; min-width:200px;">
                <i class="fa-solid fa-search" style="position:absolute; left:12px; top:50%; transform:translateY(-50%); color:#94a3b8; font-size:13px;"></i>
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Cari nama atau username..."
                       style="width:100%; padding:9px 12px 9px 36px; border:1.5px solid #e2e8f0; border-radius:10px; font-size:13.5px; outline:none; transition:all 0.15s; background:#f8fafc;"
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

    <div style="display:flex; align-items:center; justify-content:space-between;">
        <div style="background:#f1f5f9; border-radius:10px; padding:8px 14px; font-size:13px; color:#475569; font-weight:500;">
            <i class="fa-solid fa-users" style="margin-right:6px; color:#2563eb;"></i>
            {{ $users->total() }} user ditemukan
        </div>
        <a href="{{ route('admin.user.create') }}" class="btn-primary">
            <i class="fa-solid fa-plus"></i> Tambah User
        </a>
    </div>

    <div class="card" style="overflow:hidden;">
        <table style="width:100%; border-collapse:collapse;">
            <thead>
                <tr style="background:#f8fafc;">
                    <th style="padding:12px 20px; text-align:left; font-size:11px; font-weight:700; color:#64748b; text-transform:uppercase; letter-spacing:0.05em;">Nama Lengkap</th>
                    <th style="padding:12px 20px; text-align:left; font-size:11px; font-weight:700; color:#64748b; text-transform:uppercase; letter-spacing:0.05em;">Username</th>
                    <th style="padding:12px 20px; text-align:left; font-size:11px; font-weight:700; color:#64748b; text-transform:uppercase; letter-spacing:0.05em;">Role</th>
                    <th style="padding:12px 20px; text-align:left; font-size:11px; font-weight:700; color:#64748b; text-transform:uppercase; letter-spacing:0.05em;">Status</th>
                    <th style="padding:12px 20px; text-align:left; font-size:11px; font-weight:700; color:#64748b; text-transform:uppercase; letter-spacing:0.05em;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr class="table-row" style="border-top:1px solid #f1f5f9;">
                    <td style="padding:14px 20px;">
                        <div style="display:flex; align-items:center; gap:10px;">
                            <div style="width:34px; height:34px; border-radius:50%; background:linear-gradient(135deg,#6366f1,#8b5cf6); display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                                <span style="color:#fff; font-weight:700; font-size:12px;">{{ strtoupper(substr($user->nama_lengkap,0,1)) }}</span>
                            </div>
                            <span style="font-size:13.5px; font-weight:600; color:#0f172a;">{{ $user->nama_lengkap }}</span>
                        </div>
                    </td>
                    <td style="padding:14px 20px; font-size:13px; color:#475569; font-family:monospace;">{{ $user->username }}</td>
                    <td style="padding:14px 20px;">
                        @if($user->role === 'admin')
                        <span class="badge" style="background:#fee2e2; color:#991b1b;">Admin</span>
                        @elseif($user->role === 'petugas')
                        <span class="badge" style="background:#dcfce7; color:#166534;">Petugas</span>
                        @else
                        <span class="badge" style="background:#fef3c7; color:#92400e;">Owner</span>
                        @endif
                    </td>
                    <td style="padding:14px 20px;">
                        @if($user->status_aktif)
                        <span class="badge" style="background:#dcfce7; color:#166534;"><span style="width:6px;height:6px;border-radius:50%;background:#22c55e;display:inline-block;margin-right:5px;"></span>Aktif</span>
                        @else
                        <span class="badge" style="background:#f1f5f9; color:#64748b;"><span style="width:6px;height:6px;border-radius:50%;background:#94a3b8;display:inline-block;margin-right:5px;"></span>Nonaktif</span>
                        @endif
                    </td>
                    <td style="padding:14px 20px;">
                        <div style="display:flex; align-items:center; gap:8px;">
                            <a href="{{ route('admin.user.edit', $user->id_user) }}"
                               style="font-size:12.5px; font-weight:600; color:#2563eb; text-decoration:none; padding:5px 12px; border-radius:7px; background:#eff6ff; transition:background 0.15s;"
                               onmouseover="this.style.background='#dbeafe'" onmouseout="this.style.background='#eff6ff'">
                                <i class="fa-solid fa-pen-to-square" style="margin-right:4px;"></i>Edit
                            </a>
                            @if($user->id_user !== Auth::id())
                            <form method="POST" action="{{ route('admin.user.destroy', $user->id_user) }}" onsubmit="return confirm('Hapus user ini?')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                    style="font-size:12.5px; font-weight:600; color:#dc2626; background:#fef2f2; border:none; cursor:pointer; padding:5px 12px; border-radius:7px; transition:background 0.15s;"
                                    onmouseover="this.style.background='#fee2e2'" onmouseout="this.style.background='#fef2f2'">
                                    <i class="fa-solid fa-trash" style="margin-right:4px;"></i>Hapus
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" style="padding:50px; text-align:center; color:#94a3b8; font-size:13px;">Belum ada user</td></tr>
                @endforelse
            </tbody>
        </table>
        @if($users->hasPages())
        <div style="padding:14px 20px; border-top:1px solid #f1f5f9;">{{ $users->links() }}</div>
        @endif
    </div>
</div>
@endsection
