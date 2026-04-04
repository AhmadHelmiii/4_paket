@extends('layouts.app')
@section('title', 'Kategori Alat')
@section('content')

<div class="page-header">
    <div class="page-header-left">
        <div class="breadcrumb-text">Admin › Kategori Alat</div>
        <h2>Kategori Alat</h2>
        <p>Kelola pengelompokan data alat</p>
    </div>
    <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Tambah Kategori
    </a>
</div>

<div class="card">
    <div class="table-wrap">
        <table class="data-table">
            <thead>
                <tr><th>Nama Kategori</th><th>Deskripsi</th><th>Jumlah Alat</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                @forelse($kategoris as $k)
                <tr>
                    <td style="font-weight:600;">{{ $k->nama_kategori }}</td>
                    <td class="td-muted">{{ $k->deskripsi ?? '-' }}</td>
                    <td><span class="badge badge-kategori">{{ $k->alat_count }} alat</span></td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('admin.kategori.edit', $k) }}" class="btn btn-outline-primary btn-icon btn-sm"><i class="bi bi-pencil"></i></a>
                            <form method="POST" action="{{ route('admin.kategori.destroy', $k) }}" onsubmit="return confirm('Hapus kategori ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-outline-danger btn-icon btn-sm"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4"><div class="empty-state"><i class="bi bi-tags"></i><p>Belum ada kategori</p></div></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($kategoris->hasPages())
    <div class="card-footer">{{ $kategoris->links() }}</div>
    @endif
</div>
@endsection
