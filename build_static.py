#!/usr/bin/env python3
"""
Export the living design system to one self-contained HTML file.

GitHub Pages serves static files only, so the Livewire round trips have to go.
Flux's components are custom elements driven by flux.js and keep working; the
four server-backed demos (navbar/navlist current, table sort, toast, live state)
are re-implemented in a few lines of vanilla JS at the bottom, so the page still
behaves the way it does in the app.
"""
import base64
import pathlib
import re
import subprocess
import sys

ROOT = pathlib.Path(__file__).parent
OUT = ROOT / "dist" / "index.html"
SRC = "http://localhost:8098/"


def fetch(url: str) -> str:
    return subprocess.run(["curl", "-fsS", url], capture_output=True, text=True, check=True).stdout


def main() -> None:
    html = fetch(SRC)

    # ---- CSS, with the Figtree faces inlined as data URIs -----------------
    # All five sheets, in cascade order. They are unlayered and later wins, so
    # concatenating in the wrong order silently changes the page — see
    # DESIGN-SYSTEM.md, "Cascade". arrow.css binds to .btn-activate, which
    # app.css defines, so it stays last.
    SHEETS = ["app", "turn", "convergence", "enhanced", "arrow"]
    parts = []
    for stem in SHEETS:
        matches = sorted((ROOT / "public/build/assets").glob(f"{stem}-*.css"))
        if not matches:
            raise SystemExit(f"{stem}-*.css missing from public/build/assets — run npm run build")
        parts.append(f"/* ---- {stem}.css ---- */\n" + matches[-1].read_text())
    css = "\n".join(parts)

    def inline_font(m: re.Match) -> str:
        name = pathlib.Path(m.group(1)).name
        f = ROOT / "public/build/assets" / name
        if not f.exists():
            return m.group(0)
        mime = "font/woff2" if name.endswith(".woff2") else "font/woff"
        b64 = base64.b64encode(f.read_bytes()).decode()
        return f"url(data:{mime};base64,{b64})"

    css = re.sub(r"url\(([^)]*\.woff2?)\)", inline_font, css)

    # ---- Scripts ----------------------------------------------------------
    # Take the bundles the app actually serves rather than guessing at a dist
    # file — the served build is the one known to register the custom elements.
    flux_js = fetch(SRC + "flux/flux.js")
    wireui_js = fetch(SRC + "wireui/assets/scripts")
    # Alpine normally arrives bundled inside livewire.js; WireUI needs it.
    alpine_js = pathlib.Path("/tmp/alpine.js").read_text()
    # The colour tabs and the section rail are page behaviour and work without
    # a server, so they ship with the export.
    enhanced_matches = sorted((ROOT / "public/build/assets").glob("enhanced-*.js"))
    if not enhanced_matches:
        raise SystemExit("enhanced-*.js missing from public/build/assets — run npm run build")
    enhanced_js = enhanced_matches[-1].read_text()

    # ---- Flags: fetch and inline ------------------------------------------
    # Flux serves these from a route, so the export was shipping
    # src="http://localhost:PORT/flux/flags/PT" — five broken images on the
    # published page, since nobody else is running the app. They are ~500 byte
    # SVGs, so they inline as data URIs the same way the fonts do.
    def inline_flag(m: re.Match) -> str:
        try:
            svg = fetch(m.group(1))
        except subprocess.CalledProcessError:
            return m.group(0)
        b64 = base64.b64encode(svg.encode()).decode()
        return f'src="data:image/svg+xml;base64,{b64}"'

    html = re.sub(r'src="(' + re.escape(SRC.rstrip("/")) + r'/flux/flags/[^"]*)"', inline_flag, html)

    # ---- Strip everything that needs a server -----------------------------
    html = re.sub(r'<link[^>]*rel="(modulepreload|preload)"[^>]*>\s*', "", html)
    html = re.sub(r'<link[^>]*rel="stylesheet"[^>]*>\s*', "", html)
    html = re.sub(r'<script[^>]*src="[^"]*"[^>]*>\s*</script>\s*', "", html)
    # Livewire's boot payload and update endpoint are meaningless without PHP.
    html = re.sub(r'<script[^>]*data-navigate-once[^>]*>.*?</script>\s*', "", html, flags=re.S)
    html = re.sub(r'\swire:(snapshot|effects)="(?:[^"\\]|\\.)*"', "", html)

    # ---- Rewrite the Livewire hooks into static ones -----------------------
    # The toast buttons keep their wire:click in the export; turn it into a
    # data attribute the vanilla handler below understands.
    toasts = {
        "success": ("Assessment sent", "42 suppliers have been notified."),
        "warning": ("Three suppliers unreachable", "Their contact addresses bounced."),
        "danger": ("Send failed", "Nothing was sent. Try again."),
    }
    for variant, (heading, text) in toasts.items():
        html = html.replace(
            f'wire:click="notify(\'{variant}\')"',
            f'data-static-toast="{variant}" data-toast-heading="{heading}" data-toast-text="{text}"',
        )

    # The progress nudges.
    html = html.replace('wire:click="nudgeProgress(-10)"', 'data-static-progress="-10"')
    html = html.replace('wire:click="nudgeProgress(10)"', 'data-static-progress="10"')

    # Give the navbar readout something to write into.
    html = html.replace(
        '<strong class="font-semibold text-ink">Overview</strong>',
        '<strong class="font-semibold text-ink" data-selected-tab>Overview</strong>',
    )

    # Be honest about the one thing that genuinely cannot work without a server.
    html = html.replace(
        "This panel is the server's view of them &mdash; change\n                anything and it updates here.",
        "In the app this panel is the server's view of them, updating as you "
        "change anything. This is the static export, so the values below are "
        "frozen at their defaults \u2014 there is no server to report to.",
    )

    # Any remaining wire:* attributes are inert; drop them so the markup is clean.
    html = re.sub(r'\swire:[a-zA-Z0-9.:_-]+="(?:[^"\\]|\\.)*"', "", html)
    html = re.sub(r'\swire:[a-zA-Z0-9.:_-]+(?=[\s>])', "", html)

    # ---- Reassemble -------------------------------------------------------
    head_add = f"<style>{css}</style>\n"
    # Order matters: Flux and WireUI register Alpine components on `alpine:init`,
    # and the Alpine CDN build starts itself the moment it runs. Alpine last.
    body_add = (
        f"<script>{flux_js}</script>\n"
        f"<script>{wireui_js}</script>\n"
        f"<script>{alpine_js}</script>\n"
        f"<script>{STATIC_BEHAVIOUR}</script>\n"
        # enhanced.js listens for DOMContentLoaded. This block is injected
        # inside <body>, so it runs during parsing and the listeners are
        # registered before the real event — no re-dispatch, which would run
        # them twice and build the rail twice.
        f"<script>{enhanced_js}</script>\n"
    )
    html = html.replace("</head>", head_add + "</head>", 1)
    html = html.replace("</body>", body_add + "</body>", 1)

    OUT.parent.mkdir(parents=True, exist_ok=True)
    OUT.write_text(html)
    print(f"{OUT.relative_to(ROOT)}  {OUT.stat().st_size / 1024:.0f} KB")


