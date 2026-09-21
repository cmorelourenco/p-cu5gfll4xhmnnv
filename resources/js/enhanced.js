// Section rail. Built from the DOM rather than hand-listed, so it stays in
// sync as headings are added or removed.
document.addEventListener('DOMContentLoaded', function () {
  var rail = document.querySelector('[data-enh-rail]');
  if (!rail) return;

  var targets = [];
  var seq = 0;

  document.querySelectorAll('section[id]').forEach(function (section) {
    var eyebrow = section.querySelector('.eyebrow');
    var group = document.createElement('div');
    group.className = 'enh-rail__group';

    var head = document.createElement('a');
    head.className = 'enh-rail__section';
    head.href = '#' + section.id;
    head.textContent = eyebrow ? eyebrow.textContent.trim() : section.id;
    group.appendChild(head);

    // h2 and h3 only. h4s exist inside some subsections (Sizes, Status,
    // Spinner, Bar…) and are page labels, not rail destinations — three
    // levels is the whole structure: section, group, component.
    section.querySelectorAll('h2, h3').forEach(function (heading) {
      if (!heading.id) heading.id = 'h-' + ++seq;
      var link = document.createElement('a');
      // Three levels: h2 is a group inside the section, h3 a component
      // inside that group, h4 a label inside a component.
      link.className =
        'enh-rail__item' + (heading.tagName === 'H3' ? ' enh-rail__item--sub' : '');
      link.href = '#' + heading.id;
      link.textContent = heading.textContent.replace(/\s+/g, ' ').trim();
      group.appendChild(link);
      targets.push({ heading: heading, link: link });
    });

    rail.appendChild(group);
  });

  rail.addEventListener('click', function (e) {
    var link = e.target.closest('a');
    if (!link) return;
    var target = document.getElementById(link.getAttribute('href').slice(1));
    if (!target) return;
    e.preventDefault();

    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
    history.replaceState(null, '', '#' + target.id);
  });

  // Highlight whichever heading the reader is currently under.
  var current = null;
  var ticking = false;

  function sync() {
    ticking = false;
    var best = null;
    targets.forEach(function (t) {
      if (t.heading.getBoundingClientRect().top <= 140) best = t;
    });
    if (best === current) return;
    if (current) current.link.removeAttribute('aria-current');
    current = best;
    if (!current) return;
    current.link.setAttribute('aria-current', 'true');

    var box = current.link.getBoundingClientRect();
    var rb = rail.getBoundingClientRect();
    if (box.top < rb.top + 40 || box.bottom > rb.bottom - 40) {
      current.link.scrollIntoView({ block: 'center' });
    }
  }

  window.addEventListener(
    'scroll',
    function () {
      if (ticking) return;
      ticking = true;
      requestAnimationFrame(sync);
    },
    { passive: true }
  );
  sync();
});

// The sub-section boxes are NOT built here.
//
// On the static page a fourth block walked every `.sub-label`, created a
// `.sub-box` wrapper and moved the following `data-sub-span` siblings into
// it. That cannot survive Livewire: a `wire:model.live` round trip morphs the
// component against the server's HTML, which has no wrapper, so every box
// would be torn out on the first keystroke in a form field.
//
// Blade renders `<x-ds.sub-box>` directly instead, which is where the
// boundary belonged anyway — `data-sub-span` was only ever a way of writing
// the wrapper down in markup that could not nest it.
