{{-- Icon inside a tile. 32px grid, 2pt stroke → 1.5 at 24px (manual p.21).
     Icons inform and are actionable; never decorative. --}}
@props(['icon', 'activate' => false])
<div {{ $attributes->class(['icon-plate', 'icon-plate-activate' => $activate]) }}>
    <flux:icon :name="$icon" variant="outline" class="size-6 icon-brand" />
</div>
