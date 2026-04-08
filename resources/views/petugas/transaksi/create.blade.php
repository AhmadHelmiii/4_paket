@extends('layouts.app')
@section('title', 'Kendaraan Masuk')
@section('page-title', 'Kendaraan Masuk')
@section('page-subtitle', 'Catat kendaraan yang baru masuk area parkir')

@section('content')
<div style="max-width:560px;">
    <x-form-card>
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

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:14px; margin-bottom:24px;">
                <div>
                    <label style="display:block; font-size:12px; font-weight:700; color:#374151; margin-bottom:6px; text-transform:uppercase; letter-spacing:0.05em;">Warna</label>
                    <input type="text" name="warna" value="{{ old('warna') }}" class="input-field" placeholder="Hitam, Putih...">
                </div>
                <div>
                    <label style="display:block; font-size:12px; font-weight:700; color:#374151; margin-bottom:6px; text-transform:uppercase; letter-spacing:0.05em;">Pemilik</label>
                    <input type="text" name="pemilik" value="{{ old('pemilik') }}" class="input-field" placeholder="Nama pemilik">
                </div>
            </div>

            <div style="display:flex; gap:10px;">
                <button type="submit" class="btn-primary" style="flex:1; justify-content:center; padding:12px;">
                    <i class="fa-solid fa-arrow-right-to-bracket"></i> Konfirmasi Masuk
                </button>
                <a href="{{ route('petugas.transaksi.index') }}" class="btn-ghost">Batal</a>
            </div>
        </form>
    </x-form-card>
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
</script>
@endsection
