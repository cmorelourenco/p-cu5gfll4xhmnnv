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
            <flux:button href="#" variant="ghost" size="sm" class="hidden sm:inline-flex">
                Secondary
            </flux:button>
            {{-- The single activation moment in the chrome. --}}
            <flux:button href="#" size="sm" class="btn-activate">
                Primary action
            </flux:button>
        </div>
    </div>
</header>
