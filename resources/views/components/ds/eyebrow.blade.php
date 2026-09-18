{{-- The small uppercase label above a section title. Carries a lime tick
     so the 15% activation budget is spent in a controlled place. --}}
@props(['tick' => true])
<p {{ $attributes->class('eyebrow') }}>
    @if($tick)
        <span class="inline-block h-1.5 w-1.5 rounded-full bg-lime" aria-hidden="true"></span>
    @endif
    {{ $slot }}
</p>
