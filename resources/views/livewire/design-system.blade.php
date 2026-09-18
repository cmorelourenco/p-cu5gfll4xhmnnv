{{-- Living design system. State lives in App\Livewire\DesignSystem. --}}
<div>
        <x-ds.navbar :links="[
            '#colour' => 'Colour', '#type' => 'Type', '#components' => 'Actions',
            '#content' => 'Content', '#forms' => 'Forms', '#data' => 'Data',
            '#nav' => 'Nav', '#rules' => 'Rules',
        ]" />

        <x-ds.section rhythm="loose">
            <x-ds.eyebrow>Design system</x-ds.eyebrow>
            <x-ds.display as="h1" size="xl" class="mt-6 max-w-3xl">
                The C-MORE system, <span class="mark-activate">assembled</span>.
            </x-ds.display>
            <x-ds.lead class="mt-7">
                Brand Manual 2025-03 V2, expressed as Tailwind v4 tokens over Flux UI and
                WireUI. Everything below is live &mdash; it renders from
                <code class="font-mono text-base">resources/css/app.css</code>, not from a
                screenshot. This page is a placeholder standing in for the landing page
                until the product brief lands.
            </x-ds.lead>
        </x-ds.section>

        {{-- ─────────────────────────── COLOUR ─────────────────────────── --}}
        <x-ds.section surface="surface" id="colour">
            <x-ds.eyebrow>01 &middot; Colour</x-ds.eyebrow>
            <x-ds.display size="md" class="mt-5">Primitives</x-ds.display>
            <p class="mt-4 max-w-2xl text-sm text-ink-muted">
                Verbatim from p.17. Always 100% solid &mdash; tints need C-MORE Marketing sign-off.
            </p>

            <h3 class="mt-12 text-sm font-semibold uppercase tracking-[0.1em] text-ink-subtle">The iconic pair</h3>
            <div class="mt-5 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                <x-ds.swatch name="Deep Blue" hex="#141A32" pms="PMS 289C" note="Identifies. 35% of a layout." />
                <x-ds.swatch name="Lime"      hex="#C0FA00" pms="PMS 381"  note="Activates. 15%, and never behind white text." />
            </div>

            <h3 class="mt-14 text-sm font-semibold uppercase tracking-[0.1em] text-ink-subtle">Supporting</h3>
            <div class="mt-5 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                <x-ds.swatch name="Blue"       hex="#4E638B" pms="PMS 7682C" note="5.3:1 on ground — the muted text colour." />
                <x-ds.swatch name="Mid Blue"   hex="#909DB6" pms="PMS 535C"  note="2.4:1 — borders and decoration only, never body text." />
                <x-ds.swatch name="Green"      hex="#B4EB00" note="Lime's hover state." />
                <x-ds.swatch name="Light Lime" hex="#F1FBD0" note="Activation, quietly — icon plates and subtle fills." />
            </div>

            <h3 class="mt-14 text-sm font-semibold uppercase tracking-[0.1em] text-ink-subtle">Primary neutrals &mdash; 50% of a layout</h3>
            <div class="mt-5 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                <x-ds.swatch name="Off White"   hex="#FAFAFA" ring />
                <x-ds.swatch name="Light Beige" hex="#F2F1ED" ring note="The page ground." />
                <x-ds.swatch name="Mid Beige"   hex="#E9E7E2" ring note="Sunken wells." />
                <x-ds.swatch name="Dark Beige"  hex="#E0DED7" ring note="Hairlines." />
            </div>

            <hr class="rule-activate my-16">

            <x-ds.display size="md">Sand &mdash; the neutral ramp</x-ds.display>
            <p class="mt-4 max-w-2xl text-sm text-ink-muted">
                Flux and WireUI both reach for Tailwind's <code class="font-mono">zinc</code>, which is a
                cold grey. We alias <code class="font-mono">zinc</code> onto this warm ramp, and every
                stock component re-skins itself. 50&ndash;300 are the manual's neutrals untouched;
                950 is Deep Blue.
            </p>
            <div class="mt-8 flex overflow-hidden rounded-xl ring-1 ring-inset ring-line">
                @foreach(['50'=>'#FAFAFA','100'=>'#F2F1ED','200'=>'#E9E7E2','300'=>'#E0DED7','400'=>'#C3C0B8','500'=>'#96958E','600'=>'#6E6E6A','700'=>'#4F5057','800'=>'#343744','900'=>'#21253A','950'=>'#141A32'] as $step => $hex)
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
                            ['--color-accent', 'Deep Blue', 'Lime', 'Primary buttons, links, focus rings. Flux reads this directly.'],
                            ['--color-activation', 'Lime', 'Lime', 'The 15%. One moment per viewport, foreground always Deep Blue.'],
                            ['--color-ground', 'Light Beige', 'Deep Blue', 'The page itself.'],
                            ['--color-surface', 'White', '#1B2039', 'Cards sitting on the ground.'],
                            ['--color-surface-sunken', 'Mid Beige', '#0E1327', 'Wells and inset panels.'],
                            ['--color-ink', 'Deep Blue', 'Off White', 'Headings and primary copy.'],
                            ['--color-ink-muted', 'Blue', 'Mid Blue', 'Secondary copy. 5.3:1 — AA.'],
                            ['--color-ink-subtle', 'Sand 600', '#7D88A3', 'Meta and captions. 4.9:1 — AA.'],
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
        </x-ds.section>

        {{-- ─────────────────────────── TYPE ─────────────────────────── --}}
        <x-ds.section id="type">
            <x-ds.eyebrow>02 &middot; Typography</x-ds.eyebrow>
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

        {{-- ─────────────────────── 03 ACTIONS ─────────────────────── --}}
        <x-ds.section surface="surface" id="components">
            <x-ds.eyebrow>03 &middot; Actions</x-ds.eyebrow>
            <x-ds.display size="md" class="mt-5">Flux, reshaped</x-ds.display>
            <p class="mt-4 max-w-2xl text-sm text-ink-muted">
                Stock Flux components. We changed no markup &mdash; only tokens and the
                <code class="font-mono">data-flux-*</code> geometry hooks Flux documents as its
                styling contract. Controls go fully pill; containers stay generous.
            </p>

            <x-ds.spec>Buttons &mdash; variants</x-ds.spec>
            <div class="mt-5 flex flex-wrap items-center gap-3">
                <flux:button class="btn-activate">Activate</flux:button>
                <flux:button variant="primary">Primary</flux:button>
                <flux:button variant="filled">Filled</flux:button>
                <flux:button variant="outline">Outline</flux:button>
                <flux:button variant="subtle">Subtle</flux:button>
                <flux:button variant="ghost">Ghost</flux:button>
                <flux:button variant="danger">Danger</flux:button>
            </div>
            <p class="mt-4 max-w-2xl text-xs text-ink-subtle">
                <strong class="text-ink">Rule:</strong> at most one <code class="font-mono">.btn-activate</code>
                per viewport. It is the 15%, not a default.
            </p>

            <x-ds.spec>Buttons &mdash; sizes, icons and states</x-ds.spec>
            <div class="mt-5 flex flex-wrap items-center gap-3">
                <flux:button size="xs">Extra small</flux:button>
                <flux:button size="sm">Small</flux:button>
                <flux:button>Base</flux:button>
                <flux:button class="btn-lg">Large &mdash; ours</flux:button>
            </div>
            <div class="mt-4 flex flex-wrap items-center gap-3">
                <flux:button icon="arrow-down-tray">Leading icon</flux:button>
                <flux:button icon-trailing="arrow-right" variant="primary">Trailing icon</flux:button>
                <flux:button icon="cog-6-tooth" square aria-label="Settings" />
                <flux:button icon="trash" variant="danger" square aria-label="Delete" />
                <flux:button variant="primary" disabled>Disabled</flux:button>
            </div>
            <p class="mt-4 max-w-2xl text-xs text-ink-subtle">
                There is no static loading state to show: Flux buttons grow a spinner on their own
                for the duration of a Livewire request, so it only appears against a real action.
            </p>

            <x-ds.spec>Badges</x-ds.spec>
            <div class="mt-5 flex flex-wrap items-center gap-3">
                <flux:badge size="sm">Small</flux:badge>
                <flux:badge>Base</flux:badge>
                <flux:badge size="lg">Large</flux:badge>
                <flux:badge variant="solid" color="zinc">Solid</flux:badge>
                <flux:badge icon="check-circle" color="lime">With icon</flux:badge>
            </div>
            <div class="mt-4 flex flex-wrap items-center gap-3">
                <flux:badge color="lime">Assessed</flux:badge>
                <flux:badge color="amber">Pending</flux:badge>
                <flux:badge color="red">Overdue</flux:badge>
                <flux:badge color="blue">Informative</flux:badge>
                <flux:badge color="zinc">Neutral</flux:badge>
            </div>
            <div class="mt-5 max-w-2xl rounded-xl border border-line bg-surface-sunken p-5">
                <p class="text-sm font-semibold">Watch out: <code class="font-mono">color=</code> is Tailwind's palette, not ours</p>
                <p class="mt-2 text-sm leading-relaxed text-ink-muted">
                    Flux resolves <code class="font-mono">color="lime"</code> to Tailwind's
                    <code class="font-mono">lime-500</code>
                    (<span class="inline-block size-3 translate-y-px rounded-[3px]" style="background:#84cc16"></span>
                    <code class="font-mono">#84CC16</code>) &mdash; a duller, greener lime than
                    C-MORE Lime
                    (<span class="inline-block size-3 translate-y-px rounded-[3px]" style="background:#C0FA00"></span>
                    <code class="font-mono">#C0FA00</code>). The two are close enough to pass unnoticed
                    and far enough apart to be wrong.
                </p>
                <p class="mt-2 text-sm leading-relaxed text-ink-muted">
                    Brand lime only ever comes from the activation tokens &mdash;
                    <code class="font-mono">.btn-activate</code>, <code class="font-mono">.icon-plate-activate</code>,
                    <code class="font-mono">.mark-activate</code>, or the <code class="font-mono">bg-lime</code>
                    utility. Treat Flux's colour names as a status palette, not a brand one.
                </p>
            </div>

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
                    <flux:button variant="outline">Hover me</flux:button>
                </flux:tooltip>
                <flux:tooltip position="right" content="Positioned right">
                    <flux:button variant="outline" icon="question-mark-circle" square aria-label="Help" />
                </flux:tooltip>
                <flux:tooltip content="With a keyboard hint" kbd="⌘K">
                    <flux:button variant="subtle">Command</flux:button>
                </flux:tooltip>
            </div>

            <x-ds.spec>Progress and skeleton</x-ds.spec>
            <div class="mt-5 grid max-w-2xl gap-6">
                <div class="space-y-3">
                    <flux:progress :value="$progress" />
                    <div class="flex flex-wrap items-center gap-3">
                        <flux:button size="sm" variant="outline" icon="minus" wire:click="nudgeProgress(-10)" aria-label="Decrease" />
                        <flux:button size="sm" variant="outline" icon="plus" wire:click="nudgeProgress(10)" aria-label="Increase" />
                        <span class="font-mono text-xs tabular-nums text-ink-subtle">{{ $progress }}%</span>
                    </div>
                </div>
                <div class="space-y-2 rounded-xl border border-line bg-surface p-5">
                    <flux:skeleton class="h-4 w-2/5" />
                    <flux:skeleton class="h-3 w-full" />
                    <flux:skeleton class="h-3 w-4/5" />
                </div>
            </div>
        </x-ds.section>

        {{-- ─────────────────────── 04 CONTENT ─────────────────────── --}}
        <x-ds.section id="content">
            <x-ds.eyebrow>04 &middot; Content</x-ds.eyebrow>
            <x-ds.display size="md" class="mt-5">Text, surfaces and separators</x-ds.display>

            <x-ds.spec>Heading, subheading, text, link</x-ds.spec>
            <div class="mt-5 max-w-2xl space-y-4 rounded-xl border border-line bg-surface p-7">
                <flux:heading size="xl">Heading, xl</flux:heading>
                <flux:subheading size="lg">Subheading, lg &mdash; the line under a title</flux:subheading>
                <flux:separator variant="subtle" />
                <flux:text>
                    Body text at the default size. Flux <flux:text inline variant="strong">emphasises strongly</flux:text>,
                    fades to <flux:text inline variant="subtle">subtle</flux:text>, and links go to
                    <flux:link href="#content">the accent colour</flux:link> &mdash; Deep Blue in light,
                    Lime in dark.
                </flux:text>
                <flux:text size="sm" variant="subtle">Small subtle text, for captions and meta.</flux:text>
            </div>

            <x-ds.spec>Separator</x-ds.spec>
            <div class="mt-5 max-w-2xl space-y-8">
                <flux:separator />
                <flux:separator variant="subtle" />
                <flux:separator text="or" />
                <hr class="rule-activate">
                <p class="text-xs text-ink-subtle">
                    The last one is ours &mdash; <code class="font-mono">.rule-activate</code>, a hairline
                    that carries the lime for its first 4rem.
                </p>
            </div>

            <x-ds.spec>Card &mdash; Flux, on brand tokens</x-ds.spec>
            <div class="mt-5 grid gap-5 md:grid-cols-2">
                <flux:card class="space-y-4">
                    <flux:heading size="lg">Outline</flux:heading>
                    <flux:text>The default. A border, some padding, and the warm ground showing through.</flux:text>
                    <flux:button variant="outline" size="sm">Action</flux:button>
                </flux:card>
                <flux:card variant="soft" class="space-y-4">
                    <flux:heading size="lg">Soft</flux:heading>
                    <flux:text>Lower emphasis. Adapts to whatever surface it is placed on.</flux:text>
                    <flux:button variant="ghost" size="sm">Action</flux:button>
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
                    <p class="mt-2 text-sm text-ink-muted">Light Lime fill. Use for the one thing that matters most.</p>
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
        </x-ds.section>

        {{-- ─────────────────────── 05 FORMS ─────────────────────── --}}
        <x-ds.section surface="surface" id="forms">
            <x-ds.eyebrow>05 &middot; Forms</x-ds.eyebrow>
            <x-ds.display size="md" class="mt-5">Every input, on brand</x-ds.display>

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
                <flux:checkbox.group label="Domains" wire:model.live="domains">
                    <flux:checkbox label="Climate" value="climate" />
                    <flux:checkbox label="Water" value="water" />
                    <flux:checkbox label="Governance" value="governance" />
                    <flux:checkbox label="Locked" value="locked" disabled />
                </flux:checkbox.group>

                <flux:radio.group label="Frequency" wire:model.live="frequency">
                    <flux:radio value="monthly" label="Monthly" />
                    <flux:radio value="quarterly" label="Quarterly" />
                    <flux:radio value="annual" label="Annual" />
                </flux:radio.group>
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
                <div class="space-y-4">
                    <flux:switch label="Threshold alerts" wire:model.live="alerts" />
                    <flux:switch label="Weekly digest" wire:model.live="digest" />
                    <flux:switch label="Locked" disabled />
                </div>
                <div class="space-y-4">
                    <div class="flex flex-wrap gap-2">
                        <flux:toggle label="Bold" icon="bold" value="bold" wire:model.live="format" />
                        <flux:toggle label="Italic" icon="italic" value="italic" wire:model.live="format" />
                        <flux:toggle label="Underline" icon="underline" value="underline" wire:model.live="format" />
                    </div>
                    <flux:toggle variant="subtle" label="Subtle toggle" />
                </div>
                <div class="sm:col-span-2">
                    <flux:field>
                        <flux:label>One-time code</flux:label>
                        <flux:otp length="6" />
                    </flux:field>
                </div>
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
        </x-ds.section>

        {{-- ─────────────────────── 06 DATA DISPLAY ─────────────────────── --}}
        <x-ds.section id="data">
            <x-ds.eyebrow>06 &middot; Data display</x-ds.eyebrow>
            <x-ds.display size="md" class="mt-5">People, records and tables</x-ds.display>

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
                <flux:profile name="Rui Lourenço" />
                <flux:profile name="No chevron" :chevron="false" />
                <div class="flex items-center gap-3">
                    @foreach(['pt','gb','us','de','br'] as $c)
                        <flux:flag :country="$c" size="md" />
                    @endforeach
                </div>
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
        </x-ds.section>

        {{-- ─────────────────────── 07 NAVIGATION & OVERLAYS ─────────────────────── --}}
        <x-ds.section surface="surface" id="nav">
            <x-ds.eyebrow>07 &middot; Navigation and overlays</x-ds.eyebrow>
            <x-ds.display size="md" class="mt-5">Getting around</x-ds.display>

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
                    Selected tab: <strong class="font-semibold text-ink">{{ ucfirst($tab) }}</strong>
                    &mdash; <code class="font-mono">current</code> is server state, so it costs a
                    round trip. Dropdowns, modals and tooltips below need none.
                </p>
            </div>

            <x-ds.spec>Dropdown and menu</x-ds.spec>
            <div class="mt-5 flex flex-wrap items-center gap-3">
                <flux:dropdown>
                    <flux:button icon-trailing="chevron-down" variant="outline">Options</flux:button>
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

                <flux:dropdown>
                    <flux:button icon-trailing="chevron-down" variant="ghost">Filter</flux:button>
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

                <flux:dropdown position="bottom" align="end">
                    <flux:profile name="Rui Lourenço" />
                    <flux:menu>
                        <flux:menu.item icon="user">Account</flux:menu.item>
                        <flux:menu.item icon="cog-6-tooth">Preferences</flux:menu.item>
                        <flux:menu.separator />
                        <flux:menu.item icon="arrow-right-start-on-rectangle">Sign out</flux:menu.item>
                    </flux:menu>
                </flux:dropdown>
            </div>

            <x-ds.spec>Modal</x-ds.spec>
            <div class="mt-5 flex flex-wrap items-center gap-3">
                <flux:modal.trigger name="ds-modal">
                    <flux:button variant="primary">Open modal</flux:button>
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
                            <flux:modal.close>
                                <flux:button variant="ghost">Cancel</flux:button>
                            </flux:modal.close>
                            <flux:button class="btn-activate">Send</flux:button>
                        </div>
                    </div>
                </flux:modal>

                <flux:modal.trigger name="ds-flyout">
                    <flux:button variant="outline">Open flyout</flux:button>
                </flux:modal.trigger>
                <flux:modal name="ds-flyout" variant="flyout" class="space-y-6">
                    <flux:heading size="lg">Flyout</flux:heading>
                    <flux:text>Same component, anchored to the edge instead of centred.</flux:text>
                </flux:modal>
            </div>

            <x-ds.spec>Toast</x-ds.spec>
            <p class="mt-3 max-w-2xl text-sm text-ink-muted">
                <code class="font-mono">&lt;flux:toast /&gt;</code> sits once in the layout and renders
                notifications dispatched from the server. These are real &mdash; each button calls
                a method on the Livewire component.
            </p>
            <div class="mt-5 flex flex-wrap items-center gap-3">
                <flux:button wire:click="notify('success')" variant="outline">Success toast</flux:button>
                <flux:button wire:click="notify('warning')" variant="outline">Warning toast</flux:button>
                <flux:button wire:click="notify('danger')" variant="outline">Danger toast</flux:button>
            </div>
        </x-ds.section>

        {{-- ─────────────────────── 08 SCALES ─────────────────────── --}}
        <x-ds.section id="scales">
            <x-ds.eyebrow>08 &middot; Scales</x-ds.eyebrow>
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
            <p class="mt-4 max-w-2xl text-xs text-ink-subtle">
                Shadows are tinted with Deep Blue rather than black, so they never grey the warm ground.
            </p>

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

        {{-- ─────────────────────── USAGE RULES ─────────────────────── --}}
        <x-ds.section surface="invert" rhythm="loose" id="rules">
            <x-ds.eyebrow>04 &middot; The rules that matter</x-ds.eyebrow>
            <x-ds.display size="lg" class="mt-5 max-w-3xl">
                Deep Blue identifies. Lime activates. White space does the rest.
            </x-ds.display>

            <div class="mt-14 grid gap-10 md:grid-cols-3">
                @foreach([
                    ['50%', 'Primary neutrals', 'Off White and Light Beige lead. Calm layouts with a subtle easy feel — white space is a brand element, not leftover room.'],
                    ['35%', 'Deep Blue identifies', 'Structure, type and chrome. Used sparingly enough to keep the confident tone; it is the backdrop, not the paint.'],
                    ['15%', 'Lime activates', 'Select moments only, for contrast and a pop of life. Never behind white text — 1.2:1 is illegible. Foreground is always Deep Blue.'],
                ] as [$pct, $title, $body])
                    <div>
                        <p class="text-display-lg text-lime tabular-nums">{{ $pct }}</p>
                        <hr class="rule-activate my-5">
                        <h3 class="font-semibold">{{ $title }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-mid-blue">{{ $body }}</p>
                    </div>
                @endforeach
            </div>
        </x-ds.section>

        <x-ds.footer :groups="[
            'System'   => ['#colour' => 'Colour', '#type' => 'Typography', '#components' => 'Actions', '#forms' => 'Forms'],
            'Built on' => ['https://fluxui.dev' => 'Flux UI', 'https://wireui.dev' => 'WireUI', 'https://tailwindcss.com' => 'Tailwind v4'],
        ]" />
</div>
