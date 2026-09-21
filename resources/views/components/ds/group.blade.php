{{-- A component group inside the single Components section: Actions, Content,
     Forms, Data display, Navigation and overlays. Three levels, mirroring
     Flux's own split — section, group, component — so the old 01–08 numbering
     is gone. The id is stable and hand-given, because in-page links point at
     it; enhanced.js only auto-assigns ids to headings that lack one. --}}
@props(['id'])
<x-ds.display size="md" id="{{ $id }}" {{ $attributes->class('mt-5 group-title') }}>{{ $slot }}</x-ds.display>
