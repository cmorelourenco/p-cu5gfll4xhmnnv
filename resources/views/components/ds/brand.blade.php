{{-- Wordmark. The logo is "coloured in four ways only" (manual p.15); this
     is the type-only lockup, which inherits currentColor so it is correct on
     both the beige ground and the Deep Blue backdrop. --}}
@props(['size' => 'base'])
<a href="/" {{ $attributes->class([
    'inline-flex items-baseline gap-px font-semibold tracking-tight',
    'text-xl' => $size === 'base',
    'text-2xl' => $size === 'lg',
]) }}>
    <span>C</span>
    <span class="text-activation" aria-hidden="true">&ndash;</span>
    <span>MORE</span>
</a>
