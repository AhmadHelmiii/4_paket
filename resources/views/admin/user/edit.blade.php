@extends('layouts.app')
@section('title', 'Edit User')
@section('page-title', 'Edit User')
@section('page-subtitle', 'Perbarui data ' . $user->nama_lengkap)

@section('content')
<div style="max-width:520px;">
    <x-form-card>
        <form method="POST" action="{{ route('admin.user.update', $user->id_user) }}">
            @csrf @method('PUT')
            <div style="margin-bottom:20px;">
                <label style="display:block; font-size:12px; font-weight:700; color:#374151; margin-bottom:6px; text-transform:uppercase; letter-spacing:0.05em;">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $user->nama_lengkap) }}" class="input-field" required>
                @error('nama_lengkap')<p style="font-size:12px; color:#dc2626; margin-top:4px;">{{ $message }}</p>@enderror
            </div>
            <div style="margin-bottom:20px;">
                <label style="display:block; font-size:12px; font-weight:700; color:#374151; margin-bottom:6px; text-transform:uppercase; letter-spacing:0.05em;">Username</label>
                <input type="text" name="username" value="{{ old('username', $user->username) }}" class="input-field" required>
                @error('username')<p style="font-size:12px; color:#dc2626; margin-top:4px;">{{ $message }}</p>@enderror
            </div>
            <div style="margin-bottom:20px;">
                <label style="display:block; font-size:12px; font-weight:700; color:#374151; margin-bottom:6px; text-transform:uppercase; letter-spacing:0.05em;">Password Baru <span style="font-weight:400; color:#94a3b8; text-transform:none;">(kosongkan jika tidak diubah)</span></label>
                <input type="password" name="password" class="input-field" placeholder="••••••••">
                @error('password')<p style="font-size:12px; color:#dc2626; margin-top:4px;">{{ $message }}</p>@enderror
            </div>
            <div style="margin-bottom:20px;">
                <label style="display:block; font-size:12px; font-weight:700; color:#374151; margin-bottom:8px; text-transform:uppercase; letter-spacing:0.05em;">Role</label>
                <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:10px;">
                    @foreach(['admin' => 'fa-shield-halved', 'petugas' => 'fa-id-badge', 'owner' => 'fa-crown'] as $val => $icon)
                    <label style="cursor:pointer;">
                        <input type="radio" name="role" value="{{ $val }}" style="display:none;" class="role-radio" {{ old('role', $user->role) === $val ? 'checked' : '' }}>
                        <div style="border:2px solid #e2e8f0; border-radius:12px; padding:12px 8px; text-align:center; transition:all 0.15s; cursor:pointer;"
                             onclick="selectRole(this)">
                            <i class="fa-solid {{ $icon }}" style="font-size:20px; color:#94a3b8; display:block; margin-bottom:6px;"></i>
                            <span style="font-size:12.5px; font-weight:600; color:#64748b;">{{ ucfirst($val) }}</span>
                        </div>
                    </label>
                    @endforeach
                </div>
            </div>
            <div style="margin-bottom:24px; display:flex; align-items:center; gap:10px;">
                <input type="checkbox" name="status_aktif" id="status_aktif" value="1"
                       {{ $user->status_aktif ? 'checked' : '' }}
                       style="width:16px; height:16px; accent-color:#2563eb; cursor:pointer;">
                <label for="status_aktif" style="font-size:13.5px; color:#374151; cursor:pointer; font-weight:500;">Akun Aktif</label>
            </div>
            <div style="display:flex; gap:10px;">
                <button type="submit" class="btn-primary"><i class="fa-solid fa-check"></i> Update</button>
                <a href="{{ route('admin.user.index') }}" class="btn-ghost">Batal</a>
            </div>
        </form>
    </x-form-card>
</div>
<script>
function selectRole(el) {
    document.querySelectorAll('[onclick="selectRole(this)"]').forEach(d => {
        d.style.borderColor = '#e2e8f0'; d.style.background = '#fff';
        d.querySelector('i').style.color = '#94a3b8';
        d.querySelector('span').style.color = '#64748b';
    });
    el.style.borderColor = '#2563eb'; el.style.background = '#eff6ff';
    el.querySelector('i').style.color = '#2563eb';
    el.querySelector('span').style.color = '#1d4ed8';
    el.closest('label').querySelector('input').checked = true;
}
document.querySelectorAll('.role-radio:checked').forEach(r => selectRole(r.closest('label').querySelector('div')));
</script>
@endsection
