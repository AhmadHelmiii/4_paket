@extends('layouts.app')
@section('title', 'Tambah User')
@section('content')

<div class="page-header">
    <div class="page-header-left">
        <div class="breadcrumb-text">Admin › User › Tambah</div>
        <h2>Tambah Pengguna Baru</h2>
    </div>
    <a href="{{ route('admin.users.index') }}" class="btn btn-outline"><i class="bi bi-arrow-left"></i> Kembali</a>
</div>

<div class="form-card">
    <form method="POST" action="{{ route('admin.users.store') }}">
        @csrf
        <div class="form-section-title">Informasi Akun</div>
        <div class="field-group">
            <label class="field-label">Nama Lengkap <span class="required">*</span></label>
            <input type="text" name="name" class="field-input @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
            @error('name')<div class="field-error">{{ $message }}</div>@enderror
        </div>
        <div class="field-group">
            <label class="field-label">Email <span class="required">*</span></label>
            <input type="email" name="email" class="field-input @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
            @error('email')<div class="field-error">{{ $message }}</div>@enderror
        </div>
        <div class="field-group">
            <label class="field-label">Password <span class="required">*</span></label>
            <input type="password" name="password" class="field-input @error('password') is-invalid @enderror" required>
            @error('password')<div class="field-error">{{ $message }}</div>@enderror
        </div>
        <div class="row g-3">
            <div class="col-md-6">
                <div class="field-group">
                    <label class="field-label">Role <span class="required">*</span></label>
                    <select name="role" class="field-select" required>
                        <option value="">-- Pilih Role --</option>
                        @foreach(['admin','petugas','peminjam'] as $r)
                        <option value="{{ $r }}" {{ old('role') == $r ? 'selected' : '' }}>{{ ucfirst($r) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6 d-flex align-items-end pb-3">
                <label style="display:flex;align-items:center;gap:.5rem;font-size:.875rem;color:var(--gray-700);cursor:pointer;">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active','1') ? 'checked' : '' }} style="width:16px;height:16px;accent-color:var(--primary);">
                    Akun Aktif
                </label>
            </div>
        </div>
        <div class="d-flex gap-2 mt-2">
            <button type="submit" class="btn btn-primary">Simpan User</button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-outline">Batal</a>
        </div>
    </form>
</div>
@endsection
