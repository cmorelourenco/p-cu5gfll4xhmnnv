@props(['name', 'hex', 'pms' => null, 'note' => null, 'ring' => false])
<div class="flex flex-col gap-3">
    <div class="h-24 rounded-xl {{ $ring ? 'ring-1 ring-inset ring-line' : '' }}"
         style="background-color: {{ $hex }}"></div>
    <div>
        <p class="text-sm font-semibold">{{ $name }}</p>
        <p class="mt-0.5 font-mono text-xs uppercase text-ink-subtle">{{ $hex }}</p>
        @if($pms)<p class="font-mono text-xs text-ink-subtle">{{ $pms }}</p>@endif
        @if($note)<p class="mt-1 text-xs leading-snug text-ink-muted">{{ $note }}</p>@endif
    </div>
</div>
