@props(['links' => []])
<header class="sticky top-0 z-50 border-b border-line bg-ground/85 backdrop-blur-md">
    <div class="container-site flex h-18 items-center justify-between gap-6">
        <x-ds.brand />

        <nav class="hidden items-center gap-8 md:flex" aria-label="Primary">
            @foreach($links as $href => $label)
                <a href="{{ $href }}"
                   class="text-sm font-medium text-ink-muted transition-colors duration-(--duration-quick) hover:text-ink">
                    {{ $label }}
                </a>
            @endforeach
        </nav>

        <div class="flex items-center gap-3">
            {{-- Appearance toggle. flux.js replaces the small `window.Flux` shim
                 that @fluxAppearance defines, so applyAppearance() is gone by the
                 time anyone clicks — the real object exposes a `dark` setter,
                 which also persists the choice. Works in the static export too.
                 Both icons ship; CSS picks one. --}}
            <flux:button variant="ghost" size="sm" aria-label="Toggle dark mode"
                onclick="window.Flux.dark = !window.Flux.dark">
                <flux:icon name="moon" variant="outline" class="size-5 icon-brand dark:hidden" />
                <flux:icon name="sun" variant="outline" class="size-5 icon-brand hidden dark:block" />
            </flux:button>

            <flux:button href="#" variant="ghost" size="sm" class="hidden sm:inline-flex">
                Secondary
            </flux:button>
            {{-- The single activation moment in the chrome. Flux primary +
                 .btn-activate + the arrow is the one way to make a primary
                 button; there is no second recipe. --}}
            <flux:button href="#" variant="primary" size="sm" class="btn-activate">
                Primary action
                <x-ds.px size="sm" />
            </flux:button>
        </div>
    </div>
</header>
