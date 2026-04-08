<div style="margin-bottom:16px;">
    @if(isset($label))
    <label style="display:block; font-size:12.5px; font-weight:600; color:#374151; margin-bottom:6px; text-transform:uppercase; letter-spacing:0.04em;">{{ $label }}</label>
    @endif
    {{ $slot }}
    @if(isset($error))
    <p style="font-size:12px; color:#dc2626; margin-top:4px;"><i class="fa-solid fa-circle-exclamation" style="margin-right:3px;"></i>{{ $error }}</p>
    @endif
</div>
