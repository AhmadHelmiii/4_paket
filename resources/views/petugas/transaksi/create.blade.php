@extends('layouts.app')
@section('title', 'Kendaraan Masuk')
@section('page-title', 'Kendaraan Masuk')
@section('page-subtitle', 'Catat kendaraan yang baru masuk area parkir')

@section('content')
<div style="max-width:560px; margin:0 auto;">
    <div class="card" style="padding:28px 32px;">
        <form method="POST" action="{{ route('petugas.transaksi.store') }}">
            @csrf

            <div style="margin-bottom:20px;">
                <label style="display:block; font-size:12px; font-weight:700; color:#374151; margin-bottom:6px; text-transform:uppercase; letter-spacing:0.05em;">Plat Nomor</label>
                <input type="text" name="plat_nomor" value="{{ old('plat_nomor') }}"
                       class="input-field" placeholder="Contoh: B 1234 ABC"
                       style="text-transform:uppercase; font-size:16px; font-weight:700; letter-spacing:0.05em;"
                       required autofocus>
                @error('plat_nomor')<p style="font-size:12px; color:#dc2626; margin-top:4px;">{{ $message }}</p>@enderror
            </div>

            <div style="margin-bottom:20px;">
                <label style="display:block; font-size:12px; font-weight:700; color:#374151; margin-bottom:8px; text-transform:uppercase; letter-spacing:0.05em;">Jenis Kendaraan</label>
                <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:10px;">
                    @foreach(['motor' => ['fa-motorcycle','Motor','#2563eb'], 'mobil' => ['fa-car','Mobil','#059669'], 'lainnya' => ['fa-truck','Lainnya','#d97706']] as $val => $info)
                    <label style="cursor:pointer;">
                        <input type="radio" name="jenis_kendaraan" value="{{ $val }}" style="display:none;" class="jenis-radio" {{ old('jenis_kendaraan') === $val ? 'checked' : '' }}>
                        <div class="jenis-opt" style="border:2px solid #e2e8f0; border-radius:12px; padding:14px 8px; text-align:center; transition:all 0.15s; cursor:pointer;" onclick="selectJenis(this, '{{ $val }}', '{{ $info[2] }}')">
                            <i class="fa-solid {{ $info[0] }}" style="font-size:22px; color:#94a3b8; display:block; margin-bottom:6px;"></i>
                            <span style="font-size:13px; font-weight:600; color:#64748b;">{{ $info[1] }}</span>
                        </div>
                    </label>
                    @endforeach
                </div>
                @error('jenis_kendaraan')<p style="font-size:12px; color:#dc2626; margin-top:4px;">{{ $message }}</p>@enderror
            </div>

            <div style="margin-bottom:20px;">
                <label style="display:block; font-size:12px; font-weight:700; color:#374151; margin-bottom:6px; text-transform:uppercase; letter-spacing:0.05em;">Area Parkir</label>
                <select name="id_area" class="input-field" required>
                    <option value="">— Pilih Area —</option>
                    @foreach($areas as $area)
                    <option value="{{ $area->id_area }}" {{ old('id_area') == $area->id_area ? 'selected' : '' }}>
                        {{ $area->nama_area }} &nbsp;·&nbsp; Sisa {{ $area->sisaSlot() }} slot
                    </option>
                    @endforeach
                </select>
                @error('id_area')<p style="font-size:12px; color:#dc2626; margin-top:4px;">{{ $message }}</p>@enderror
            </div>

            <div style="margin-bottom:24px;">
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:14px;">
                <div>
                    <label style="display:block; font-size:12px; font-weight:700; color:#374151; margin-bottom:6px; text-transform:uppercase; letter-spacing:0.05em;">Warna</label>
                    <div style="position:relative;">
                        <input type="text" name="warna" id="warnaInput" value="{{ old('warna') }}"
                               class="input-field" placeholder="Hitam, Putih..."
                               autocomplete="off"
                               oninput="filterWarna(this.value)"
                               onfocus="showDropdown()"
                               onblur="setTimeout(hideDropdown, 150)">
                        <div id="warnaDropdown" style="display:none; position:absolute; top:100%; left:0; right:0; background:#fff; border:1.5px solid #e2e8f0; border-radius:10px; box-shadow:0 8px 24px rgba(0,0,0,0.1); z-index:100; margin-top:4px; overflow:hidden; max-height:200px; overflow-y:auto;">
                            @foreach(['Hitam','Putih','Silver','Abu-abu','Merah','Biru','Biru Tua','Hijau','Kuning','Orange','Coklat','Ungu'] as $w)
                            <div class="warna-opt" onclick="pilihWarna('{{ $w }}')"
                                 style="padding:9px 14px; font-size:13px; color:#374151; cursor:pointer; transition:background 0.1s;"
                                 onmouseover="this.style.background='#eff6ff';this.style.color='#2563eb'"
                                 onmouseout="this.style.background='#fff';this.style.color='#374151'">
                                {{ $w }}
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div>
                    <label style="display:block; font-size:12px; font-weight:700; color:#374151; margin-bottom:6px; text-transform:uppercase; letter-spacing:0.05em;">Pemilik</label>
                    <input type="text" name="pemilik" value="{{ old('pemilik') }}" class="input-field" placeholder="Nama pemilik">
                </div>
                </div>
            </div>

            <div style="display:flex; gap:10px;">
                <button type="submit" class="btn-primary" style="flex:1; justify-content:center; padding:12px;">
                    <i class="fa-solid fa-arrow-right-to-bracket"></i> Konfirmasi Masuk
                </button>
                <a href="{{ route('petugas.transaksi.index') }}" class="btn-ghost">Batal</a>
            </div>
        </form>
    </div>
</div>
<script>
function selectJenis(el, val, color) {
    document.querySelectorAll('.jenis-opt').forEach(d => {
        d.style.borderColor = '#e2e8f0'; d.style.background = '#fff';
        d.querySelector('i').style.color = '#94a3b8';
        d.querySelector('span').style.color = '#64748b';
    });
    el.style.borderColor = color; el.style.background = color + '10';
    el.querySelector('i').style.color = color;
    el.querySelector('span').style.color = color;
    el.closest('label').querySelector('input').checked = true;
}
document.querySelectorAll('.jenis-radio:checked').forEach(r => {
    const colors = {motor:'#2563eb', mobil:'#059669', lainnya:'#d97706'};
    selectJenis(r.closest('label').querySelector('.jenis-opt'), r.value, colors[r.value]);
});

function pilihWarna(nama) {
    const input = document.getElementById('warnaInput');
    input.value = nama;
    hideDropdown();
}
function showDropdown() {
    filterWarna(document.getElementById('warnaInput').value);
}
function hideDropdown() {
    document.getElementById('warnaDropdown').style.display = 'none';
}
function filterWarna(val) {
    const dd = document.getElementById('warnaDropdown');
    const opts = dd.querySelectorAll('.warna-opt');
    let ada = false;
    opts.forEach(o => {
        const match = o.textContent.trim().toLowerCase().includes(val.toLowerCase());
        o.style.display = match ? 'block' : 'none';
        if (match) ada = true;
    });
    dd.style.display = ada ? 'block' : 'none';
}
</script>
@endsection
