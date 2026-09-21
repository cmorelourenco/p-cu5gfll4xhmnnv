# C-MORE Design System 2.0

The C-MORE brand, expressed as code — and a placeholder landing page that
displays it.

**Laravel 13 · Livewire 3 · Tailwind CSS v4 · Flux UI (free tier) · WireUI**

Built from *C-MORE Brand Manual 2025-03 V2*. Colour, typography, shape and the
50/35/15 usage rules come straight from the manual; everything else is derived
and labelled as such.

---

## What 2.0 is

A copy of the original Wire UI design system setup, with the work that had been
done on the static export folded back into real Blade and CSS source. The static
copy could only grow by hand-editing generated HTML; here every addition is a
component, a token or a stylesheet that rebuilds.

What came across:

| | |
|---|---|
| **The pixel arrow** | The wordmark's stair, mirrored into a chevron, on the primary button. Marks *forward*. |
| **Five button variants** | Every name is one Flux actually accepts. `primary` is the accent button. |
| **Three navigation levels** | Section → group → component, mirroring Flux's own split. The `01–08` numbering is gone. |
| **Turn** | Progress as ten discrete squares, each turning a quarter as it fills. |
| **Convergence** | The spinner: four squares leaving the ring and returning. |
| **The section rail** | Built from the DOM, so it stays in sync as headings change. |

---

## What's here

`/` and `/design-system` both render the living reference — every token,
component and rule, rendering from the same stylesheet the product would use.
Nothing on the page is a screenshot.

| Section | Contents |
|---------|----------|
| Colour | The three brand colours, the supporting set, the `sand` ramp and the semantic tokens |
| Typography | Figtree across the display scale, lead, body and eyebrow |
| Scales | Elevation and radius |
| Components → Actions | Buttons, badges, callout, tooltip, spinner, progress, skeleton |
| Components → Content | Text, separator, card, tile, icons |
| Components → Forms | Every input, all four radio variants, OTP, WireUI pickers, live state panel |
| Components → Data display | Avatar, profile, flag, sortable table |
| Components → Navigation and overlays | Breadcrumbs, navlist, navbar, dropdowns, modal, toast |
| The rules that matter | The 50/35/15 proportions |

The page is a Livewire component, so the components actually work — the navbar
switches, the table sorts, toasts fire, the progress bar moves, and every
control is bound with `wire:model.live`.

**[DESIGN-SYSTEM.md](DESIGN-SYSTEM.md) is the written spec** — architecture,
measured contrast ratios, the cascade rule that makes the Flux overrides work,
and the known packaging gotchas.

---

## Running it

```bash
composer install
npm install
npm run build          # or: npm run dev
php artisan serve
```

Then open http://localhost:8000.

> After editing any Blade file, rebuild the CSS. Tailwind v4 only generates the
> utility classes it saw at build time, so a class you just typed silently
> resolves to nothing until the build runs again. `npm run dev` avoids this.
>
> The four brand stylesheets are plain CSS on tokens, not Tailwind sources, so
> changing a value in them takes effect without a rebuild.

---

## Two things to know before changing dependencies

1. **Livewire is pinned to `^3.7`, not 4.** WireUI 2.6's Alpine components do not
   register under Livewire 4. Livewire 3 is the version both Flux 2 and WireUI 2
   support.
2. **`@wireUiStyles` is deliberately absent.** WireUI 2.6 ships no
   `dist/wireui.css` and the directive 500s on the missing file. Its styles come
   from Tailwind scanning the package — see the `@source` lines in
   `resources/css/app.css`.

## Licensing

Flux's free tier covers every component used here. Tabs, Accordion, Charts, Date
picker, Command and Kanban are Flux Pro. WireUI (MIT) fills those gaps and reads
the same token aliases, so it lands on brand without extra work.
