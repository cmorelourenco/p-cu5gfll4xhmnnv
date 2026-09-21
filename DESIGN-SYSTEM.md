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
| **35%** | Graphite **identifies** | Structure, type, chrome. The backdrop, not the paint. |
| **15%** | Coral **activates** | Select moments only. One per viewport. |

Everything below exists to make that easy to follow and awkward to break.

---

## Architecture

Three layers, in `resources/css/app.css`. Each one only ever reads from the one above.

```
1  PRIMITIVES   --color-graphite, --color-coral, …   the three brand colours
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
50–300 are the manual's four neutrals untouched; 400–950 run down to the main
colour. **`sand-950` is Graphite.** Because Graphite is far lighter than the old
main, 700–950 span a narrower range than they did — the dark steps sit closer
together than a stock zinc ramp, which is the colour's doing rather than a
mistake.

---

## Colour

### Primitives

Three brand colours, listed main / secondary / accent. They map onto the
50/35/15 rule exactly, though not in that order — the ground is the 50%. The neutrals are
unchanged (Light Beige is both the secondary and one of the four), and the
supporting blues were **not** part of the recolour (see the note below).

| Name | Hex | Pantone | Note |
|------|-----|---------|------|
| Graphite | `#343434` | TBC | **Main.** Identifies |
| Light Beige | `#F2F1ED` | — | **Secondary.** The ground, and the label on every solid brand button |
| Coral | `#F46D4F` | TBC | **Accent.** Activates. **Large or bold text only — see contrast.** |
| Blue | `#4E638B` | 7682C | 5.3:1 on ground — the muted text colour |
| Mid Blue | `#909DB6` | 535C | 2.4:1 — **borders only, never text** |
| Coral Deep | `#F44E29` | — | The coral's hover state |
| Coral Tint | `#F9E7E3` | — | Quiet activation |
| Off White | `#FAFAFA` | — | |
| Light Beige | `#F2F1ED` | — | The page ground |
| Mid Beige | `#E9E7E2` | — | Sunken wells |
| Dark Beige | `#E0DED7` | — | Hairlines |

Both new colours carry **PMS TBC** — neither has been matched against a
physical guide.

**The supporting blues are still blue.** They were not in the recolour, so
`#4E638B` and `#909DB6` are the only hue in the system besides the coral, and
on a neutral main they read as a third colour rather than as quiet text.
Neutral equivalents at the same measured ratios are `#636363` (5.32:1) and
`#A8A8A8` (2.10:1); swapping them is two lines in the `@theme` block.

### Semantics

| Token | Light | Dark | Use |
|-------|-------|------|-----|
| `--color-accent` | Graphite | Coral | Primary buttons, links, focus. **Flux reads this directly.** |
| `--color-activation` | Coral | Coral | The 15%. Label is Light Beige (2.60:1); the icon and arrow hold `--color-activation-mark`, Graphite (4.24:1). |
| `--color-ground` | Light Beige | Graphite | The page |
| `--color-surface` | White | `#3E3E3E` | Cards on the ground |
| `--color-surface-sunken` | Mid Beige | `#2A2A2A` | Wells, inset panels |
| `--color-ink` | Graphite | Off White | Headings, primary copy |
| `--color-ink-muted` | Blue | Mid Blue | Secondary copy — 5.3:1, AA |
| `--color-ink-subtle` | Sand 600 | `#A2A2A2` | Meta, captions — 4.9:1, AA |
| `--color-line` | Dark Beige | Mid Blue 24% | Hairlines |

### There is no secondary colour token

An Electric Blue was once proposed as one, and a tabbed *Alternatives* panel on
the colour section carried it alongside two hue studies. All of it argued about
Deep Blue and Lime, so the recolour left it describing a palette that no longer
existed, and it has been removed along with the tab.

Note the word "secondary" now means the Light Beige — one of the three brand
colours, the ground — and not a third accent. The old `--color-secondary`
token is gone; `.enh-rail`'s focus ring was the only live thing still reading
it and now takes `--color-accent`, which is where focus belongs.

### Contrast, measured

