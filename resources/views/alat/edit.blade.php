@extends('layouts.app')
@section('title', 'Edit Alat')
@section('content')

<div class="page-header">
    <div class="page-header-left">
        <div class="breadcrumb-text">Data Alat › Edit</div>
        <h2>Edit Alat: {{ $alat->nama_alat }}</h2>
    </div>
    <a href="{{ route('alat.index') }}" class="btn btn-outline"><i class="bi bi-arrow-left"></i> Kembali</a>
</div>

<div class="form-card">
    <form method="POST" action="{{ route('alat.update', $alat) }}" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="form-section-title">Informasi Alat</div>
        <div class="row g-3">
            <div class="col-md-6">
                <div class="field-group">
                    <label class="field-label">Nama Alat <span class="required">*</span></label>
                    <input type="text" name="nama_alat" class="field-input @error('nama_alat') is-invalid @enderror" value="{{ old('nama_alat', $alat->nama_alat) }}" required>
                    @error('nama_alat')<div class="field-error">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="field-group">
                    <label class="field-label">Kode Alat <span class="required">*</span></label>
                    <input type="text" name="kode_alat" class="field-input @error('kode_alat') is-invalid @enderror" value="{{ old('kode_alat', $alat->kode_alat) }}" required>
                    @error('kode_alat')<div class="field-error">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="field-group">
                    <label class="field-label">Kategori <span class="required">*</span></label>
                    <select name="kategori_id" class="field-select" required>
                        @foreach($kategoris as $k)
                        <option value="{{ $k->id }}" {{ old('kategori_id', $alat->kategori_id) == $k->id ? 'selected' : '' }}>{{ $k->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="field-group">
                    <label class="field-label">Stok Total <span class="required">*</span></label>
                    <input type="number" name="stok_total" class="field-input" value="{{ old('stok_total', $alat->stok_total) }}" min="1" required>
                </div>
            </div>
            <div class="col-md-3">
                <div class="field-group">
                    <label class="field-label">Kondisi</label>
                    <select name="kondisi" class="field-select">
                        @foreach(['baik','rusak ringan','rusak berat'] as $k)
                        <option value="{{ $k }}" {{ old('kondisi', $alat->kondisi) == $k ? 'selected' : '' }}>{{ ucfirst($k) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-12">
                <div class="field-group">
                    <label class="field-label">Foto Alat</label>
                    @if($alat->foto_url)
                    <div style="margin-bottom:.6rem;">
                        <img src="{{ $alat->foto_url }}" style="height:80px;border-radius:8px;object-fit:cover;border:1px solid var(--gray-200);">
                    </div>
                    @endif
                    <input type="file" name="foto" class="field-input" accept="image/*">
                    <div class="field-hint">Kosongkan jika tidak ingin mengubah foto</div>
                </div>
            </div>
            <div class="col-12">
                <div class="field-group">
                    <label class="field-label">Deskripsi</label>
                    <textarea name="deskripsi" class="field-textarea">{{ old('deskripsi', $alat->deskripsi) }}</textarea>
                </div>
            </div>
        </div>
        <div class="d-flex gap-2 mt-2">
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('alat.index') }}" class="btn btn-outline">Batal</a>
        </div>
    </form>
</div>
@endsection
