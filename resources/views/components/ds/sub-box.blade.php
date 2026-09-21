{{-- A boxed sub-section: the label plus the demo it owns.

     On the static page this wrapper was assembled in JavaScript from a
     data-sub-span="N" count, because the markup it wrapped was generated and
     could not nest. Here the nesting is real, so the box is just a box.

     wrap  — the box claims a full row of its parent grid or flex container.
             On by default, matching what the JS did for every counted box.
             Turn it OFF when the box replaces a container that was already
             a placed grid child, or it will break the column it sat in.
     row   — the box lays its own children out in a wrapped flex row, for
             when it replaces a flex parent that used to do the spacing. --}}
@props(['label' => null, 'wrap' => true, 'row' => false])
<div {{ $attributes->class([
        'sub-box',
        'sub-box--wrap' => $wrap,
        'sub-box--row'  => $row,
    ]) }}>
    @if($label)
        <x-ds.sub-label>{!! $label !!}</x-ds.sub-label>
    @endif
    {{ $slot }}
</div>
