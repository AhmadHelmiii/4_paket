@extends('layouts.docs')

@section('content')
<div x-data="{ tab: 'erd' }">

    <div style="margin-bottom:20px;">
        <h1 style="font-size:22px; font-weight:800; color:#0f172a;">Dokumentasi Sistem Aplikasi Parkir</h1>
        <p style="font-size:13px; color:#94a3b8; margin-top:4px;">Analisis, desain, dan dokumentasi teknis lengkap</p>
    </div>

    {{-- Tab Nav --}}
    <div style="display:flex; gap:6px; background:#fff; padding:6px; border-radius:14px; border:1px solid #f1f5f9; width:fit-content; margin-bottom:24px; flex-wrap:wrap;">
        @foreach([
            'erd'       => ['fa-database',      'ERD'],
            'usecase'   => ['fa-user-check',    'Use Case'],
            'flowchart' => ['fa-diagram-project','Flowchart'],
            'activity'  => ['fa-arrows-spin',   'Activity Diagram'],
            'class'     => ['fa-cubes',         'Class Diagram'],
            'fungsi'    => ['fa-code',          'Dok. Fungsi'],
            'debugging' => ['fa-bug',           'Debugging'],
            'laporan'   => ['fa-chart-bar',     'Laporan'],
        ] as $key => $info)
        <button @click="tab='{{ $key }}'"
            :style="tab==='{{ $key }}' ? 'background:linear-gradient(135deg,#2563eb,#1d4ed8);color:#fff;box-shadow:0 4px 12px rgba(37,99,235,0.25);' : 'background:transparent;color:#64748b;'"
            style="display:inline-flex;align-items:center;gap:7px;padding:8px 16px;border-radius:10px;border:none;cursor:pointer;font-size:13px;font-weight:600;transition:all 0.15s;font-family:Inter,sans-serif;">
            <i class="fa-solid {{ $info[0] }}" style="font-size:12px;"></i> {{ $info[1] }}
        </button>
        @endforeach
    </div>

    <div x-show="tab==='erd'">@include('dokumentasi.partials.erd')</div>
    <div x-show="tab==='usecase'">@include('dokumentasi.partials.usecase')</div>
    <div x-show="tab==='flowchart'">@include('dokumentasi.partials.flowchart')</div>
    <div x-show="tab==='activity'">@include('dokumentasi.partials.activity')</div>
    <div x-show="tab==='class'">@include('dokumentasi.partials.class')</div>
    <div x-show="tab==='fungsi'">@include('dokumentasi.partials.fungsi')</div>
    <div x-show="tab==='debugging'">@include('dokumentasi.partials.debugging')</div>
    <div x-show="tab==='laporan'">@include('dokumentasi.partials.laporan')</div>

</div>
@endsection
