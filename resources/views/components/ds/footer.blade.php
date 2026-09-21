@props(['groups' => [], 'blurb' => null])
<footer class="surface-invert border-t border-line-invert">
    <div class="container-site py-16">
        <div class="grid gap-12 md:grid-cols-[1.5fr_repeat(3,1fr)]">
            <div>
                <x-ds.brand size="lg" />
                <p class="mt-4 max-w-xs text-sm text-mid-blue">
                    {{-- The placeholder stands until a page passes its own line, so
                         the design system page still shows the slot is there. --}}
                    {{ $blurb ?? 'Placeholder footer copy. The product positioning goes here once the brief lands.' }}
                </p>
            </div>

            @foreach($groups as $title => $items)
                <div>
                    <h3 class="text-sm font-semibold">{{ $title }}</h3>
                    <ul class="mt-4 space-y-3">
                        @foreach($items as $href => $label)
                            <li>
                                <a href="{{ $href }}"
                                   class="text-sm text-mid-blue transition-colors duration-(--duration-quick) hover:text-off-white">
                                    {{ $label }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>

        <hr class="rule-activate mt-14 mb-6">
        <div class="flex flex-col gap-2 text-xs text-mid-blue sm:flex-row sm:justify-between">
            <p>&copy; C-MORE {{ date('Y') }}</p>
            <p>Prototype &middot; Brand Manual 2025-03 V2</p>
        </div>
    </div>
</footer>