# Re-implements, client-side, the four things that needed Livewire.
STATIC_BEHAVIOUR = r"""
document.addEventListener('DOMContentLoaded', function () {
  // 1 & 2 — navbar and navlist `current` state
  document.querySelectorAll('[data-flux-navbar], [data-flux-navlist]').forEach(function (group) {
    var items = group.querySelectorAll('button, a');
    items.forEach(function (item) {
      item.addEventListener('click', function (e) {
        e.preventDefault();
        items.forEach(function (i) { i.removeAttribute('data-current'); });
        item.setAttribute('data-current', 'data-current');
        var out = document.querySelector('[data-selected-tab]');
        if (out && group.hasAttribute('data-flux-navbar')) {
          out.textContent = item.textContent.trim().split('\n')[0];
        }
      });
    });
  });

  // 3 — table sorting
  document.querySelectorAll('[data-flux-table]').forEach(function (table) {
    var dir = {};
    table.querySelectorAll('thead th').forEach(function (th, col) {
      if (!th.textContent.trim()) return;
      th.style.cursor = 'pointer';
      th.addEventListener('click', function () {
        dir[col] = dir[col] === 'asc' ? 'desc' : 'asc';
        var body = table.querySelector('tbody');
        var rows = Array.prototype.slice.call(body.querySelectorAll('tr'));
        rows.sort(function (a, b) {
          var x = a.children[col].textContent.trim();
          var y = b.children[col].textContent.trim();
          var nx = parseFloat(x), ny = parseFloat(y);
          var r = (!isNaN(nx) && !isNaN(ny)) ? nx - ny : x.localeCompare(y);
          return dir[col] === 'asc' ? r : -r;
        });
        rows.forEach(function (r) { body.appendChild(r); });
      });
    });
  });

  // 3b — progress nudges
  var bar = document.querySelector('[data-flux-progress]');
  document.querySelectorAll('[data-static-progress]').forEach(function (btn) {
    btn.addEventListener('click', function () {
      if (!bar) return;
      var step = parseInt(btn.getAttribute('data-static-progress'), 10);
      var now = parseInt(bar.getAttribute('value') || '64', 10);
      var next = Math.max(0, Math.min(100, now + step));
      bar.setAttribute('value', next);
      var out = btn.parentElement.querySelector('span');
      if (out) out.textContent = next + '%';
    });
  });

  // 4 — toasts, dispatched straight at Flux's own toast element
  document.querySelectorAll('[data-static-toast]').forEach(function (btn) {
    btn.addEventListener('click', function () {
      var variant = btn.getAttribute('data-static-toast');
      // Flux's <ui-toast> listens with x-on:toast-show.document — not on window.
      // Payload shape captured from the live Livewire app: Flux expects the
      // copy under `slots` and the variant under `dataset`.
      document.dispatchEvent(new CustomEvent('toast-show', {
        detail: {
          duration: 5000,
          slots: {
            heading: btn.getAttribute('data-toast-heading'),
            text: btn.getAttribute('data-toast-text')
          },
          dataset: { variant: variant }
        }
      }));
    });
  });
});
"""

if __name__ == "__main__":
    sys.exit(main())
