# C-MORE Design System

Brand Manual 2025-03 V2, expressed as code.
Laravel 13 · Livewire 3 · Tailwind CSS v4 · Flux UI (free tier) · WireUI.

Live reference: **`/design-system`** — every swatch, size and component on that
page renders from the same stylesheet the product uses. If it looks right there,
it is right.

---

## The one rule

From the manual (p.18), the proportions a C-MORE layout should hold:

| Share | Role | What it is |
|------:|------|------------|
| **50%** | Primary neutrals | Off White and Light Beige. White space is a brand element, not leftover room. |
| **35%** | Deep Blue **identifies** | Structure, type, chrome. The backdrop, not the paint. |
| **15%** | Lime **activates** | Select moments only. One per viewport. |

Everything below exists to make that easy to follow and awkward to break.

---

## Architecture

Three layers, in `resources/css/app.css`. Each one only ever reads from the one above.

```
1  PRIMITIVES   --color-deep-blue, --color-lime, …   verbatim from p.17, never edited
2  SEMANTICS    --color-accent, --color-ground, …    what a colour MEANS
3  SCALES       radius, type, shadow, motion
```

**Components reference semantics, never primitives.** That single discipline is
why dark mode works without touching a single component file.

### The zinc alias

Flux and WireUI both style themselves with Tailwind's `zinc`, which is a cold
grey. C-MORE's ground is warm. So we publish an 11-step warm ramp called `sand`
and alias `zinc` onto it:

```css
--color-zinc-100: var(--color-sand-100);   /* … through 950 */
```

Eleven lines, and every stock component in both libraries re-skins itself. Steps
50–300 are the manual's four neutrals untouched; 800–950 cool toward Deep Blue so
darks read as brand rather than generic charcoal. **`sand-950` is Deep Blue.**

---

## Colour

### Primitives (p.17 — always 100% solid; tints need Marketing sign-off)

| Name | Hex | Pantone | Note |
|------|-----|---------|------|
| Deep Blue | `#141A32` | 289C | Identifies |
| Lime | `#C0FA00` | 381 | Activates |
| Blue | `#4E638B` | 7682C | 5.3:1 on ground — the muted text colour |
| Mid Blue | `#909DB6` | 535C | 2.4:1 — **borders only, never text** |
| Green | `#B4EB00` | — | Lime's hover state |
| Light Lime | `#F1FBD0` | — | Quiet activation |
| Off White | `#FAFAFA` | — | |
| Light Beige | `#F2F1ED` | — | The page ground |
| Mid Beige | `#E9E7E2` | — | Sunken wells |
| Dark Beige | `#E0DED7` | — | Hairlines |

### Semantics

| Token | Light | Dark | Use |
|-------|-------|------|-----|
| `--color-accent` | Deep Blue | Lime | Primary buttons, links, focus. **Flux reads this directly.** |
| `--color-activation` | Lime | Lime | The 15%. Foreground is *always* Deep Blue. |
| `--color-ground` | Light Beige | Deep Blue | The page |
| `--color-surface` | White | `#1B2039` | Cards on the ground |
| `--color-surface-sunken` | Mid Beige | `#0E1327` | Wells, inset panels |
| `--color-ink` | Deep Blue | Off White | Headings, primary copy |
| `--color-ink-muted` | Blue | Mid Blue | Secondary copy — 5.3:1, AA |
| `--color-ink-subtle` | Sand 600 | `#7D88A3` | Meta, captions — 4.9:1, AA |
| `--color-line` | Dark Beige | Mid Blue 24% | Hairlines |

### Contrast, measured

| Pair | Ratio | Verdict |
|------|-------|---------|
| Deep Blue on Light Beige | 13.8:1 | Anything |
| Lime on Deep Blue | 13.8:1 | Anything — the signature pairing |
| White on Deep Blue | 17.2:1 | Anything |
| Blue on Light Beige | 5.3:1 | AA body text |
| Sand 600 on Off White | 4.9:1 | AA body text — the lightest that passes |
| Mid Blue on Light Beige | 2.4:1 | **Decoration only** |
| **White on Lime** | **1.2:1** | **Never. Illegible.** |

Dark mode is not an inversion. Deep Blue is the backdrop "for much of the brand",
so dark is the brand at rest — and there Lime becomes the accent, because lime on
deep blue *is* the pairing.

---

## Typography

**Figtree** (p.19), self-hosted through the Vite fonts plugin. Arial substitutes
where Figtree is unavailable.

Weight pairing, per the manual:

| Weight | Use |
|--------|-----|
| Light 300 | Body copy where sophistication is wanted |
| Regular 400 | Most body copy |
| Medium 500 | Most titles, paired with Light |
| Semibold 600 | Titles and headlines, paired with Regular |
| Bold 700 | Exceptional titles and highlights only |

The scale bakes in size, line-height, tracking **and weight**, so nothing
downstream should set weight or tracking by hand:

`display-2xl` `display-xl` `display-lg` `display-md` `display-sm` `lead` `eyebrow`

---

## Shape, elevation, motion

- **Radius** — controls go fully pill; containers stay generous
  (`card` = 20px). The manual's principle plates (p.12) are markedly rounder
  than Flux ships, which is the main geometric change we make.
- **Elevation** — the brand is flat. **Hairline first, shadow second.**
  `hairline` → `raised` → `floating` → `overlay`. Shadows are tinted with Deep
  Blue rather than black so they never grey the warm ground.
