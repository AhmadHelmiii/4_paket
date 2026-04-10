@extends('layouts.app')
@section('title', 'Tambah Kendaraan')
@section('page-title', 'Tambah Kendaraan')
@section('page-subtitle', 'Daftarkan kendaraan baru ke sistem')

@section('content')
<div style="max-width:600px; margin:0 auto;">
    <div class="card" style="padding:28px 32px;">
        <form method="POST" action="{{ route('admin.kendaraan.store') }}">
            @csrf
            
            <div style="display:flex; flex-direction:column; gap:20px;">
                {{-- Plat Nomor --}}
                <div>
                    <label style="display:block; font-size:13px; font-weight:600; color:#334155; margin-bottom:8px;">
                        <i class="fa-solid fa-hashtag" style="color:#64748b; margin-right:6px; font-size:11px;"></i>
                        Plat Nomor <span style="color:#ef4444;">*</span>
                    </label>
                    <input type="text" name="plat_nomor" value="{{ old('plat_nomor') }}"
                           style="width:100%; padding:11px 14px; border:1.5px solid #e2e8f0; border-radius:10px; font-size:14px; font-weight:600; text-transform:uppercase; letter-spacing:0.05em; outline:none; transition:all 0.15s; background:#f8fafc; box-sizing:border-box;"
                           onfocus="this.style.borderColor='#2563eb';this.style.background='#fff'"
                           onblur="this.style.borderColor='#e2e8f0';this.style.background='#f8fafc'"
                           placeholder="Contoh: B 1234 XYZ" required>
                    @error('plat_nomor')
                    <p style="font-size:12px; color:#ef4444; margin-top:6px;"><i class="fa-solid fa-circle-exclamation" style="margin-right:4px;"></i>{{ $message }}</p>
                    @enderror
                </div>

                {{-- Jenis Kendaraan --}}
                <div>
                    <label style="display:block; font-size:13px; font-weight:600; color:#334155; margin-bottom:8px;">
                        <i class="fa-solid fa-car" style="color:#64748b; margin-right:6px; font-size:11px;"></i>
                        Jenis Kendaraan <span style="color:#ef4444;">*</span>
                    </label>
                    <select name="jenis_kendaraan"
                            style="width:100%; padding:11px 14px; border:1.5px solid #e2e8f0; border-radius:10px; font-size:13.5px; color:#334155; background:#f8fafc; outline:none; cursor:pointer; transition:all 0.15s; box-sizing:border-box;"
                            onfocus="this.style.borderColor='#2563eb';this.style.background='#fff'"
                            onblur="this.style.borderColor='#e2e8f0';this.style.background='#f8fafc'" required>
                        <option value="">-- Pilih Jenis Kendaraan --</option>
                        <option value="motor"   {{ old('jenis_kendaraan') === 'motor'   ? 'selected' : '' }}>🏍️ Motor</option>
                        <option value="mobil"   {{ old('jenis_kendaraan') === 'mobil'   ? 'selected' : '' }}>🚗 Mobil</option>
                        <option value="lainnya" {{ old('jenis_kendaraan') === 'lainnya' ? 'selected' : '' }}>🚚 Lainnya</option>
                    </select>
                </div>

                {{-- Warna --}}
                <div>
                    <label style="display:block; font-size:13px; font-weight:600; color:#334155; margin-bottom:8px;">
                        <i class="fa-solid fa-palette" style="color:#64748b; margin-right:6px; font-size:11px;"></i>
                        Warna
                    </label>
                    <input type="text" name="warna" value="{{ old('warna') }}"
                           style="width:100%; padding:11px 14px; border:1.5px solid #e2e8f0; border-radius:10px; font-size:13.5px; outline:none; transition:all 0.15s; background:#f8fafc; box-sizing:border-box;"
                           onfocus="this.style.borderColor='#2563eb';this.style.background='#fff'"
                           onblur="this.style.borderColor='#e2e8f0';this.style.background='#f8fafc'"
                           placeholder="Contoh: Hitam, Putih, Merah">
                </div>

                {{-- Pemilik --}}
                <div>
                    <label style="display:block; font-size:13px; font-weight:600; color:#334155; margin-bottom:8px;">
                        <i class="fa-solid fa-user" style="color:#64748b; margin-right:6px; font-size:11px;"></i>
                        Nama Pemilik
                    </label>
                    <input type="text" name="pemilik" value="{{ old('pemilik') }}"
                           style="width:100%; padding:11px 14px; border:1.5px solid #e2e8f0; border-radius:10px; font-size:13.5px; outline:none; transition:all 0.15s; background:#f8fafc; box-sizing:border-box;"
                           onfocus="this.style.borderColor='#2563eb';this.style.background='#fff'"
                           onblur="this.style.borderColor='#e2e8f0';this.style.background='#f8fafc'"
                           placeholder="Nama pemilik kendaraan">
                </div>

                {{-- Actions --}}
                <div style="display:flex; gap:10px; padding-top:8px; border-top:1px solid #f1f5f9; margin-top:8px;">
                    <button type="submit" class="btn-primary" style="flex:1; padding:11px 20px; font-size:14px; font-weight:600;">
                        <i class="fa-solid fa-plus" style="margin-right:6px;"></i>Simpan Kendaraan
                    </button>
                    <a href="{{ route('admin.kendaraan.index') }}"
                       style="flex:1; padding:11px 20px; font-size:14px; font-weight:600; text-align:center; background:#f1f5f9; color:#64748b; border-radius:10px; text-decoration:none; transition:background 0.15s;"
                       onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background='#f1f5f9'">
                        <i class="fa-solid fa-xmark" style="margin-right:6px;"></i>Batal
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
