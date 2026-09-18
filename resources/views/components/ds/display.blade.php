{{-- Display heading. Sizes map to the --text-display-* scale, which encodes
     the manual's weight pairing: Medium for most titles, Semibold for
     headlines. Do not set a weight by hand. --}}
@props(['size' => 'lg', 'as' => 'h2'])
@php
$sizes = [
    'sm'  => 'text-display-sm',
    'md'  => 'text-display-md',
    'lg'  => 'text-display-lg',
    'xl'  => 'text-display-xl',
    '2xl' => 'text-display-2xl',
];
@endphp
<{{ $as }} {{ $attributes->class([$sizes[$size] ?? $sizes['lg']]) }}>{{ $slot }}</{{ $as }}>
