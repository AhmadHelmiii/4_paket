@extends('layouts.app')
@section('title', 'Tambah Tarif')
@section('page-title', 'Tambah Tarif')
@section('page-subtitle', 'Atur tarif parkir untuk jenis kendaraan baru')

@section('content')
<div style="max-width:480px;">
    <div class="card" style="padding:24px;">
        <form method="POST" action="{{ route('admin.tarif.store') }}">
            @csrf
            <div style="margin-bottom:20px;">
                <label style="display:block; font-size:12px; font-weight:700; color:#374151; margin-bottom:8px; text-transform:uppercase; letter-spacing:0.05em;">Jenis Kendaraan</label>
                <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:10px;">
                    @foreach(['motor' => ['fa-motorcycle','Motor','#2563eb'], 'mobil' => ['fa-car','Mobil','#059669'], 'lainnya' => ['fa-truck','Lainnya','#d97706']] as $val => $info)
                    <label style="cursor:pointer;">
                        <input type="radio" name="jenis_kendaraan" value="{{ $val }}" style="display:none;" class="jenis-radio" {{ old('jenis_kendaraan') === $val ? 'checked' : '' }}>
                        <div class="jenis-opt" style="border:2px solid #e2e8f0; border-radius:12px; padding:14px 8px; text-align:center; transition:all 0.15s; cursor:pointer;" onclick="selectJenis(this,'{{ $val }}','{{ $info[2] }}')">
                            <i class="fa-solid {{ $info[0] }}" style="font-size:22px; color:#94a3b8; display:block; margin-bottom:6px;"></i>
                            <span style="font-size:13px; font-weight:600; color:#64748b;">{{ $info[1] }}</span>
                        </div>
                    </label>
                    @endforeach
                </div>
                @error('jenis_kendaraan')<p style="font-size:12px; color:#dc2626; margin-top:6px;">{{ $message }}</p>@enderror
            </div>
            <div style="margin-bottom:24px;">
                <label style="display:block; font-size:12px; font-weight:700; color:#374151; margin-bottom:6px; text-transform:uppercase; letter-spacing:0.05em;">Tarif per Jam (Rp)</label>
                <input type="number" name="tarif_per_jam" value="{{ old('tarif_per_jam') }}" min="0"
                       class="input-field" placeholder="Contoh: 5000" required>
                @error('tarif_per_jam')<p style="font-size:12px; color:#dc2626; margin-top:4px;">{{ $message }}</p>@enderror
            </div>
            <div style="display:flex; gap:10px;">
                <button type="submit" class="btn-primary"><i class="fa-solid fa-check"></i> Simpan</button>
                <a href="{{ route('admin.tarif.index') }}" class="btn-ghost">Batal</a>
            </div>
        </form>
    </div>
</div>
<script>
function selectJenis(el, val, color) {
    document.querySelectorAll('.jenis-opt').forEach(d => {
        d.style.borderColor='#e2e8f0'; d.style.background='#fff';
        d.querySelector('i').style.color='#94a3b8';
        d.querySelector('span').style.color='#64748b';
    });
    el.style.borderColor=color; el.style.background=color+'15';
    el.querySelector('i').style.color=color;
    el.querySelector('span').style.color=color;
    el.closest('label').querySelector('input').checked=true;
}
document.querySelectorAll('.jenis-radio:checked').forEach(r=>{
    const c={motor:'#2563eb',mobil:'#059669',lainnya:'#d97706'};
    selectJenis(r.closest('label').querySelector('.jenis-opt'),r.value,c[r.value]);
});
</script>
@endsection
