# C-MORE Design System

The C-MORE brand, expressed as code — and a placeholder landing page that
displays it.

**Laravel 13 · Livewire 3 · Tailwind CSS v4 · Flux UI (free tier) · WireUI**

Built from *C-MORE Brand Manual 2025-03 V2*. Colour, typography, shape and the
50/35/15 usage rules come straight from the manual; everything else is derived
and labelled as such.

---

## What's here

`/` and `/design-system` both render the living reference — every token,
component and rule, rendering from the same stylesheet the product would use.
Nothing on the page is a screenshot.

| Section | Contents |
|---------|----------|
| 01 Colour | 10 brand primitives with Pantone refs, the `sand` neutral ramp, semantic tokens in light and dark |
| 02 Typography | Figtree across the display scale, lead, body and eyebrow |
| 03 Actions | Buttons, badges, callouts, tooltips, progress, skeleton |
| 04 Content | Heading, text, link, separator, card, tile, icons |
| 05 Forms | Every input, all four radio variants, OTP, WireUI pickers, live state panel |
| 06 Data | Avatar, profile, flag, sortable table |
| 07 Navigation | Breadcrumbs, navlist, navbar, dropdowns, modal, toast |
| 08 Scales | Elevation and radius |
| 09 Rules | The 50/35/15 proportions |

The page is a Livewire component, so the components actually work — tabs switch,
the table sorts, toasts fire, and every control is bound with `wire:model.live`.

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
