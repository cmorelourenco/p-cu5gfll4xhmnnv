import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { bunny } from 'laravel-vite-plugin/fonts';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            // Cascade order matters and is deliberate. app.css is the
            // Tailwind entry and carries the theme; the four that follow are
            // plain, unlayered CSS on those tokens, so each one outranks every
            // Tailwind layer and the later file wins over the earlier.
            // arrow.css binds to .btn-activate, which app.css defines, so it
            // must stay last. Same order as the static reference page.
            input: [
                'resources/css/app.css',
                'resources/css/turn.css',
                'resources/css/convergence.css',
                'resources/css/enhanced.css',
                'resources/css/arrow.css',
                'resources/js/app.js',
                'resources/js/enhanced.js',
            ],
            refresh: true,
            fonts: [
                // Figtree — the C-MORE brand typeface (Brand Manual p.19).
                // Five weights: Light / Regular / Medium / Semibold / Bold.
                bunny('Figtree', {
                    weights: [300, 400, 500, 600, 700],
                }),
            ],
        }),
        tailwindcss(),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
