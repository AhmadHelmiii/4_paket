@extends('layouts.app')
@section('title', 'Ajukan Peminjaman')
@section('content')
<div class="mb-4">
    <p class="text-muted small mb-0">Peminjaman › Ajukan Baru</p>
    <h3 class="fw-bold mb-0">Ajukan Peminjaman Baru</h3>
    <p class="text-muted small">Pilih alat yang Anda butuhkan. Maksimal 3 alat dan 7 hari kerja.</p>
</div>
<form method="POST" action="{{ route('peminjaman.store') }}" id="formPinjam">
@csrf
<div class="row g-3">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header fw-semibold">Katalog Alat Tersedia</div>
            <div class="card-body">
                <div class="row g-3" id="katalogAlat">
                    @foreach($alats as $alat)
                    <div class="col-md-4">
                        <div class="border rounded-3 p-3 h-100 alat-card" data-id="{{ $alat->id }}" style="cursor:pointer;transition:all .15s;">
                            @if($alat->foto)
                            <img src="{{ $alat->foto_url }}" class="w-100 rounded mb-2" style="height:100px;object-fit:cover;">
                            @else
                            <div class="bg-light rounded d-flex align-items-center justify-content-center mb-2" style="height:100px;">
                                <i class="bi bi-tools text-muted fs-3"></i>
                            </div>
                            @endif
                            <span class="badge mb-1" style="background:#d1fae5;color:#065f46;font-size:.7rem;">TERSEDIA</span>
                            <div class="fw-semibold small">{{ $alat->nama_alat }}</div>
                            <div class="text-muted" style="font-size:.75rem;">Stok: <span class="text-success fw-bold">{{ $alat->stok_tersedia }} Unit</span></div>
                            <button type="button" class="btn btn-sm btn-primary mt-2 w-100 btn-tambah" data-id="{{ $alat->id }}" data-nama="{{ $alat->nama_alat }}" data-stok="{{ $alat->stok_tersedia }}">
                                <i class="bi bi-plus"></i> Tambah
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card sticky-top" style="top:80px;">
            <div class="card-header fw-semibold"><i class="bi bi-cart3 me-2"></i>Daftar Pinjaman</div>
            <div class="card-body">
                <div id="daftarPinjam">
                    <p class="text-muted small text-center py-3" id="emptyMsg">Belum ada alat dipilih</p>
                </div>
                <hr>
                <div class="mb-3">
                    <label class="form-label fw-semibold small">Tanggal Kembali Rencana <span class="text-danger">*</span></label>
                    <input type="date" name="tgl_kembali_rencana" class="form-control form-control-sm @error('tgl_kembali_rencana') is-invalid @enderror"
                           min="{{ now()->toDateString() }}"
                           max="{{ now()->addDays(7)->toDateString() }}"
                           value="{{ old('tgl_kembali_rencana') }}" required>
                    <div class="form-text" style="font-size:.7rem;">⚠ Maksimal peminjaman adalah 7 hari kerja.</div>
                    @error('tgl_kembali_rencana')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold small">Catatan (opsional)</label>
                    <textarea name="catatan" class="form-control form-control-sm" rows="2">{{ old('catatan') }}</textarea>
                </div>
                <div class="d-flex justify-content-between small text-muted mb-3">
                    <span>Total Alat</span>
                    <span id="totalAlat" class="fw-bold">0 Item</span>
                </div>
                <button type="submit" class="btn btn-primary w-100" id="btnAjukan" disabled>
                    Ajukan Sekarang <i class="bi bi-arrow-right ms-1"></i>
                </button>
                <button type="button" class="btn btn-outline-secondary w-100 mt-2" onclick="clearAll()">Batalkan & Bersihkan</button>
            </div>
        </div>
    </div>
</div>
</form>
@endsection

@push('scripts')
<script>
let selected = {};

document.querySelectorAll('.btn-tambah').forEach(btn => {
    btn.addEventListener('click', function() {
        const id   = this.dataset.id;
        const nama = this.dataset.nama;
        const stok = parseInt(this.dataset.stok);
        if (Object.keys(selected).length >= 3 && !selected[id]) {
            alert('Maksimal 3 alat per peminjaman.'); return;
        }
        if (!selected[id]) selected[id] = { nama, stok, jumlah: 1 };
        else if (selected[id].jumlah < stok) selected[id].jumlah++;
        renderDaftar();
    });
});

function renderDaftar() {
    const container = document.getElementById('daftarPinjam');
    const emptyMsg  = document.getElementById('emptyMsg');
    const total     = Object.keys(selected).length;

    document.getElementById('totalAlat').textContent = total + ' Item';
    document.getElementById('btnAjukan').disabled = total === 0;

    // Hapus item lama
    container.querySelectorAll('.pinjam-item').forEach(e => e.remove());
    if (emptyMsg) emptyMsg.style.display = total === 0 ? '' : 'none';

    // Hapus hidden inputs lama
    document.querySelectorAll('.hidden-alat').forEach(e => e.remove());

    Object.entries(selected).forEach(([id, item]) => {
        // Render card
        const div = document.createElement('div');
        div.className = 'pinjam-item border rounded-3 p-2 mb-2 d-flex align-items-center gap-2';
        div.innerHTML = `
            <div class="flex-grow-1">
                <div class="small fw-semibold">${item.nama}</div>
                <div class="d-flex align-items-center gap-1 mt-1">
                    <button type="button" class="btn btn-sm btn-outline-secondary py-0 px-2" onclick="changeJumlah('${id}', -1)">-</button>
                    <span class="small">${item.jumlah}</span>
                    <button type="button" class="btn btn-sm btn-outline-secondary py-0 px-2" onclick="changeJumlah('${id}', 1)">+</button>
                </div>
            </div>
            <button type="button" class="btn btn-sm text-danger" onclick="removeItem('${id}')"><i class="bi bi-x"></i></button>
        `;
        container.appendChild(div);

        // Hidden inputs
        const inp1 = document.createElement('input');
        inp1.type = 'hidden'; inp1.name = 'alat_ids[]'; inp1.value = id; inp1.className = 'hidden-alat';
        const inp2 = document.createElement('input');
        inp2.type = 'hidden'; inp2.name = `jumlah[${id}]`; inp2.value = item.jumlah; inp2.className = 'hidden-alat';
        document.getElementById('formPinjam').appendChild(inp1);
        document.getElementById('formPinjam').appendChild(inp2);
    });
}

function changeJumlah(id, delta) {
    if (!selected[id]) return;
    const newVal = selected[id].jumlah + delta;
    if (newVal < 1) { removeItem(id); return; }
    if (newVal > selected[id].stok) { alert('Melebihi stok tersedia.'); return; }
    selected[id].jumlah = newVal;
    renderDaftar();
}

function removeItem(id) { delete selected[id]; renderDaftar(); }
function clearAll() { selected = {}; renderDaftar(); }
</script>
@endpush