| Pair | Ratio | Verdict |
|------|-------|---------|
| Graphite on Light Beige | 11.0:1 | Anything |
| White on Graphite | 12.5:1 | Anything |
| Blue on Light Beige | 5.3:1 | AA body text |
| Sand 600 on Off White | 4.9:1 | AA body text — the lightest that passes |
| **Light Beige on Coral** | **2.60:1** | **The shipped button label. Below AA-large — fails at every text size.** |
| Graphite on Coral | 4.24:1 | The icon and arrow colour. Large or bold only. |
| Coral on Graphite | 4.24:1 | Same pair inverted — dark-mode accent |
| Coral on Light Beige | 2.6:1 | **Decoration only** |
| Mid Blue on Light Beige | 2.4:1 | **Decoration only** |
| **White on Coral** | **2.94:1** | **Never.** |

**The signature pairing lost its headroom, and the current label gives it
away entirely.** It used to be near-black on lime at 13.8:1. Coral is a far
darker accent, so nothing obvious clears AA on it — Graphite 4.24, white 2.94,
Light Beige 2.60. The shipped label is the Light Beige, the lowest of the
three: it is below AA-large, so it does not pass at any text size. The button
is currently legible mainly by shape and by the dark arrow beside the words.

This is a deliberate choice, recorded here rather than silently corrected.
Three ways back, each one line:

| Change | Ratio |
|---|---|
| `--color-activation-foreground: #2b2b2b` | 4.82 — AA |
| `--color-activation-foreground: var(--color-graphite)` | 4.24 — AA-large |
| Lighten the coral to `#F57D62`, keep a dark label | 4.74 — AA |

**The accent and the danger colour are now 14° apart in hue.** Coral sits at
hue 11°, Flux's `danger` red at 357°, so the primary and the destructive
button read as the same family — visible in the variants row, and worse in
dark mode. Under the old palette they were 77° apart. Nothing is broken, but
"the button that does the thing" and "the button that destroys the thing" no
longer separate on colour alone.

### Appearance

**The page always opens light.** Flux's own default is `system`, which turns the
page navy on a dark-mode machine — the wrong first impression for a brand whose
layouts are 50% warm neutral. The layout overrides that default; a visitor's own
choice, made with the toggle in the header, is remembered and wins on return.

Dark mode itself is not an inversion. Graphite is the backdrop for much of the
brand, so dark is the brand at rest — and there Coral becomes the accent. Note
the ground is a mid-dark grey rather than the near-black it used to be, so dark
mode is a softer, lower-contrast theme than before.

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
  `hairline` → `raised` → `floating` → `overlay`. Shadows are tinted with the
  main colour rather than black so they never grey the warm ground.
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
| `eyebrow` | Uppercase label with a coral tick |
| `tile` | Feature card. `interactive` adds hover lift; `activate` makes the **card** the accent |
| `icon-plate` | Icon in a tile. `activate` for the quiet Coral Tint fill (standalone plates only) |
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

**Solid buttons: light label, brand mark.** Both solid variants take
`--color-brand-label` (Light Beige) for the words, and put the *other* brand
colour on the icon and pixel arrow — graphite on the coral button, coral on
the graphite one. One token keeps the pair in step.

`.btn-filled` used to label in coral, which spent the activation colour on
every button in the sizes and states rows: the 15% going to the quietest
control in the system. Moving the coral to the mark keeps it to one small
shape, and takes the label from 4.24:1 to 10.96:1.
| `variant="ghost"` + `.btn-ghost` | No chrome at all. Icon-only buttons and dense rows. |
| `variant="danger"` | Destructive and irreversible. Left exactly as Flux ships it — the only variant whose meaning comes from outside the brand. |

**`primary` is the accent button.** Flux ships `variant="primary"` reading
`--color-accent` (Graphite in light, Coral in dark). `.btn-activate` overrides
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

**The frontier square takes the accent.** The last square with any fill uses
`--lead-fill` (which is `--color-activation`, not the coral primitive, so a
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
all. Mid-cycle the frontier square is both part-turned and coral. An empty bar
has no frontier, so nothing is coloured at 0.

Note this spends activation. If the bar shares a viewport with a primary
button, that is two activation moments, and the 15% rule says one.

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
