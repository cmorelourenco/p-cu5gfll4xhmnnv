@props(['interactive' => false, 'activate' => false])
{{-- activate — the card itself carries the accent, and the icon plate turns
     dark so it stands on it. The accent appears once per card, never twice. --}}
<div {{ $attributes->class(['tile', 'tile-interactive' => $interactive, 'tile-activate' => $activate]) }}>
    {{ $slot }}
</div>
