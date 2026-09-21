@props(['eyebrow' => null, 'heading', 'body' => null])
<x-ds.section surface="invert" rhythm="loose" id="contact">
    <div class="mx-auto max-w-3xl text-center">
        @if($eyebrow)
            <x-ds.eyebrow class="justify-center">{{ $eyebrow }}</x-ds.eyebrow>
        @endif
        {{-- Stepped down on small screens. The display scale is fixed-size, so
             xl stays 68px on a 375px phone: the heading swallows the viewport
             and pushes the buttons — the only reason this band exists — below
             the fold. It reaches the full size from `sm` up. --}}
        <x-ds.display size="lg" class="mt-5 sm:text-display-xl">{{ $heading }}</x-ds.display>
        @if($body)
            <p class="text-lead mt-6 mx-auto text-mid-blue">{{ $body }}</p>
        @endif
        <div class="mt-10 flex flex-wrap items-center justify-center gap-3">
            {{ $slot }}
        </div>
    </div>
</x-ds.section>