- **Motion** — "Alive: designed with a pulse." `--ease-brand` with
  quick/base/slow durations. Fully disabled under `prefers-reduced-motion`.
- **Icons** — 32px artboard, 2pt stroke, 45° where possible (p.21) = stroke 1.5
  at 24px. Use `.icon-brand`. Icons inform; they are never decorative.

---

## Cascade: why the Flux overrides are unlayered

This is the one non-obvious thing in the stylesheet, and it will bite anyone who
moves it.

Flux styles itself with Tailwind utilities (`bg-white`, `rounded-xl`). Those land
in Tailwind's `utilities` layer. **Layer order beats selector specificity** — so
a rule in `@layer components` loses to a utility no matter how specific it is.
`.btn-activate[data-flux-button]` in the components layer silently did nothing.

Unlayered CSS outranks every layer. So:

- **Our own classes** (`.tile`, `.section`, `.icon-plate`) stay in
  `@layer components` — you *want* a one-off `p-8` in markup to win.
- **Flux overrides** (`[data-flux-*]`, `.btn-activate`, `.btn-lg`) sit
  **outside any layer**.

We change geometry and the activation colour only, through the `data-flux-*`
hooks Flux documents as its styling contract. This is a theme layer, not a fork.

---

## Components

`resources/views/components/ds/` — consumed as `<x-ds.*>`:

| Component | Purpose |
|-----------|---------|
| `section` | Page section. `surface=ground\|surface\|sunken\|invert`, `rhythm=tight\|base\|loose` |
| `display` | Display heading. `size=sm…2xl`, `as=h1…` |
| `lead` | Lead paragraph (Figtree Light) |
| `eyebrow` | Uppercase label with lime tick |
| `tile` | Feature card. `interactive` adds hover lift |
| `icon-plate` | Icon in a tile. `activate` for the Light Lime fill |
| `stat` | Number + label |
| `brand` | Wordmark, inherits `currentColor` |
| `navbar` `footer` `cta` | Page furniture |
| `swatch` | Colour chip (gallery) |

### Extensions we added to Flux

- **`.btn-activate`** — the lime button. Flux has no lime variant and should not;
  activation is a C-MORE concept. **At most one per viewport.**
- **`.btn-lg`** — Flux sizes buttons `xs`/`sm`/`base` and stops, which is right
  for an app and too small for a landing hero.

---

## Interactivity

The page is a Livewire component (`App\Livewire\DesignSystem`), because a design
system that cannot be clicked is a screenshot.

**Most Flux components need no server at all.** Dropdowns, modals, flyouts,
tooltips, radios, checkboxes, switches and toggles are custom elements
(`<ui-radio>`, `<ui-switch>`, …) driven by `flux.js`. They work on a static page.
Note the implication for testing: Flux 2 renders **custom elements, not native
inputs** — `document.querySelectorAll('input[type=radio]')` returns nothing.

**Four things genuinely need a round trip**, and are wired in the component:

| Component | Why | Wiring |
|-----------|-----|--------|
| Navbar / Navlist | `current` is rendered server-side | `wire:click` → `$tab` / `$navItem` |
| Table | Sorting reorders the dataset | `wire:click="sort(...)"` → `$sortBy`, `$sortDirection` |
| Toast | Dispatched from the server | `wire:click="notify(...)"` → `Flux::toast()` |
| Progress | Value is state | `wire:click="nudgeProgress(...)"` |

Every form control is bound with `wire:model.live`, and the **Live state** panel
in section 05 prints the server's view of them — proof the binding is real rather
than a styled placeholder.

### Two gotchas worth knowing

- **`value` on a radio group only resolves through a binding.** On a static page
  the checked state has to go on the individual `<flux:radio checked>`.
- **Buttons have no static loading state.** Flux grows a spinner on its own for
  the duration of a Livewire request, so it only shows against a real action.

---

## Licensing

- **Flux free tier** covers everything used here: Button, Input, Select,
  Textarea, Checkbox, Switch, Card, Badge, Heading, Text, Icon.
- **Flux Pro** ($149 single project / $299 single dev / $799 team) would be
  needed for Tabs, Accordion, Charts, Date picker, Command, Kanban and ~10 more.
- **WireUI** is MIT licensed and fills those gaps. It reads the same `zinc`
  aliases, so it lands on brand with no extra work.

### Two known packaging issues

1. **`@wireUiStyles` is not used.** WireUI 2.6 ships no `dist/wireui.css`, and
   the directive 500s on the missing file. Its styles come from Tailwind
   scanning the package instead — see the `@source` lines in `app.css`.
2. **Livewire is pinned to `^3.7`, not 4.** WireUI 2.6's Alpine components do not
   register under Livewire 4 (`wireui_date_picker is not defined`). Livewire 3 is
   the version both Flux 2 and WireUI 2 support. Revisit when WireUI ships
   Livewire 4 support.

---

## Running it

> **After editing any Blade file, rebuild the CSS.** Tailwind v4 only generates
> the utility classes it saw at build time, so a class you just typed will
> silently resolve to nothing (`column-gap: normal`) until `npm run build` runs
> again. Use `npm run dev` while working to avoid this entirely.


```bash
cd landing
composer install && npm install
npm run build          # or: npm run dev
php artisan serve
```

`/` — landing page · `/design-system` — the living reference.
