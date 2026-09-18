<?php

namespace App\Livewire;

use Flux\Flux;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

/**
 * The living design system page.
 *
 * Most Flux components are interactive on their own — dropdowns, modals,
 * tooltips, radios, switches and toggles are custom elements driven by
 * flux.js and need no server round trip. What genuinely needs state is the
 * handful of components whose "current" or "sorted" condition is rendered
 * server-side: navbar, navlist and table. Those are wired here.
 */
#[Layout('components.layouts.site')]
#[Title('C-MORE — Design System')]
class DesignSystem extends Component
{
    /** Navigation state — the part that cannot work without a round trip. */
    public string $tab = 'overview';

    public string $navItem = 'overview';

    /** Table sorting. */
    public string $sortBy = 'score';

    public string $sortDirection = 'desc';

    /** Form bindings, so the live state panel has something to report. */
    public array $domains = ['climate'];

    public string $frequency = 'quarterly';

    public string $quarter = 'q4';

    public string $filter = 'all';

    public string $depth = 'standard';

    public bool $alerts = true;

    public bool $digest = false;

    public array $format = ['italic'];

    public string $email = '';

    public string $organisation = 'C-MORE';

    public string $tier = 'Tier 1';

    public string $notes = '';

    public int $progress = 64;

    /** Sort the table, flipping direction when the same column is clicked. */
    public function sort(string $column): void
    {
        if ($this->sortBy === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';

            return;
        }

        $this->sortBy = $column;
        $this->sortDirection = 'asc';
    }

    public function nudgeProgress(int $by): void
    {
        $this->progress = max(0, min(100, $this->progress + $by));
    }

    public function notify(string $variant = 'success'): void
    {
        Flux::toast(
            heading: match ($variant) {
                'success' => 'Assessment sent',
                'warning' => 'Three suppliers unreachable',
                'danger' => 'Send failed',
                default => 'Heads up',
            },
            text: match ($variant) {
                'success' => '42 suppliers have been notified.',
                'warning' => 'Their contact addresses bounced.',
                'danger' => 'Nothing was sent. Try again.',
                default => 'Something happened.',
            },
            variant: $variant,
        );
    }

    /** The demo table, sorted by the current column and direction. */
    public function getRowsProperty(): array
    {
        $rows = [
            ['supplier' => 'Northwind Materials', 'tier' => 1, 'score' => 86, 'status' => 'Assessed', 'colour' => 'lime'],
            ['supplier' => 'Verax Industrial',    'tier' => 1, 'score' => 72, 'status' => 'Pending',  'colour' => 'amber'],
            ['supplier' => 'Almada Logistics',    'tier' => 2, 'score' => 54, 'status' => 'Overdue',  'colour' => 'red'],
            ['supplier' => 'Belmonte Chemicals',  'tier' => 2, 'score' => 91, 'status' => 'Assessed', 'colour' => 'lime'],
            ['supplier' => 'Caldeira Freight',    'tier' => 3, 'score' => 63, 'status' => 'Pending',  'colour' => 'amber'],
        ];

        usort($rows, function (array $a, array $b): int {
            $result = $a[$this->sortBy] <=> $b[$this->sortBy];

            return $this->sortDirection === 'asc' ? $result : -$result;
        });

        return $rows;
    }

    public function render()
    {
        return view('livewire.design-system');
    }
}
