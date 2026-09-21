{{-- Living design system. State lives in App\Livewire\DesignSystem.

     Three levels of structure, mirroring Flux's own split:

         Colour / Typography / Scales     foundations
         Components                       one section, five groups
         The rules that matter

     The old 01–08 numbering is gone: it made foundations and components read
     as peers when they are not. The five former component sections are now
     h2 groups inside #components, and each keeps its old id (#actions,
     #content, #forms, #data, #nav) so in-page links still land. --}}
<div>
        <x-ds.navbar :links="[
            '#colour' => 'Colour', '#type' => 'Type', '#scales' => 'Scales',
            '#components' => 'Components', '#rules' => 'Rules',
        ]" />

        <x-ds.section rhythm="loose">
            <x-ds.eyebrow>Design system</x-ds.eyebrow>
            <x-ds.display as="h1" size="xl" class="mt-6 max-w-3xl">
                The C-MORE system, <span class="mark-activate">assembled</span>.
            </x-ds.display>
            <x-ds.lead class="mt-7">
                Brand Manual 2025-03 V2, expressed as Tailwind v4 tokens over Flux UI and
                WireUI. Everything below is live, not a screenshot. This page is a placeholder
                standing in for the landing page until the product brief lands.
            </x-ds.lead>
        </x-ds.section>

        {{-- ─────────────────────────── COLOUR ─────────────────────────── --}}
        <x-ds.section surface="surface" id="colour">
            <x-ds.eyebrow>Colour</x-ds.eyebrow>

            {{-- Current / Alternatives.

                 The split exists so nothing experimental can be mistaken for
                 approved palette: Current is the manual verbatim, Alternatives
                 is everything proposed since.

                 wire:ignore because the panels are static markup and the tab
                 state lives in the DOM (enhanced.js sets `hidden`). Without it
                 the first wire:model.live round trip from the Forms group would
                 morph the open tab shut. --}}
            <div wire:ignore>
                <div class="enh-tabs" role="tablist" aria-label="Colour palette view" data-enh-tabs>
                    <button type="button" class="enh-tab" role="tab" id="colour-tab-current"
                            aria-controls="colour-panel-current" aria-selected="true">Current</button>
                    <button type="button" class="enh-tab" role="tab" id="colour-tab-alt"
                            aria-controls="colour-panel-alt" aria-selected="false" tabindex="-1">Alternatives</button>
                </div>

                <div id="colour-panel-current" class="enh-tabpanel" role="tabpanel" aria-labelledby="colour-tab-current">
                    <x-ds.display size="md" class="mt-5">Primitives</x-ds.display>
                    <p class="mt-4 max-w-2xl text-sm text-ink-muted">
                        Verbatim from p.17. Always 100% solid &mdash; tints need C-MORE Marketing sign-off.
                    </p>

                    <h3 class="mt-12 text-sm font-semibold uppercase tracking-[0.1em] text-ink-subtle">The brand colours</h3>
                    <p class="mt-3 max-w-2xl text-sm text-ink-muted">
                        Three: the main identifies, the secondary is the ground almost everything
                        sits on, the accent activates. They map onto the 50/35/15 rule exactly,
                        though not in this order — the ground is the 50%.
                    </p>
                    <div class="mt-5 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        <x-ds.swatch name="Graphite — main"         hex="#343434" note="35%. Identifies: structure, type, chrome." />
                        <x-ds.swatch name="Light Beige — secondary" hex="#F2F1ED" ring note="50%. The page ground, and the label on every solid brand button." />
                        <x-ds.swatch name="Coral — accent"          hex="#F46D4F" note="15%. Activates. Only large or bold text on it — 4.24:1." />
                    </div>

                    <h3 class="mt-14 text-sm font-semibold uppercase tracking-[0.1em] text-ink-subtle">Supporting</h3>
                    <p class="mt-3 max-w-2xl text-sm text-ink-muted">
                        To communicate ALMA.
                    </p>
                    <p class="mt-2 max-w-2xl text-xs text-ink-subtle">
                        Not wired to anything yet — no token reads them, so changing one changes
                        nothing. Names are provisional.
                    </p>
                    <div class="mt-5 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                        <x-ds.swatch name="Taupe"    hex="#D6D4CA" ring note="Unassigned." />
                        <x-ds.swatch name="Mid Blue" hex="#909DB6" pms="PMS 535C" note="Unassigned here — but still the live value behind --color-line-strong." />
                        <x-ds.swatch name="Gold"     hex="#DBC67E" note="Unassigned." />
                    </div>

                    <h3 class="mt-14 text-sm font-semibold uppercase tracking-[0.1em] text-ink-subtle">Activation family &mdash; in use</h3>
                    <div class="mt-5 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                        <x-ds.swatch name="Coral Deep" hex="#F44E29" note="The coral's hover state." />
                        <x-ds.swatch name="Coral Tint" hex="#F9E7E3" note="Activation, quietly — icon plates and subtle fills." />
                    </div>

                    <div class="mt-8 max-w-2xl rounded-xl border border-line bg-surface-sunken p-5">
                        <p class="text-sm font-semibold">Loose end: Blue #4E638B left the palette but not the code</p>
                        <p class="mt-2 text-sm leading-relaxed text-ink-muted">
                            It is no longer a supporting colour, yet it is still the value behind
                            <code class="font-mono">--color-ink-muted</code> &mdash; every piece of secondary
                            copy on this page, including this sentence. Same for
                            <code class="font-mono">--color-line-strong</code>, which is Mid Blue. Until those two
                            tokens are pointed somewhere else, the blues are still doing the work.
                        </p>
                    </div>

                    <h3 class="mt-14 text-sm font-semibold uppercase tracking-[0.1em] text-ink-subtle">Primary neutrals &mdash; 50% of a layout</h3>
                    <div class="mt-5 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                        <x-ds.swatch name="Off White"   hex="#FAFAFA" ring />
                        <x-ds.swatch name="Light Beige" hex="#F2F1ED" ring note="The page ground — and the secondary brand colour, above." />
                        <x-ds.swatch name="Mid Beige"   hex="#E9E7E2" ring note="Sunken wells." />
                        <x-ds.swatch name="Dark Beige"  hex="#E0DED7" ring note="Hairlines." />
                    </div>

                    <hr class="rule-activate my-16">

                    <x-ds.display size="md">Sand &mdash; the neutral ramp</x-ds.display>
                    <p class="mt-4 max-w-2xl text-sm text-ink-muted">
                        Stock components default to a cold grey. They are re-pointed at this warm
                        ramp, and re-skin themselves. 50&ndash;300 are the manual's neutrals
                        untouched; 950 is the main colour.
                    </p>
                    <div class="mt-8 flex overflow-hidden rounded-xl ring-1 ring-inset ring-line">
                        @foreach(['50'=>'#FAFAFA','100'=>'#F2F1ED','200'=>'#E9E7E2','300'=>'#E0DED7','400'=>'#C3C0B8','500'=>'#96958E','600'=>'#6E6E6A','700'=>'#5F5F5C','800'=>'#50504E','900'=>'#424240','950'=>'#343434'] as $step => $hex)
                            <div class="flex h-24 flex-1 items-end justify-center pb-2" style="background-color: {{ $hex }}">
                                <span class="font-mono text-[10px] {{ (int)$step >= 500 ? 'text-off-white/80' : 'text-ink/60' }}">{{ $step }}</span>
                            </div>
                        @endforeach
                    </div>

                    <hr class="rule-activate my-16">

                    <x-ds.display size="md">Semantic tokens</x-ds.display>
                    <p class="mt-4 max-w-2xl text-sm text-ink-muted">
                        What a colour <em>means</em>. Components reference these, never the primitives &mdash;
                        which is why dark mode works without touching a single component.
                    </p>
                    <div class="mt-8 overflow-x-auto">
                        <table class="w-full min-w-[46rem] text-left text-sm">
                            <thead class="border-b border-line text-xs uppercase tracking-wider text-ink-subtle">
                                <tr><th class="py-3 pr-6 font-semibold">Token</th><th class="py-3 pr-6 font-semibold">Light</th><th class="py-3 pr-6 font-semibold">Dark</th><th class="py-3 font-semibold">Use</th></tr>
                            </thead>
                            <tbody class="divide-y divide-line">
                                @foreach([
                                    ['--color-accent', 'Graphite', 'Coral', 'Primary buttons, links, focus rings. Flux reads this directly.'],
                                    ['--color-activation', 'Coral', 'Coral', 'The 15%. One moment per viewport, foreground always Graphite — 4.24:1, so large or bold only.'],
                                    ['--color-ground', 'Light Beige', 'Graphite', 'The page itself.'],
                                    ['--color-surface', 'White', '#3E3E3E', 'Cards sitting on the ground.'],
                                    ['--color-surface-sunken', 'Mid Beige', '#2A2A2A', 'Wells and inset panels.'],
                                    ['--color-ink', 'Graphite', 'Off White', 'Headings and primary copy.'],
                                    ['--color-ink-muted', 'Blue', 'Mid Blue', 'Secondary copy. 5.3:1 — AA. Not recoloured; see Colour notes.'],
                                    ['--color-ink-subtle', 'Sand 600', '#A2A2A2', 'Meta and captions. 4.9:1 — AA.'],
                                    ['--color-line', 'Dark Beige', 'Mid Blue 24%', 'Hairlines. Elevation starts here, not with shadow.'],
                                ] as [$token, $light, $dark, $use])
                                    <tr>
                                        <td class="py-3 pr-6 font-mono text-xs">{{ $token }}</td>
                                        <td class="py-3 pr-6 text-ink-muted">{{ $light }}</td>
                                        <td class="py-3 pr-6 text-ink-muted">{{ $dark }}</td>
                                        <td class="py-3 text-ink-muted">{{ $use }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Proposed, not approved. Nothing here has Marketing sign-off. --}}
                <div id="colour-panel-alt" class="enh-tabpanel" role="tabpanel" aria-labelledby="colour-tab-alt" hidden>
                    <x-ds.display size="md">What we&rsquo;re trying</x-ds.display>

                    <p class="mt-12 text-sm font-semibold uppercase tracking-[0.1em] text-ink-subtle">Activation hue study</p>
                    <p class="mt-3 max-w-2xl text-sm text-ink-muted">
                        Testing a lighter blue against slight variations of the lime. Only the hue moves
                        &mdash; all three greens sit at the same lightness, so nothing else is changing.
                    </p>
                    <div class="hue-study mt-6">
                        @foreach([
                            ['#DFF000', 'More yellow',    'hue 115&deg;', 'Warmer, closer to acid yellow.'],
                            ['#C0FA00', 'Lime &mdash; current', 'hue 125&deg;', 'The brand lime, unchanged.'],
                            ['#9DFF34', 'Less yellow',    'hue 133&deg;', 'Cooler, closer to grass green.'],
                        ] as [$hex, $name, $hue, $note])
                            <div class="hue-col" style="--g: {{ $hex }}">
                                <p class="hue-label"><b>{!! $name !!}</b> &middot; {{ $hex }} &middot; {!! $hue !!}</p>
                                <div class="pair-panel hue-panel-blue">
                                    <p>Electric Blue carries the weight.</p>
                                    <span class="pair-chip">Activate</span>
                                </div>
                                <div class="pair-panel hue-panel-green">
                                    <p>{{ $note }}</p>
                                    <span class="pair-chip">Secondary</span>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <p class="mt-16 text-sm font-semibold uppercase tracking-[0.1em] text-ink-subtle">Acid yellow &amp; greys</p>
                    <p class="mt-3 max-w-2xl text-sm text-ink-muted">
                        The acid yellow against three neutral greys instead of a blue. Only the grey
                        moves. All three clear 4.5:1 on the yellow in both directions, so any of them
                        can carry it or be carried by it.
                    </p>
                    <div class="hue-study mt-6">
                        @foreach([
                            ['#1B1B1B', 'Near black'],
                            ['#383838', 'Charcoal'],
                            ['#585858', 'Mid grey'],
                        ] as [$hex, $name])
                            <div class="hue-col" style="--gy: {{ $hex }}">
                                <p class="hue-label"><b>{{ $name }}</b> &middot; {{ $hex }}</p>
                                <div class="pair-panel grey-panel-dark">
                                    <p>Grey {{ ltrim($hex, '#') }} holds the surface.</p>
                                    <span class="pair-chip">Activate</span>
                                </div>
                                <div class="pair-panel grey-panel-acid">
                                    <p>Acid yellow holds the surface.</p>
                                    <span class="pair-chip">Ink</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </x-ds.section>

        {{-- ─────────────────────────── TYPE ─────────────────────────── --}}
        <x-ds.section id="type">
            <x-ds.eyebrow>Typography</x-ds.eyebrow>
            <x-ds.display size="md" class="mt-5">Figtree</x-ds.display>
            <p class="mt-4 max-w-2xl text-sm text-ink-muted">
                Five weights, paired as the manual prescribes (p.20). Arial substitutes where
                Figtree is unavailable. The scale below bakes in weight and tracking, so nothing
                downstream should set either by hand.
            </p>

            <div class="mt-12 space-y-8 border-t border-line pt-8">
                @foreach([
                    ['text-display-2xl', 'display-2xl', '88px / 0.94 / Semibold', 'Hero only'],
                    ['text-display-xl',  'display-xl',  '68px / 0.96 / Semibold', 'Section openers'],
                    ['text-display-lg',  'display-lg',  '52px / 1.02 / Semibold', 'Section titles'],
                    ['text-display-md',  'display-md',  '40px / 1.08 / Medium',   'Sub-sections, stats'],
                    ['text-display-sm',  'display-sm',  '30px / 1.16 / Medium',   'Card titles'],
                ] as [$class, $name, $spec, $use])
                    <div class="grid gap-3 md:grid-cols-[1fr_auto] md:items-baseline">
                        <p class="{{ $class }}">Purpose driven</p>
                        <div class="text-right text-xs text-ink-subtle md:pl-8">
                            <p class="font-mono">{{ $name }}</p>
                            <p>{{ $spec }}</p>
                            <p class="text-ink-muted">{{ $use }}</p>
                        </div>
                    </div>
                @endforeach

                <div class="grid gap-3 border-t border-line pt-8 md:grid-cols-[1fr_auto] md:items-baseline">
                    <p class="text-lead max-w-xl">
                        Lead paragraph, Figtree Light &mdash; body copy where a greater level
                        of sophistication is required.
                    </p>
                    <div class="text-right text-xs text-ink-subtle md:pl-8">
                        <p class="font-mono">lead</p><p>21px / 1.55 / Light</p>
                    </div>
                </div>

                <div class="grid gap-3 border-t border-line pt-8 md:grid-cols-[1fr_auto] md:items-baseline">
                    <p class="max-w-xl text-base text-ink-muted">
                        Body, Figtree Regular &mdash; most body copy applications. Set on the
                        muted ink token so it holds 5.3:1 against the beige ground.
                    </p>
                    <div class="text-right text-xs text-ink-subtle md:pl-8">
                        <p class="font-mono">base</p><p>16px / 1.5 / Regular</p>
                    </div>
                </div>

                <div class="grid gap-3 border-t border-line pt-8 md:grid-cols-[1fr_auto] md:items-baseline">
                    <x-ds.eyebrow>Eyebrow label</x-ds.eyebrow>
                    <div class="text-right text-xs text-ink-subtle md:pl-8">
                        <p class="font-mono">eyebrow</p><p>13px / 0.1em / Semibold</p>
                    </div>
                </div>
            </div>
        </x-ds.section>

        {{-- ─────────────────────────── SCALES ───────────────────────────
             A foundation, so it sits with Colour and Typography rather than
             after the components that consume it. --}}
        <x-ds.section surface="surface" id="scales">
            <x-ds.eyebrow>Scales</x-ds.eyebrow>
            <x-ds.display size="md" class="mt-5">Elevation and radius</x-ds.display>

            <x-ds.spec>Elevation</x-ds.spec>
            <div class="mt-5 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
                @foreach([
                    ['shadow-hairline', 'hairline', 'The default. A 1px line, no shadow at all.'],
                    ['shadow-raised',   'raised',   'Cards that respond to a pointer.'],
                    ['shadow-floating', 'floating', 'Popovers and dropdowns.'],
                    ['shadow-overlay',  'overlay',  'Modals and sheets.'],
                ] as [$class, $name, $use])
                    <div class="rounded-xl bg-surface p-5 {{ $class }}">
                        <p class="font-mono text-xs">{{ $name }}</p>
                        <p class="mt-2 text-xs text-ink-muted">{{ $use }}</p>
                    </div>
                @endforeach
            </div>

            <x-ds.spec>Radius</x-ds.spec>
            <div class="mt-5 flex flex-wrap items-end gap-5">
                @foreach(['rounded-sm'=>'sm 8','rounded-md'=>'md 12','rounded-lg'=>'lg 16','rounded-xl'=>'xl 24','rounded-2xl'=>'2xl 32','rounded-3xl'=>'3xl 44'] as $class => $label)
                    <div class="flex flex-col items-center gap-2">
                        <div class="size-20 bg-surface-sunken ring-1 ring-inset ring-line {{ $class }}"></div>
                        <span class="font-mono text-[10px] text-ink-subtle">{{ $label }}</span>
                    </div>
                @endforeach
                <div class="flex flex-col items-center gap-2">
                    <div class="h-10 w-20 rounded-full bg-surface-sunken ring-1 ring-inset ring-line"></div>
                    <span class="font-mono text-[10px] text-ink-subtle">pill</span>
                </div>
            </div>
        </x-ds.section>

        {{-- ───────────────────────── COMPONENTS ─────────────────────────
             One section, five groups. Flux has Guides / Layouts / Components
             with a flat A–Z list under the last; the Actions / Content / Forms
             grouping is ours and sits as a middle level. --}}
        <x-ds.section id="components">
            <x-ds.eyebrow>Components</x-ds.eyebrow>

            {{-- ── Actions ── --}}
            <x-ds.group id="actions">Actions</x-ds.group>

            <x-ds.spec>Buttons</x-ds.spec>

            {{-- Five variants, and every name is one Flux actually accepts.
                 `secondary` and `tertiary` were dropped rather than invented
                 as aliases: a name the framework does not accept is a
                 dictionary somebody has to maintain.

                 primary IS the coral button. Flux ships primary reading
                 --color-accent; .btn-activate overrides that to the activation
                 treatment ON BUTTONS ONLY — of the 15 elements resolving
                 --color-accent, 4 are buttons and 11 are form controls
                 (checkbox ticks, radio dots, switch fills), which are left
                 alone. There is one way to make a primary button, not two. --}}
            <x-ds.sub-box label="Variants">
                <div class="mt-5 flex flex-wrap items-center gap-3">
                    <flux:button variant="primary" class="btn-activate">
                        Primary<x-ds.px />
                    </flux:button>
                    <flux:button variant="outline" class="btn-outline">
                        Outline<x-ds.px />
                    </flux:button>
                    <flux:button variant="filled" class="btn-filled">
                        Filled<x-ds.px />
                    </flux:button>
                    {{-- No arrow: ghost is for dense rows and icon-only
                         buttons, which are not forward moves. --}}
                    <flux:button variant="ghost" class="btn-ghost">Ghost</flux:button>
                    {{-- Danger is left exactly as Flux ships it — the only
                         variant whose meaning comes from outside the brand. --}}
                    <flux:button variant="danger">Danger</flux:button>
                </div>
            </x-ds.sub-box>

            <x-ds.sub-box label="Sizes, icons and states">
                <div class="mt-5 flex flex-wrap items-center gap-3">
                    <flux:button size="xs" variant="filled" class="btn-filled">
                        Extra small<x-ds.px size="sm" />
                    </flux:button>
                    <flux:button size="sm" variant="filled" class="btn-filled">
                        Small<x-ds.px size="sm" />
                    </flux:button>
                    <flux:button variant="filled" class="btn-filled">
                        Base<x-ds.px />
                    </flux:button>
                    {{-- .btn-lg is ours: Flux sizes buttons xs/sm/base and
                         stops, which is right for an app and too small for a
                         landing hero. --}}
                    <flux:button variant="filled" class="btn-filled btn-lg">
                        Large<x-ds.px size="lg" />
                    </flux:button>
                </div>
                <div class="mt-4 flex flex-wrap items-center gap-3">
                    <flux:button icon="arrow-down-tray" variant="filled" class="btn-filled">Leading icon</flux:button>
                    <flux:button icon-trailing="arrow-right" variant="filled" class="btn-filled">Trailing icon</flux:button>
                    <flux:button icon="cog-6-tooth" variant="filled" class="btn-filled btn-cog" square aria-label="Settings" />
                    <flux:button icon="trash" variant="filled" class="btn-filled" square aria-label="Delete" />
                    <flux:button variant="filled" class="btn-filled" disabled>Disabled</flux:button>
                </div>
            </x-ds.sub-box>

            <x-ds.spec>Badges</x-ds.spec>
            <x-ds.sub-box label="Variants">
                <div class="mt-5 flex flex-wrap items-center gap-3">
                    <flux:badge>Default</flux:badge>
                    <flux:badge class="badge-solid">Solid</flux:badge>
                </div>
            </x-ds.sub-box>

            <x-ds.sub-box label="Sizes and icons">
                <div class="mt-5 flex flex-wrap items-center gap-3">
                    <flux:badge size="sm" class="badge-solid">Small</flux:badge>
                    <flux:badge class="badge-solid">Default</flux:badge>
                    <flux:badge size="lg" class="badge-solid">Large</flux:badge>
                    <flux:badge icon="check-circle" color="lime" class="badge-solid">With icon</flux:badge>
                </div>
            </x-ds.sub-box>

            <x-ds.sub-box label="Status">
                <div class="mt-4 flex flex-wrap items-center gap-3">
                    <flux:badge color="lime">Assessed</flux:badge>
                    <flux:badge color="amber">Pending</flux:badge>
                    <flux:badge color="red">Overdue</flux:badge>
                    <flux:badge color="blue">Informative</flux:badge>
                    <flux:badge color="zinc">Neutral</flux:badge>
                </div>
            </x-ds.sub-box>

            <x-ds.spec>Callout</x-ds.spec>
            <div class="mt-5 grid gap-4 lg:grid-cols-2">
                <flux:callout icon="information-circle" heading="Neutral by default"
                    text="Callouts carry one message. If it needs two, it needs two callouts." />
                <flux:callout variant="success" icon="check-circle" heading="Success"
                    text="Derived, not from the manual — your brand ships no status palette." />
                <flux:callout variant="warning" icon="exclamation-triangle" heading="Warning"
                    text="Tuned to sit alongside the beige ground rather than fight it." />
                <flux:callout variant="danger" icon="x-circle" heading="Danger"
                    text="The only red in the system. Use it when something is actually wrong." />
            </div>

            <x-ds.spec>Tooltip</x-ds.spec>
            <div class="mt-5 flex flex-wrap items-center gap-3">
                <flux:tooltip content="Appears above, centred">
                    <flux:button variant="outline" class="btn-outline">Hover me</flux:button>
                </flux:tooltip>
                <flux:tooltip position="right" content="Positioned right">
                    <flux:button variant="ghost" class="btn-ghost" icon="question-mark-circle" square aria-label="Help" />
                </flux:tooltip>
                <flux:tooltip content="With a keyboard hint" kbd="⌘K">
                    <flux:button variant="ghost" class="btn-ghost">Command</flux:button>
                </flux:tooltip>
            </div>

            <x-ds.spec>Progress and skeleton</x-ds.spec>
            <div class="mt-5 grid max-w-2xl gap-6">
                {{-- Convergence: the wordmark's four squares leave the ring and
                     return to it, so the wait is the mark rather than a generic
                     spinner. --}}
                <x-ds.sub-box label="Spinner">
                    <div class="flex items-center gap-4">
                        <x-ds.spinner name="ds" />
                    </div>
                </x-ds.sub-box>

                {{-- Two bars, because one cannot show both things at once.

                     An earlier version had a single bar that cycled until the
                     first nudge and then handed over for good. In a gallery
                     the button is the first thing anyone touches, so the
                     component spent the rest of its life looking dead. --}}
                <x-ds.sub-box label="Bar">
                    <div class="space-y-6">
                        {{-- The motion. Nothing set this, so it reports no
                             value — indeterminate, and it never stops. --}}
                        <div class="space-y-2">
                            <x-ds.progress-units demo />
                            <p class="font-mono text-xs text-ink-subtle">self-cycling &mdash; no value</p>
                        </div>

                        {{-- The same component on real state, which is also
                             the proof that the round trip works. --}}
                        <div class="space-y-3">
                            <x-ds.progress-units :value="$progress" />
                            <div class="flex flex-wrap items-center gap-3">
                                <flux:button size="sm" variant="ghost" class="btn-ghost" icon="minus" wire:click="nudgeProgress(-10)" aria-label="Decrease" />
                                <flux:button size="sm" variant="ghost" class="btn-ghost" icon="plus" wire:click="nudgeProgress(10)" aria-label="Increase" />
                                <span class="font-mono text-xs tabular-nums text-ink-subtle">{{ $progress }}%</span>
                            </div>
                        </div>
                    </div>
                </x-ds.sub-box>

                <x-ds.sub-box label="Skeleton">
                    <div class="space-y-2">
                        <flux:skeleton class="h-4 w-2/5" />
                        <flux:skeleton class="h-3 w-full" />
                        <flux:skeleton class="h-3 w-4/5" />
                    </div>
                </x-ds.sub-box>
            </div>

            {{-- ── Content ── --}}
            <x-ds.group id="content">Content</x-ds.group>

            <x-ds.spec>Heading, subheading, text, link</x-ds.spec>
            <div class="type-plate mt-5 space-y-4">
                <x-ds.px shape="stair" size="md" class="type-plate__mark" />
                <flux:heading size="xl">Heading, xl</flux:heading>
                <flux:subheading size="lg">Subheading, lg &mdash; the line under a title</flux:subheading>
                <flux:text>
                    Body text at the default size. Flux <flux:text inline variant="strong">emphasises strongly</flux:text>,
                    fades to <flux:text inline variant="subtle">subtle</flux:text>, and links go to
                    <flux:link href="#content">the accent colour</flux:link> &mdash; Graphite in light,
                    Coral in dark.
                </flux:text>
                <flux:text size="sm" variant="subtle" class="type-plate__meta">Small subtle text, for captions and meta.</flux:text>
            </div>

            <x-ds.spec>Separator</x-ds.spec>
            <div class="mt-5 max-w-2xl space-y-8">
                <flux:separator />
                <flux:separator variant="subtle" />
                <flux:separator text="or" />
                <hr class="rule-activate">
                <p class="text-xs text-ink-subtle">
                    The last one is ours &mdash; <code class="font-mono">.rule-activate</code>, a hairline
                    that carries the coral for its first 4rem.
                </p>
            </div>

            <x-ds.spec>Card &mdash; Flux, on brand tokens</x-ds.spec>
            <div class="mt-5 grid gap-5 md:grid-cols-2">
                <flux:card class="space-y-4">
                    <flux:heading size="lg">Outline</flux:heading>
                    <flux:text>The default. A border, some padding, and the warm ground showing through.</flux:text>
                    <flux:button variant="filled" class="btn-filled" size="sm">Action</flux:button>
                </flux:card>
                <flux:card variant="soft" class="card-soft space-y-4">
                    <flux:heading size="lg">Soft</flux:heading>
                    <flux:text>Lower emphasis. Adapts to whatever surface it is placed on.</flux:text>
                    <flux:button variant="primary" class="btn-activate" size="sm">Action</flux:button>
                </flux:card>
            </div>

            <x-ds.spec>Tile &mdash; ours, for marketing pages</x-ds.spec>
            <div class="mt-5 grid gap-5 md:grid-cols-3">
                <x-ds.tile interactive>
                    <x-ds.icon-plate icon="shield-check" />
                    <h4 class="mt-5 font-semibold">Standard</h4>
                    <p class="mt-2 text-sm text-ink-muted">Hairline first, shadow second. Lifts 2px on hover.</p>
                </x-ds.tile>
                <x-ds.tile interactive>
                    <x-ds.icon-plate icon="bolt" activate />
                    <h4 class="mt-5 font-semibold">Activated plate</h4>
                    <p class="mt-2 text-sm text-ink-muted">Coral Tint fill. Use for the one thing that matters most.</p>
                </x-ds.tile>
                <x-ds.tile>
                    <x-ds.icon-plate icon="document-check" />
                    <h4 class="mt-5 font-semibold">Static</h4>
                    <p class="mt-2 text-sm text-ink-muted">No hover affordance, because nothing here is clickable.</p>
                </x-ds.tile>
            </div>

            <x-ds.spec>Icons &mdash; 318 Heroicons, on the brand's stroke</x-ds.spec>
            <p class="mt-3 max-w-2xl text-sm text-ink-muted">
                32px artboard, 2pt stroke, 45&deg; where possible (manual p.21) = stroke 1.5 at 24px.
                Icons inform and are actionable; they are never decorative.
            </p>
            <div class="mt-5 flex flex-wrap gap-3">
                @foreach(['shield-check','bolt','globe-alt','chart-bar','document-check','users','cog-6-tooth','bell','magnifying-glass','arrow-trending-up','cube','sparkles','clock','map-pin','lock-closed','beaker'] as $i)
                    <div class="icon-plate" title="{{ $i }}">
                        <flux:icon :name="$i" variant="outline" class="size-6 icon-brand" />
                    </div>
                @endforeach
            </div>

            {{-- ── Forms ── --}}
            <x-ds.group id="forms">Forms</x-ds.group>

            <x-ds.spec>Field &mdash; label, description, error</x-ds.spec>
            <div class="mt-5 grid max-w-3xl gap-6 sm:grid-cols-2">
                <flux:field>
                    <flux:label>Work email</flux:label>
                    <flux:description>We only use this to send the assessment link.</flux:description>
                    <flux:input type="email" placeholder="you@company.com" wire:model.live="email" />
                </flux:field>
                <flux:field>
                    <flux:label badge="Required">Organisation</flux:label>
                    <flux:input wire:model.live="organisation" />
                    <flux:error name="organisation" />
                </flux:field>
            </div>

            <x-ds.spec>Text inputs</x-ds.spec>
            <div class="mt-5 grid max-w-3xl gap-5 sm:grid-cols-2">
                <flux:input label="Default" placeholder="Placeholder" />
                <flux:input label="With icon" icon="magnifying-glass" placeholder="Search" />
                <flux:input label="Disabled" placeholder="Not editable" disabled />
                <flux:input label="Password" type="password" value="hunter2" viewable />
                <flux:select label="Select">
                    <flux:select.option>Tier 1</flux:select.option>
                    <flux:select.option>Tier 2</flux:select.option>
                    <flux:select.option>Tier 3</flux:select.option>
                </flux:select>
                <flux:input label="Number" type="number" value="12" />
                <div class="sm:col-span-2">
                    <flux:textarea label="Textarea" rows="3"
                        placeholder="Components own their padding. You own the margin." />
                </div>
            </div>

            <x-ds.spec>Checkbox and radio</x-ds.spec>
            <div class="mt-5 grid max-w-3xl gap-8 sm:grid-cols-2">
                <x-ds.sub-box label="Checkbox" :wrap="false">
                    <flux:checkbox.group label="Domains" wire:model.live="domains">
                        <flux:checkbox label="Climate" value="climate" />
                        <flux:checkbox label="Water" value="water" />
                        <flux:checkbox label="Governance" value="governance" />
                        <flux:checkbox label="Locked" value="locked" disabled />
                    </flux:checkbox.group>
                </x-ds.sub-box>

                <x-ds.sub-box label="Radio" :wrap="false">
                    <flux:radio.group label="Frequency" wire:model.live="frequency">
                        <flux:radio value="monthly" label="Monthly" />
                        <flux:radio value="quarterly" label="Quarterly" />
                        <flux:radio value="annual" label="Annual" />
                    </flux:radio.group>
                </x-ds.sub-box>
            </div>

            <x-ds.spec>Radio &mdash; segmented, pills, buttons, cards</x-ds.spec>
            <div class="mt-5 grid max-w-3xl gap-8">
                <flux:radio.group variant="segmented" wire:model.live="quarter">
                    <flux:radio value="q3" label="Q3" />
                    <flux:radio value="q4" label="Q4" />
                    <flux:radio value="q1" label="Q1" />
                </flux:radio.group>

                <flux:radio.group variant="pills" wire:model.live="filter">
                    <flux:radio value="all" label="All" />
                    <flux:radio value="open" label="Open" />
                    <flux:radio value="closed" label="Closed" />
                </flux:radio.group>

                <flux:radio.group variant="cards" class="max-w-2xl" wire:model.live="depth">
                    <flux:radio value="standard" label="Standard" description="One questionnaire per quarter." />
                    <flux:radio value="deep" label="Deep" description="Evidence required on every answer." />
                </flux:radio.group>
            </div>

            <x-ds.spec>Switch, toggle and OTP</x-ds.spec>
            <div class="mt-5 grid max-w-3xl gap-8 sm:grid-cols-2">
                <x-ds.sub-box label="Switch" :wrap="false">
                    <div class="space-y-4">
                        <flux:switch label="Threshold alerts" wire:model.live="alerts" />
                        <flux:switch label="Weekly digest" wire:model.live="digest" />
                        <flux:switch label="Locked" disabled />
                    </div>
                </x-ds.sub-box>
                <x-ds.sub-box label="Toggle" :wrap="false">
                    <div class="space-y-4">
                        <div class="flex flex-wrap gap-2">
                            <flux:toggle label="Bold" icon="bold" value="bold" wire:model.live="format" />
                            <flux:toggle label="Italic" icon="italic" value="italic" wire:model.live="format" />
                            <flux:toggle label="Underline" icon="underline" value="underline" wire:model.live="format" />
                        </div>
                        <flux:toggle variant="subtle" label="Subtle toggle" />
                    </div>
                </x-ds.sub-box>
                <x-ds.sub-box label="OTP" :wrap="false" class="sm:col-span-2">
                    <flux:field>
                        <flux:label>One-time code</flux:label>
                        <flux:otp length="6" />
                    </flux:field>
                </x-ds.sub-box>
            </div>

            <x-ds.spec>Live state</x-ds.spec>
            <p class="mt-3 max-w-2xl text-sm text-ink-muted">
                Every control above is bound with <code class="font-mono">wire:model.live</code>.
                This panel is the server's view of them &mdash; change anything and it updates here.
            </p>
            <div class="mt-5 max-w-3xl rounded-xl border border-line bg-surface-sunken p-6">
                <dl class="grid gap-x-8 gap-y-4 text-sm sm:grid-cols-2">
                    @foreach([
                        'domains'      => count($domains) ? implode(', ', $domains) : '(none)',
                        'frequency'    => $frequency,
                        'quarter'      => $quarter,
                        'filter'       => $filter,
                        'depth'        => $depth,
                        'alerts'       => $alerts ? 'true' : 'false',
                        'digest'       => $digest ? 'true' : 'false',
                        'format'       => count($format) ? implode(', ', $format) : '(none)',
                        'tier'         => $tier,
                        'organisation' => $organisation ?: '(empty)',
                        'email'        => $email ?: '(empty)',
                        'notes'        => $notes ? Str::limit($notes, 28) : '(empty)',
                    ] as $key => $value)
                        <div class="flex items-baseline justify-between gap-4 border-b border-line pb-2">
                            <dt class="font-mono text-xs text-ink-subtle">${{ $key }}</dt>
                            <dd class="text-right font-medium">{{ $value }}</dd>
                        </div>
                    @endforeach
                </dl>
            </div>

            <x-ds.spec>WireUI &mdash; filling the Flux Pro gaps</x-ds.spec>
            <p class="mt-3 max-w-2xl text-sm text-ink-muted">
                Tabs, date pickers and rich selects are Flux Pro. WireUI is MIT licensed and reads
                the same <code class="font-mono">zinc</code> aliases, so it lands on brand without extra work.
            </p>
            <div class="mt-5 grid max-w-3xl gap-5 sm:grid-cols-2">
                <x-datetime-picker label="Assessment window opens" placeholder="Select a date" without-time />
                <x-select label="Owner" placeholder="Select a person"
                    :options="['Sourcing', 'Compliance', 'Sustainability']" />
            </div>

            {{-- ── Data display ── --}}
            <x-ds.group id="data">Data display</x-ds.group>
            <p class="mt-4 max-w-2xl text-sm text-ink-muted">
                <strong class="text-ink">People, records and tables.</strong>
            </p>

            <x-ds.spec>Avatar</x-ds.spec>
            <div class="mt-5 flex flex-wrap items-end gap-5">
                <flux:avatar size="xs" name="Rui Lourenço" />
                <flux:avatar size="sm" name="Rui Lourenço" />
                <flux:avatar name="Rui Lourenço" />
                <flux:avatar size="lg" name="Rui Lourenço" />
                <flux:avatar size="xl" name="Rui Lourenço" />
                <flux:avatar circle name="Circle" />
                <flux:avatar icon="user" />
                <flux:avatar name="Alert" badge badge:color="lime" />
            </div>
            <div class="mt-6">
                <flux:avatar.group>
                    <flux:avatar name="Ana Silva" />
                    <flux:avatar name="Bruno Costa" />
                    <flux:avatar name="Carla Dias" />
                    <flux:avatar>+4</flux:avatar>
                </flux:avatar.group>
            </div>

            <x-ds.spec>Profile and flag</x-ds.spec>
            <div class="mt-5 flex flex-wrap items-center gap-8">
                <x-ds.sub-box label="Profile" row>
                    <flux:profile name="Rui Lourenço" />
                    <flux:profile name="No chevron" :chevron="false" />
                </x-ds.sub-box>
                <x-ds.sub-box label="Flag">
                    <div class="flex items-center gap-3">
                        @foreach(['pt','gb','us','de','br'] as $c)
                            <flux:flag :country="$c" size="md" />
                        @endforeach
                    </div>
                </x-ds.sub-box>
            </div>

            <x-ds.spec>Table</x-ds.spec>
            <div class="mt-5">
                <flux:table>
                    <flux:table.columns>
                        @foreach(['supplier' => 'Supplier', 'tier' => 'Tier', 'score' => 'Score'] as $col => $label)
                            <flux:table.column
                                sortable
                                :sorted="$sortBy === $col"
                                :direction="$sortDirection"
                                wire:click="sort('{{ $col }}')">{{ $label }}</flux:table.column>
                        @endforeach
                        <flux:table.column>Status</flux:table.column>
                    </flux:table.columns>
                    <flux:table.rows>
                        @foreach($this->rows as $row)
                            <flux:table.row :key="$row['supplier']">
                                <flux:table.cell class="whitespace-nowrap font-medium">{{ $row['supplier'] }}</flux:table.cell>
                                <flux:table.cell>Tier {{ $row['tier'] }}</flux:table.cell>
                                <flux:table.cell class="tabular-nums">{{ $row['score'] }}</flux:table.cell>
                                <flux:table.cell>
                                    <flux:badge :color="$row['colour']" size="sm">{{ $row['status'] }}</flux:badge>
                                </flux:table.cell>
                            </flux:table.row>
                        @endforeach
                    </flux:table.rows>
                </flux:table>
                <p class="mt-3 text-xs text-ink-subtle">
                    Sorting by <code class="font-mono">{{ $sortBy }}</code>,
                    {{ $sortDirection === 'asc' ? 'ascending' : 'descending' }}.
                    Click a column heading to re-sort.
                </p>
            </div>

            {{-- ── Navigation and overlays ── --}}
            <x-ds.group id="nav">Navigation and overlays</x-ds.group>

            <x-ds.spec>Breadcrumbs</x-ds.spec>
            <div class="mt-5 space-y-4">
                <flux:breadcrumbs>
                    <flux:breadcrumbs.item href="#nav">Suppliers</flux:breadcrumbs.item>
                    <flux:breadcrumbs.item href="#nav">Tier 1</flux:breadcrumbs.item>
                    <flux:breadcrumbs.item>Northwind Materials</flux:breadcrumbs.item>
                </flux:breadcrumbs>
                <flux:breadcrumbs>
                    <flux:breadcrumbs.item href="#nav" icon="home" />
                    <flux:breadcrumbs.item separator="slash" href="#nav">Reports</flux:breadcrumbs.item>
                    <flux:breadcrumbs.item separator="slash">Q4</flux:breadcrumbs.item>
                </flux:breadcrumbs>
            </div>

            <x-ds.spec>Navlist &mdash; sidebar navigation</x-ds.spec>
            <div class="mt-5 max-w-xs rounded-xl border border-line bg-surface p-3">
                <flux:navlist>
                    @foreach([
                        ['overview', 'home', 'Overview', null],
                        ['suppliers', 'users', 'Suppliers', null],
                        ['assessments', 'document-check', 'Assessments', '12'],
                    ] as [$key, $icon, $label, $badge])
                        <flux:navlist.item
                            :icon="$icon"
                            :badge="$badge"
                            wire:click="$set('navItem', '{{ $key }}')"
                            :current="$navItem === $key"
                            class="cursor-pointer">{{ $label }}</flux:navlist.item>
                    @endforeach
                    <flux:navlist.group heading="Settings" expandable>
                        @foreach(['thresholds' => 'Thresholds', 'team' => 'Team'] as $key => $label)
                            <flux:navlist.item
                                wire:click="$set('navItem', '{{ $key }}')"
                                :current="$navItem === $key"
                                class="cursor-pointer">{{ $label }}</flux:navlist.item>
                        @endforeach
                    </flux:navlist.group>
                </flux:navlist>
            </div>

            <x-ds.spec>Navbar &mdash; horizontal navigation</x-ds.spec>
            <div class="mt-5 rounded-xl border border-line bg-surface px-4">
                <flux:navbar>
                    @foreach(['overview' => 'Overview', 'suppliers' => 'Suppliers', 'alerts' => 'Alerts', 'settings' => 'Settings'] as $key => $label)
                        <flux:navbar.item
                            wire:click="$set('tab', '{{ $key }}')"
                            :current="$tab === $key"
                            :badge="$key === 'alerts' ? '3' : null"
                            class="cursor-pointer">{{ $label }}</flux:navbar.item>
                    @endforeach
                </flux:navbar>
            </div>
            <div class="mt-4 rounded-xl border border-line bg-surface-sunken px-5 py-4">
                <p class="text-sm text-ink-muted">
                    <strong class="text-ink">Getting around.</strong>
                    Selected tab: <strong class="font-semibold text-ink">{{ ucfirst($tab) }}</strong>
                    &mdash; <code class="font-mono">current</code> is server state, so it costs a
                    round trip. Dropdowns, modals and tooltips below need none.
                </p>
            </div>

            <x-ds.spec>Dropdown and menu</x-ds.spec>
            <div class="mt-5 flex flex-wrap items-center gap-3">
                <x-ds.sub-box label="Dropdown">
                    <flux:dropdown>
                        <flux:button icon-trailing="chevron-down" variant="outline" class="btn-outline">Options</flux:button>
                        <flux:menu>
                            <flux:menu.item icon="pencil-square">Edit</flux:menu.item>
                            <flux:menu.item icon="document-duplicate">Duplicate</flux:menu.item>
                            <flux:menu.separator />
                            <flux:menu.submenu heading="Export">
                                <flux:menu.item>As CSV</flux:menu.item>
                                <flux:menu.item>As PDF</flux:menu.item>
                            </flux:menu.submenu>
                            <flux:menu.separator />
                            <flux:menu.item icon="trash" variant="danger">Delete</flux:menu.item>
                        </flux:menu>
                    </flux:dropdown>
                </x-ds.sub-box>

                <x-ds.sub-box label="Menu &mdash; checkbox and radio">
                    <flux:dropdown>
                        <flux:button icon-trailing="chevron-down" variant="ghost" class="btn-ghost">Filter</flux:button>
                        <flux:menu>
                            <flux:menu.heading>Status</flux:menu.heading>
                            <flux:menu.checkbox checked>Assessed</flux:menu.checkbox>
                            <flux:menu.checkbox>Pending</flux:menu.checkbox>
                            <flux:menu.separator />
                            <flux:menu.heading>Tier</flux:menu.heading>
                            <flux:menu.radio.group>
                                <flux:menu.radio checked>All tiers</flux:menu.radio>
                                <flux:menu.radio>Tier 1 only</flux:menu.radio>
                            </flux:menu.radio.group>
                        </flux:menu>
                    </flux:dropdown>
                </x-ds.sub-box>

                <x-ds.sub-box label="Profile menu">
                    <flux:dropdown position="bottom" align="end">
                        <flux:profile name="Rui Lourenço" />
                        <flux:menu>
                            <flux:menu.item icon="user">Account</flux:menu.item>
                            <flux:menu.item icon="cog-6-tooth">Preferences</flux:menu.item>
                            <flux:menu.separator />
                            <flux:menu.item icon="arrow-right-start-on-rectangle">Sign out</flux:menu.item>
                        </flux:menu>
                    </flux:dropdown>
                </x-ds.sub-box>
            </div>

            <x-ds.spec>Modal</x-ds.spec>
            <div class="mt-5 flex flex-wrap items-center gap-3">
                <flux:modal.trigger name="ds-modal">
                    <flux:button variant="filled" class="btn-filled">Open modal</flux:button>
                </flux:modal.trigger>
                <flux:modal name="ds-modal" class="md:w-[28rem]">
                    <div class="space-y-6">
                        <div>
                            <flux:heading size="lg">Confirm assessment</flux:heading>
                            <flux:text class="mt-2">
                                This sends the questionnaire to 42 suppliers. They can save progress and return.
                            </flux:text>
                        </div>
                        <div class="flex justify-end gap-2">
                            {{-- Never the arrow on the one that cancels. --}}
                            <flux:modal.close>
                                <flux:button variant="ghost" class="btn-ghost">Cancel</flux:button>
                            </flux:modal.close>
                            <flux:button variant="primary" class="btn-activate">
                                Send<x-ds.px />
                            </flux:button>
                        </div>
                    </div>
                </flux:modal>

                <flux:modal.trigger name="ds-flyout">
                    <flux:button variant="outline" class="btn-outline">Open flyout</flux:button>
                </flux:modal.trigger>
                <flux:modal name="ds-flyout" variant="flyout" class="space-y-6">
                    <flux:heading size="lg">Flyout</flux:heading>
                    <flux:text>Same component, anchored to the edge instead of centred.</flux:text>
                </flux:modal>
            </div>

            <x-ds.spec>Toast</x-ds.spec>
            <p class="mt-3 max-w-2xl text-sm text-ink-muted">
                Notifications appear once, top level, and stack. These are real &mdash; each
                button dispatches one.
            </p>
            <div class="mt-5 flex flex-wrap items-center gap-3">
                <flux:button wire:click="notify('success')" variant="outline" class="btn-outline">Success toast</flux:button>
                <flux:button wire:click="notify('warning')" variant="outline" class="btn-outline">Warning toast</flux:button>
                <flux:button wire:click="notify('danger')" variant="outline" class="btn-outline">Danger toast</flux:button>
            </div>
        </x-ds.section>

        {{-- ─────────────────────── USAGE RULES ─────────────────────── --}}
        <x-ds.section surface="invert" rhythm="loose" id="rules">
            <x-ds.eyebrow>The rules that matter</x-ds.eyebrow>
            <x-ds.display size="lg" class="mt-5 max-w-3xl">
                Graphite identifies. Coral activates. White space does the rest.
            </x-ds.display>

            <div class="mt-14 grid gap-10 md:grid-cols-3">
                @foreach([
                    ['50%', 'Primary neutrals', 'Off White and Light Beige lead. Calm layouts with a subtle easy feel — white space is a brand element, not leftover room.'],
                    ['35%', 'Graphite identifies', 'Structure, type and chrome. Used sparingly enough to keep the confident tone; it is the backdrop, not the paint.'],
                    ['15%', 'Coral activates', 'Select moments only, for contrast and a pop of life. Graphite on it is 4.24:1, so large or bold labels only — never body copy, and never white (2.94:1).'],
                ] as [$pct, $title, $body])
                    <div>
                        <p class="text-display-lg text-coral tabular-nums">{{ $pct }}</p>
                        <hr class="rule-activate my-5">
                        <h3 class="font-semibold">{{ $title }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-mid-blue">{{ $body }}</p>
                    </div>
                @endforeach
            </div>
        </x-ds.section>

        <x-ds.footer :groups="[
            'System'   => ['#colour' => 'Colour', '#type' => 'Typography', '#scales' => 'Scales', '#components' => 'Components'],
            'Built on' => ['https://fluxui.dev' => 'Flux UI', 'https://wireui.dev' => 'WireUI', 'https://tailwindcss.com' => 'Tailwind v4'],
        ]" />
</div>
