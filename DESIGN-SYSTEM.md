# C-MORE Design System 2.0

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

### Five stylesheets, in this order

`app.css` is the Tailwind entry and carries the theme. The four after it are
plain, unlayered CSS on those tokens — which is what makes them win (see
*Cascade*, below) and what makes them free of the build: a changed token value
applies immediately, and only a *new utility class* needs `npm run build`.

| | |
|---|---|
| `app.css` | The Tailwind entry. Theme, the `zinc`→`sand` alias, our components, the Flux geometry overrides. |
| `turn.css` | Turn — the unit progress bar. Reads `--p` (0–100). |
| `convergence.css` | Convergence — the spinner. |
| `enhanced.css` | The brand layer that grew on the static copy: the secondary colour, the sub-section boxes, the rail, the tabs, the button and badge variants. The big one. |
| `arrow.css` | The pixel arrow. Four geometries, three sizes, seven motions. **Last, because it binds to `.btn-activate`, which `app.css` defines.** |

The order is written down twice — in `vite.config.js` and in the `@vite` call in
`resources/views/components/layouts/site.blade.php`. Both must agree, and both
say why.

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

### Secondary — Electric Blue

**Proposed, not approved.** It sits behind the *Alternatives* tab on the colour
section for exactly that reason; nothing in the shipped page spends it.

| Token | Light | Dark |
|---|---|---|
| `--color-secondary` | `#3B57AB` Electric Blue | `#789AF4` Electric Lift |
| `--color-secondary-hover` | `#2D4694` Electric Deep | `#9BB6F7` |
| `--color-secondary-foreground` | White | Deep Blue |
| `--color-secondary-subtle` | `#E8F0FF` | `#1E2B51` |

Every blue already in the system sits at OKLCH hue 262–274° but at chroma
0.04–0.07, which is why they read as grey. This holds the family hue (267°,
between Blue's 263° and Deep Blue's 271°) at roughly double that chroma, 0.138.

It is deliberately **not** at the sRGB edge. An earlier pass ran the base at
chroma 0.261 (`#2540F2`) and it was genuinely electric. The base is now the
dark-mode lift `#789AF4` taken down to L 0.48 — same hue, same chroma, darker.
Light and dark are therefore one colour at two lightnesses rather than two
separate decisions. Measured: 5.92 on the ground, 6.69 white on it, **5.39 for
Lime on it**, 6.32 both ways in dark. All AA or better.

`#3B57AB` carries **PMS TBC** — a coated match should be straightforward at this
chroma, but it has not been checked against a physical guide.

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

### Appearance

**The page always opens light.** Flux's own default is `system`, which turns the
page navy on a dark-mode machine — the wrong first impression for a brand whose
layouts are 50% warm neutral. The layout overrides that default; a visitor's own
choice, made with the toggle in the header, is remembered and wins on return.

Dark mode itself is not an inversion. Deep Blue is the backdrop "for much of the
brand", so dark is the brand at rest — and there Lime becomes the accent, because
lime on deep blue *is* the pairing.

Building the toggle turns up a trap: `@fluxAppearance` defines a small
`window.Flux` shim with `applyAppearance()`, and then `flux.js` **replaces that
object entirely**. By the time anyone clicks, `applyAppearance` is gone. The real
object exposes a `dark` boolean setter (and an `appearance` string), which also
persists the choice — so the toggle is `window.Flux.dark = !window.Flux.dark`.

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
- **The four brand stylesheets** — `turn`, `convergence`, `enhanced`, `arrow` —
  are entirely unlayered for the same reason. `.btn-filled[data-flux-button]`
  has to beat `bg-zinc-800/5`, and no amount of specificity would do it from
  inside a layer.

Between unlayered rules the ordinary rules apply: later wins. That is why
`arrow.css` is loaded last and why the order is written down in both
`vite.config.js` and the layout.

We change geometry and the activation colour only, through the `data-flux-*`
hooks Flux documents as its styling contract. This is a theme layer, not a fork.

---

## Page structure

