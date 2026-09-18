@props([
    'surface' => 'ground',   /* ground | surface | sunken | invert */
    'rhythm'  => 'base',     /* tight | base | loose */
    'id'      => null,
])
@php
$surfaces = [
    'ground'  => 'bg-ground',
    'surface' => 'bg-surface',
    'sunken'  => 'bg-surface-sunken',
    'invert'  => 'surface-invert',
];
$rhythms = ['tight' => 'section-tight', 'base' => 'section', 'loose' => 'section-loose'];
@endphp
<section @if($id) id="{{ $id }}" @endif
    {{ $attributes->class([$surfaces[$surface] ?? $surfaces['ground'], $rhythms[$rhythm] ?? 'section']) }}>
    <div class="container-site">
        {{ $slot }}
    </div>
</section>
