@props(['interactive' => false])
<div {{ $attributes->class(['tile', 'tile-interactive' => $interactive]) }}>
    {{ $slot }}
</div>
