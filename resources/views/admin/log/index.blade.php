@extends('layouts.app')
@section('title', 'Log Aktivitas')
@section('page-title', 'Log Aktivitas')
@section('page-subtitle', 'Rekam jejak semua aktivitas pengguna')

@section('content')
<div style="display:flex; flex-direction:column; gap:16px;">

    {{-- Search & Filter --}}
    <div class="card" style="padding:16px 20px;">
        <form method="GET" action="{{ route('admin.log.index') }}" style="display:flex; gap:10px; align-items:center; flex-wrap:wrap;">
            <div style="position:relative; flex:1; min-width:200px;">
                <i class="fa-solid fa-search" style="position:absolute; left:12px; top:50%; transform:translateY(-50%); color:#94a3b8; font-size:13px;"></i>
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Cari aktivitas atau nama user..."
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
            <a href="{{ route('admin.log.index') }}" style="padding:9px 14px; border:1.5px solid #e2e8f0; border-radius:10px; font-size:13px; color:#64748b; text-decoration:none; background:#f8fafc;">
                <i class="fa-solid fa-xmark"></i> Reset
            </a>
            @endif
        </form>
    </div>

    <div class="card" style="overflow:hidden;">
    <table style="width:100%; border-collapse:collapse;">
        <thead>
            <tr style="background:#f8fafc;">
                <th style="padding:12px 20px; text-align:left; font-size:11px; font-weight:700; color:#64748b; text-transform:uppercase; letter-spacing:0.05em;">Waktu</th>
                <th style="padding:12px 20px; text-align:left; font-size:11px; font-weight:700; color:#64748b; text-transform:uppercase; letter-spacing:0.05em;">User</th>
                <th style="padding:12px 20px; text-align:left; font-size:11px; font-weight:700; color:#64748b; text-transform:uppercase; letter-spacing:0.05em;">Role</th>
                <th style="padding:12px 20px; text-align:left; font-size:11px; font-weight:700; color:#64748b; text-transform:uppercase; letter-spacing:0.05em;">Aktivitas</th>
            </tr>
        </thead>
        <tbody>
            @forelse($logs as $log)
            <tr class="table-row" style="border-top:1px solid #f1f5f9;">
                <td style="padding:13px 20px; font-size:12px; color:#64748b; white-space:nowrap; font-family:monospace;">
                    {{ $log->waktu_aktivitas->format('d/m/Y H:i:s') }}
                </td>
                <td style="padding:13px 20px;">
                    <div style="display:flex; align-items:center; gap:8px;">
                        <div style="width:28px; height:28px; border-radius:50%; background:linear-gradient(135deg,#6366f1,#8b5cf6); display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                            <span style="color:#fff; font-weight:700; font-size:11px;">{{ strtoupper(substr($log->user->nama_lengkap ?? '?', 0, 1)) }}</span>
                        </div>
                        <span style="font-size:13px; font-weight:600; color:#0f172a;">{{ $log->user->nama_lengkap ?? '-' }}</span>
                    </div>
                </td>
                <td style="padding:13px 20px;">
                    @if($log->user)
                    @if($log->user->role === 'admin')
                    <span class="badge" style="background:#fee2e2; color:#991b1b;">Admin</span>
                    @elseif($log->user->role === 'petugas')
                    <span class="badge" style="background:#dcfce7; color:#166534;">Petugas</span>
                    @else
                    <span class="badge" style="background:#fef3c7; color:#92400e;">Owner</span>
                    @endif
                    @endif
                </td>
                <td style="padding:13px 20px; font-size:13px; color:#475569;">
                    <i class="fa-solid fa-circle-dot" style="color:#94a3b8; font-size:8px; margin-right:6px;"></i>
                    {{ $log->aktivitas }}
                </td>
            </tr>
            @empty
            <tr><td colspan="4" style="padding:50px; text-align:center; color:#94a3b8; font-size:13px;">Belum ada log aktivitas</td></tr>
            @endforelse
        </tbody>
    </table>
    @if($logs->hasPages())
    <div style="padding:14px 20px; border-top:1px solid #f1f5f9;">{{ $logs->links() }}</div>
    @endif
</div>
</div>
@endsection
