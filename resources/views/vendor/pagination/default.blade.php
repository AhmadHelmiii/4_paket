@if ($paginator->hasPages())
<div style="display:flex; align-items:center; gap:6px; flex-wrap:wrap;">
    {{-- Previous --}}
    @if ($paginator->onFirstPage())
        <span style="padding:6px 12px; border-radius:8px; font-size:12.5px; color:#cbd5e1; background:#f8fafc; border:1px solid #f1f5f9; cursor:not-allowed;">‹ Prev</span>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" style="padding:6px 12px; border-radius:8px; font-size:12.5px; color:#475569; background:#f8fafc; border:1px solid #e2e8f0; text-decoration:none; transition:all 0.15s;" onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='#f8fafc'">‹ Prev</a>
    @endif

    {{-- Pages --}}
    @foreach ($elements as $element)
        @if (is_string($element))
            <span style="padding:6px 10px; font-size:12.5px; color:#94a3b8;">{{ $element }}</span>
        @endif
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <span style="padding:6px 12px; border-radius:8px; font-size:12.5px; font-weight:700; color:#fff; background:linear-gradient(135deg,#2563eb,#1d4ed8); border:1px solid transparent;">{{ $page }}</span>
                @else
                    <a href="{{ $url }}" style="padding:6px 12px; border-radius:8px; font-size:12.5px; color:#475569; background:#f8fafc; border:1px solid #e2e8f0; text-decoration:none; transition:all 0.15s;" onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='#f8fafc'">{{ $page }}</a>
                @endif
            @endforeach
        @endif
    @endforeach

    {{-- Next --}}
    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" style="padding:6px 12px; border-radius:8px; font-size:12.5px; color:#475569; background:#f8fafc; border:1px solid #e2e8f0; text-decoration:none; transition:all 0.15s;" onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='#f8fafc'">Next ›</a>
    @else
        <span style="padding:6px 12px; border-radius:8px; font-size:12.5px; color:#cbd5e1; background:#f8fafc; border:1px solid #f1f5f9; cursor:not-allowed;">Next ›</span>
    @endif

    <span style="font-size:12px; color:#94a3b8; margin-left:4px;">{{ $paginator->firstItem() }}-{{ $paginator->lastItem() }} dari {{ $paginator->total() }}</span>
</div>
@endif
