{{-- Convergence — the brand spinner. Four squares leave the ring and return
     to it, which is the wordmark's stair rendered as a wait. Motion is in
     convergence.css and stops under prefers-reduced-motion.

     The mask needs a document-unique id, so it is derived from :name. --}}
@props(['name' => 'ds', 'size' => '3.5rem', 'label' => 'Loading'])
<svg class="sp-conv" viewBox="0 0 320 320" role="status" aria-label="{{ $label }}"
     style="--spin-size: {{ $size }}">
    <defs>
        <mask id="conv-mask-{{ $name }}">
            <rect x="0" y="0" width="320" height="320" fill="#fff"></rect>
            <rect class="conv-notch" x="143.0" y="68.0"  width="34" height="40" fill="#000"></rect>
            <rect class="conv-notch" x="212.0" y="143.0" width="40" height="34" fill="#000"></rect>
            <rect class="conv-notch" x="143.0" y="212.0" width="34" height="40" fill="#000"></rect>
            <rect class="conv-notch" x="68.0"  y="143.0" width="40" height="34" fill="#000"></rect>
        </mask>
    </defs>
    <g class="conv-rotor">
        <rect class="conv-ring" x="88" y="88" width="144" height="144" rx="52"
              fill="none" stroke="currentColor" stroke-width="36"
              mask="url(#conv-mask-{{ $name }})"></rect>
        <rect class="conv-sq" x="142.0" y="70.0"  width="36" height="36" style="--dx: 0px;   --dy: -37px"></rect>
        <rect class="conv-sq" x="214.0" y="142.0" width="36" height="36" style="--dx: 37px;  --dy: 0px"></rect>
        <rect class="conv-sq" x="142.0" y="214.0" width="36" height="36" style="--dx: 0px;   --dy: 37px"></rect>
        <rect class="conv-sq" x="70.0"  y="142.0" width="36" height="36" style="--dx: -37px; --dy: 0px"></rect>
    </g>
</svg>