Three levels, mirroring Flux's own split (it has Guides / Layouts / Components
with a flat A–Z list; the Actions / Content / Forms grouping is ours and sits as
a middle level).

```
Colour                     ← foundation
Typography                 ← foundation
Scales                     ← foundation
Components
  Actions                  → Buttons, Badges, Callout, Tooltip, Progress
  Content                  → Text, Separator, Card, Tile, Icons
  Forms                    → Field, Inputs, Checkbox, Radio, Switch…
  Data display             → Avatar, Profile, Table
  Navigation and overlays  → Breadcrumbs, Navlist, Navbar, Dropdown, Modal, Toast
The rules that matter
```

The `01–08` numbering is gone: it made foundations and components read as peers.
The five former component sections are `h2` groups inside one `#components`
section, and each keeps its old id (`#actions`, `#content`, `#forms`, `#data`,
`#nav`) so in-page links still land.

## Components

`resources/views/components/ds/` — consumed as `<x-ds.*>`:

| Component | Purpose |
|-----------|---------|
| `section` | Page section. `surface=ground\|surface\|sunken\|invert`, `rhythm=tight\|base\|loose` |
| `group` | A component group inside `#components`. Needs a hand-given `id`. |
| `display` | Display heading. `size=sm…2xl`, `as=h1…` |
| `spec` | Component heading (`h3`) — a rail destination |
| `sub-label` | Label inside a demo (`h4`) — not a rail destination |
| `sub-box` | The boxed sub-section: label + the demo it owns. `wrap`, `row` |
| `px` | The pixel arrow. `size=sm\|md\|lg`, `shape=chev3\|chev5\|arrow\|stair` |
| `spinner` | Convergence. Needs a document-unique `name` for its mask |
| `progress-units` | Turn. `value` 0–100, or `demo` to self-cycle (indeterminate). Frontier square takes `--lead-fill` |
| `lead` | Lead paragraph (Figtree Light) |
| `eyebrow` | Uppercase label with lime tick |
| `tile` | Feature card. `interactive` adds hover lift |
| `icon-plate` | Icon in a tile. `activate` for the Light Lime fill |
| `stat` | Number + label |
| `brand` | Wordmark, inherits `currentColor` |
| `navbar` `footer` `cta` | Page furniture |
| `swatch` | Colour chip (gallery) |

### Buttons — the set is Flux's five

Every name is one Flux actually accepts. Flux has no `secondary` or `tertiary`,
so those were dropped rather than invented as aliases — a name the framework
does not accept is a dictionary somebody has to maintain.

| What you type | When |
|---|---|
| `variant="primary"` + `.btn-activate` | The one action of a view. At most one per viewport — that scarcity *is* the 15% rule. |
| `variant="outline"` + `.btn-outline` | The supporting action beside a primary. Safe to use more than once. |
| `variant="filled"` + `.btn-filled` | Quiet but still a button: toolbars, filter chips, anywhere a border would be noise. |
| `variant="ghost"` + `.btn-ghost` | No chrome at all. Icon-only buttons and dense rows. |
| `variant="danger"` | Destructive and irreversible. Left exactly as Flux ships it — the only variant whose meaning comes from outside the brand. |

**`primary` is the lime button.** Flux ships `variant="primary"` reading
`--color-accent` (Deep Blue in light, Lime in dark). `.btn-activate` overrides
that to the activation treatment **on buttons only**: of the 15 elements
resolving `--color-accent`, 4 are buttons and 11 are form controls — checkbox
ticks, radio dots, switch fills — which are untouched. So there is one way to
make a primary button, not two.

Two variants were retired. `subtle` computed identically to `ghost` — transparent
background, no border, no shadow — differing only in label colour, so it was a
decoy tier. The deep-blue solid went because it was a second heavy button
competing with primary, and in dark mode `--color-accent` made it render
identically to primary.

`.btn-lg` is also ours: Flux sizes buttons `xs`/`sm`/`base` and stops, which is
right for an app and too small for a landing hero.

### The pixel arrow

