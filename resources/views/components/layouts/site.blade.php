@props(['title' => 'C-MORE'])
<!DOCTYPE html>
<html lang="en" class="scroll-pt-24">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>

    {{-- Figtree — the brand typeface (manual p.19), self-hosted through the
         Vite fonts plugin. Light 300 / Regular 400 / Medium 500 /
         Semibold 600 / Bold 700. --}}
    @fonts

    {{-- Order is the cascade. app.css carries the Tailwind theme; the four
         after it are plain unlayered CSS on those tokens, so they outrank
         every Tailwind layer and the later file wins. arrow.css binds to
         .btn-activate, defined in app.css, so it stays last. --}}
    @vite([
        'resources/css/app.css',
        'resources/css/turn.css',
        'resources/css/convergence.css',
        'resources/css/enhanced.css',
        'resources/css/arrow.css',
        'resources/js/app.js',
        'resources/js/enhanced.js',
    ])
    @fluxAppearance
    {{-- Default to light. Flux's own default is 'system', which turns the page
         navy on a dark-mode machine — wrong first impression for a brand whose
         layouts are 50% warm neutral. A visitor's own choice still wins. --}}
    <script>
        window.Flux.applyAppearance(window.localStorage.getItem('flux.appearance') || 'light')
    </script>
    {{-- No @wireUiStyles: WireUI 2.6 ships no dist/wireui.css and the route
         500s on the missing file. Its styles come from Tailwind scanning the
         package instead — see the @source lines in resources/css/app.css. --}}
</head>
<body class="min-h-screen antialiased">
    {{-- The section rail is built from the DOM by enhanced.js. It sits here,
         outside the Livewire root, so a wire:model.live round trip cannot
         morph it away. --}}
    <nav class="enh-rail" aria-label="Sections" data-enh-rail>
        <p class="enh-rail__title">Jump to</p>
    </nav>

    {{ $slot }}

    {{-- One toast container per page; components dispatch into it. --}}
    <flux:toast />

    {{-- WireUI registers its Alpine plugins, so it must load before Livewire
         boots Alpine. --}}
    @wireUiScripts
    @livewireScripts
    @fluxScripts
</body>
</html>
