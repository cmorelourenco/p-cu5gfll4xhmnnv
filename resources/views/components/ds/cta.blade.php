@props(['eyebrow' => null, 'heading', 'body' => null])
<x-ds.section surface="invert" rhythm="loose" id="contact">
    <div class="mx-auto max-w-3xl text-center">
        @if($eyebrow)
            <x-ds.eyebrow class="justify-center">{{ $eyebrow }}</x-ds.eyebrow>
        @endif
        <x-ds.display size="xl" class="mt-5">{{ $heading }}</x-ds.display>
        @if($body)
            <p class="text-lead mt-6 mx-auto text-mid-blue">{{ $body }}</p>
        @endif
        <div class="mt-10 flex flex-wrap items-center justify-center gap-3">
            {{ $slot }}
        </div>
    </div>
</x-ds.section>