The squares between the C and the m in the wordmark are a rule, not a texture:
equal squares, each one unit right and one unit up, touching corner to corner.
Mirror that stair about its top and you have a chevron — so the arrow is the
wordmark read in a different direction rather than a new shape.

```blade
<flux:button variant="primary" class="btn-activate">Send<x-ds.px /></flux:button>
```

Every square sits at a whole multiple of `--u` and takes `currentColor`, so the
arrow is whatever the label is. The motions obey one constraint: every move
starts and ends on a whole unit. The shipped motion is *March* — two units
right, one square at a time on a 70ms stagger, held while the pointer stays,
and gathered back on mouse-out with the stagger reversed, so the square that
left first returns last. That mirroring is what stops the return reading as a
second animation.

`arrow.css` lists `.btn-activate` alongside `.btn-px-march`, so marching is the
shipped behaviour of the primary button rather than a variant to opt into.

**The arrow marks *forward*.** Drop it when the button does not move you forward
(Save, Apply), and never put it on the one that cancels.

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
| Progress | Value is state | `wire:click="nudgeProgress(...)"` → `--p` on the unit bar |

**The frontier square is lime.** The last square with any fill takes
`--lead-fill` (which is `--color-activation`, not the lime primitive, so a
rebrand moves it along with the primary button). It is picked by arithmetic on
`--p` and `--n` rather than `:nth-child`, because which square it is moves with
the value:

```css
--lead-from: clamp(0, calc((var(--p) - var(--n) * 10) * 1000), 1);
--lead-to:   clamp(0, calc(((var(--n) + 1) * 10 - var(--p)) * 1000 + 1), 1);
--lead:      calc(var(--lead-from) * var(--lead-to));
```

Two half-open tests multiplied: the fill has reached me, and has not yet passed
me. **The `+ 1` on the second is load-bearing** — it makes that bound inclusive.
Every nudge is 10, so a driven bar always lands on a multiple of ten, where no
square is part-turned; without it the controlled bar would never light up at
all. Mid-cycle the frontier square is both part-turned and lime. An empty bar
has no frontier, so nothing is lime at 0.

Note this spends activation. If the bar shares a viewport with a primary
button, that is two lime moments, and the 15% rule says one.

The gallery shows **two bars**, because one cannot show both things at once: a
`demo` bar that never stops, and the same component on `$progress` with the
controls. A single bar that cycled until the first nudge and then handed over
was tried and removed — in a gallery the button is the first thing anyone
touches, so the component spent the rest of its life looking dead.

A `demo` bar is marked indeterminate (no `aria-valuenow`): nothing set it, so
there is no value to announce.

Every form control is bound with `wire:model.live`, and the **Live state** panel
in section 05 prints the server's view of them — proof the binding is real rather
than a styled placeholder.

### Living with the morph

Three pieces of the page are DOM structure that the server does not know about,
and Livewire morphs the component against the server's HTML on every
`wire:model.live` round trip. Each is handled differently, and the difference
matters:

| | Where it lives | Why |
|---|---|---|
| **Sub-section boxes** | Rendered in Blade, as `<x-ds.sub-box>` | The static copy built these in JavaScript, wrapping the siblings a `data-sub-span="N"` label owned. That cannot survive a morph — the server's HTML has no wrapper, so every box would be torn out on the first keystroke in a form field. Blade can nest, so it does. |
| **Colour tabs** | `wire:ignore` | The panels are static markup and the open tab is DOM state (`hidden`). Without the ignore, the first round trip morphs the open tab shut. |
| **Section rail** | The layout, outside the Livewire root | Built from the DOM by `enhanced.js` on load. Outside the component, so nothing can morph it away. |

`enhanced.js` carries a comment at the point where the fourth block used to be,
so nobody reinstates it from the static copy.

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


> The four brand stylesheets are plain CSS on tokens, not Tailwind sources, so
> a changed value in them applies without a rebuild. Only a *new utility class*
> needs one.

```bash
composer install && npm install
npm run build          # or: npm run dev
php artisan serve
```

`/` — landing page · `/design-system` — the living reference.
