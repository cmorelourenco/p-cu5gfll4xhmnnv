{{-- Turn — progress as ten discrete squares rather than a filled track.
     Each turns a quarter as it fills, so the bar is countable and exact at
     once; the leading square carries the fraction. turn.css reads --p.

     demo  — the bar self-cycles: fills, holds, rewinds, forever. For a
             gallery, or anywhere there is no control to drive it. A cycling
             bar has no value to report, so it is marked indeterminate —
             announcing a number here would be announcing a number nobody
             set. Give it a real :value instead and the squares transition
             between positions on every change. --}}
@props(['value' => 0, 'units' => 10, 'label' => 'Progress', 'demo' => false])
<div {{ $attributes->class(['pb pb-units', 'pb-units--demo' => $demo]) }}
     @unless($demo) style="--p: {{ $value }}" @endunless
     role="progressbar"
     aria-valuemin="0" aria-valuemax="100"
     @unless($demo) aria-valuenow="{{ $value }}" @endunless
     aria-label="{{ $label }}">
    @for($n = 0; $n < $units; $n++)
        <i style="--n: {{ $n }}"></i>
    @endfor
</div>
