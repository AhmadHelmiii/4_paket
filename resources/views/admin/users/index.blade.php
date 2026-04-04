@extends('layouts.app')
@section('title', 'Manajemen User')
@section('content')

<div class="page-header">
    <div class="page-header-left">
        <div class="breadcrumb-text">Admin › Manajemen User</div>
        <h2>Daftar Pengguna</h2>
        <p>Kelola akun admin, petugas, dan peminjam</p>
    </div>
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Tambah User
    </a>
</div>

<div class="card">
    <div class="table-wrap">
        <table class="data-table">
            <thead>
                <tr><th>Pengguna</th><th>Email</th><th>Role</th><th>Status</th><th>Bergabung</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <div class="avatar avatar-md">{{ strtoupper(substr($user->name, 0, 2)) }}</div>
                            <span style="font-weight:600;">{{ $user->name }}</span>
                        </div>
                    </td>
                    <td class="td-muted">{{ $user->email }}</td>
                    <td><span class="badge badge-{{ $user->role }}">{{ ucfirst($user->role) }}</span></td>
                    <td>
                        <form method="POST" action="{{ route('admin.users.toggle-active', $user) }}" class="d-inline">
                            @csrf @method('PATCH')
                            <button type="submit" class="badge {{ $user->is_active ? 'badge-aktif' : 'badge-nonaktif' }}" style="border:none;cursor:pointer;font-size:.72rem;">
                                {{ $user->is_active ? '● Aktif' : '● Nonaktif' }}
                            </button>
                        </form>
                    </td>
                    <td class="td-muted">{{ $user->created_at->format('d M Y') }}</td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-outline-primary btn-icon btn-sm"><i class="bi bi-pencil"></i></a>
                            @if($user->id !== auth()->id())
                            <form method="POST" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('Hapus user ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-outline-danger btn-icon btn-sm"><i class="bi bi-trash"></i></button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6"><div class="empty-state"><i class="bi bi-people"></i><p>Tidak ada data user</p></div></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($users->hasPages())
    <div class="card-footer">{{ $users->links() }}</div>
    @endif
</div>
@endsection
