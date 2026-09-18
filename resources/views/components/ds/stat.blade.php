@props(['value', 'label', 'activate' => false])
<div {{ $attributes->class('flex flex-col gap-1') }}>
    <span @class([
        'text-display-md tabular-nums',
        'text-activation' => $activate,
    ])>{{ $value }}</span>
    <span class="text-sm text-ink-subtle">{{ $label }}</span>
</div>
