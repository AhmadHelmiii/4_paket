@extends('layouts.app')
@section('title', 'Tambah User')
@section('page-title', 'Tambah User')
@section('page-subtitle', 'Buat akun pengguna baru')

@section('content')
<div style="max-width:520px; margin:0 auto;">
    <div class="card" style="padding:28px 32px;">
        <form method="POST" action="{{ route('admin.user.store') }}">
            @csrf
            <div style="margin-bottom:20px;">
                <label style="display:block; font-size:12px; font-weight:700; color:#374151; margin-bottom:6px; text-transform:uppercase; letter-spacing:0.05em;">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" class="input-field" placeholder="Masukkan nama lengkap" required>
                @error('nama_lengkap')<p style="font-size:12px; color:#dc2626; margin-top:4px;">{{ $message }}</p>@enderror
            </div>
            <div style="margin-bottom:20px;">
                <label style="display:block; font-size:12px; font-weight:700; color:#374151; margin-bottom:6px; text-transform:uppercase; letter-spacing:0.05em;">Username</label>
                <input type="text" name="username" value="{{ old('username') }}" class="input-field" placeholder="Masukkan username" required>
                @error('username')<p style="font-size:12px; color:#dc2626; margin-top:4px;">{{ $message }}</p>@enderror
            </div>
            <div style="margin-bottom:20px;">
                <label style="display:block; font-size:12px; font-weight:700; color:#374151; margin-bottom:6px; text-transform:uppercase; letter-spacing:0.05em;">Password</label>
                <input type="password" name="password" class="input-field" placeholder="Min. 6 karakter" required>
                @error('password')<p style="font-size:12px; color:#dc2626; margin-top:4px;">{{ $message }}</p>@enderror
            </div>
            <div style="margin-bottom:20px;">
                <label style="display:block; font-size:12px; font-weight:700; color:#374151; margin-bottom:8px; text-transform:uppercase; letter-spacing:0.05em;">Role</label>
                <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:10px;">
                    @foreach(['admin' => ['fa-shield-halved','Admin','#fee2e2','#991b1b'], 'petugas' => ['fa-id-badge','Petugas','#dcfce7','#166534'], 'owner' => ['fa-crown','Owner','#fef3c7','#92400e']] as $val => $info)
                    <label style="cursor:pointer;">
                        <input type="radio" name="role" value="{{ $val }}" style="display:none;" class="role-radio" {{ old('role') === $val ? 'checked' : '' }}>
                        <div style="border:2px solid #e2e8f0; border-radius:12px; padding:12px 8px; text-align:center; transition:all 0.15s; cursor:pointer;"
                             onclick="selectRole(this, '{{ $val }}')">
                            <i class="fa-solid {{ $info[0] }}" style="font-size:20px; color:#94a3b8; display:block; margin-bottom:6px;"></i>
                            <span style="font-size:12.5px; font-weight:600; color:#64748b;">{{ $info[1] }}</span>
                        </div>
                    </label>
                    @endforeach
                </div>
                @error('role')<p style="font-size:12px; color:#dc2626; margin-top:4px;">{{ $message }}</p>@enderror
            </div>
            <div style="margin-bottom:24px; display:flex; align-items:center; gap:10px;">
                <input type="checkbox" name="status_aktif" id="status_aktif" value="1" checked
                       style="width:16px; height:16px; accent-color:#2563eb; cursor:pointer;">
                <label for="status_aktif" style="font-size:13.5px; color:#374151; cursor:pointer; font-weight:500;">Akun Aktif</label>
            </div>
            <div style="display:flex; gap:10px;">
                <button type="submit" class="btn-primary">
                    <i class="fa-solid fa-check"></i> Simpan User
                </button>
                <a href="{{ route('admin.user.index') }}" class="btn-ghost">Batal</a>
            </div>
        </form>
    </div>
</div>
<script>
function selectRole(el, val) {
    document.querySelectorAll('[onclick^="selectRole"]').forEach(d => {
        d.style.borderColor = '#e2e8f0';
        d.style.background = '#fff';
        d.querySelector('i').style.color = '#94a3b8';
        d.querySelector('span').style.color = '#64748b';
    });
    el.style.borderColor = '#2563eb';
    el.style.background = '#eff6ff';
    el.querySelector('i').style.color = '#2563eb';
    el.querySelector('span').style.color = '#1d4ed8';
    el.closest('label').querySelector('input').checked = true;
}
// Init selected
document.querySelectorAll('.role-radio:checked').forEach(r => {
    selectRole(r.closest('label').querySelector('div'), r.value);
});
</script>
@endsection
