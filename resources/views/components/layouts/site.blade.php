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

    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
