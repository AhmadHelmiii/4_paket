@extends('layouts.app')
@section('title', 'Edit Kategori')
@section('content')
<div class="mb-4">
    <p class="text-muted small mb-0">Admin › Kategori › Edit</p>
    <h3 class="fw-bold mb-0">Edit Kategori: {{ $kategori->nama_kategori }}</h3>
</div>
<div class="card" style="max-width:480px;">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.kategori.update', $kategori) }}">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Kategori <span class="text-danger">*</span></label>
                <input type="text" name="nama_kategori" class="form-control @error('nama_kategori') is-invalid @enderror" value="{{ old('nama_kategori', $kategori->nama_kategori) }}" required>
                @error('nama_kategori')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-4">
                <label class="form-label fw-semibold">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="3">{{ old('deskripsi', $kategori->deskripsi) }}</textarea>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('admin.kategori.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
