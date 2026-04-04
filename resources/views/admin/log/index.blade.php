@extends('layouts.app')
@section('title', 'Log Aktivitas')
@section('content')

<div class="page-header">
    <div class="page-header-left">
        <div class="breadcrumb-text">Admin › Log Aktivitas</div>
        <h2>Log Aktivitas</h2>
        <p>Audit trail seluruh aktivitas pengguna di sistem</p>
    </div>
</div>

<div class="card mb-3">
    <div class="card-body" style="padding:.85rem 1.25rem;">
        <form method="GET" class="d-flex gap-2 flex-wrap align-items-center">
            <select name="user_id" class="field-select" style="width:180px;">
                <option value="">Semua User</option>
                @foreach($users as $u)
                <option value="{{ $u->id }}" {{ request('user_id') == $u->id ? 'selected' : '' }}>{{ $u->name }}</option>
                @endforeach
            </select>
            <select name="aksi" class="field-select" style="width:140px;">
                <option value="">Semua Aksi</option>
                @foreach(['login','logout','create','update','delete'] as $a)
                <option value="{{ $a }}" {{ request('aksi') == $a ? 'selected' : '' }}>{{ ucfirst($a) }}</option>
                @endforeach
            </select>
            <input type="date" name="tgl_mulai" class="field-input" style="width:160px;" value="{{ request('tgl_mulai') }}">
            <input type="date" name="tgl_selesai" class="field-input" style="width:160px;" value="{{ request('tgl_selesai') }}">
            <button class="btn btn-primary btn-sm">Filter</button>
            <a href="{{ route('admin.log.index') }}" class="btn btn-outline btn-sm">Reset</a>
        </form>
    </div>
</div>

<div class="card">
    <div class="table-wrap">
        <table class="data-table">
            <thead>
                <tr><th>Waktu</th><th>Pengguna</th><th>Aksi</th><th>Tabel Target</th><th>Detail</th></tr>
            </thead>
            <tbody>
                @forelse($logs as $log)
                <tr>
                    <td class="td-muted" style="white-space:nowrap;">{{ $log->created_at->format('d M Y H:i') }}</td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <div class="avatar avatar-sm">{{ strtoupper(substr($log->user->name ?? 'U', 0, 2)) }}</div>
                            <div>
                                <div style="font-weight:600;font-size:.85rem;">{{ $log->user->name ?? '-' }}</div>
                                <div style="font-size:.72rem;color:var(--gray-400);">{{ ucfirst($log->user->role ?? '') }}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        @php $bc = ['login'=>'badge-dipinjam','logout'=>'badge-kategori','create'=>'badge-available','update'=>'badge-menunggu','delete'=>'badge-ditolak'][$log->aksi] ?? 'badge-kategori'; @endphp
                        <span class="badge {{ $bc }}">{{ ucfirst($log->aksi) }}</span>
                    </td>
                    <td><code style="font-size:.78rem;color:var(--gray-500);background:var(--gray-100);padding:.15rem .4rem;border-radius:4px;">{{ $log->tabel_target ?? '-' }}</code></td>
                    <td class="td-muted" style="max-width:240px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ $log->detail ?? '-' }}</td>
                </tr>
                @empty
                <tr><td colspan="5"><div class="empty-state"><i class="bi bi-activity"></i><p>Tidak ada log aktivitas</p></div></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($logs->hasPages())
    <div class="card-footer">{{ $logs->links() }}</div>
    @endif
</div>
@endsection
