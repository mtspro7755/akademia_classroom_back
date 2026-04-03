<?php

namespace App\Filament\Widgets;

use App\Models\Quete;
use Filament\Widgets\ChartWidget;

class TopQuetesChart extends ChartWidget
{
    protected ?string $heading = 'Top Quetes Chart';

    protected function getData(): array
    {
        $quetes = Quete::withCount(['apprenants as completes_count' => function ($q) {
            $q->where('statut', 'termine');
        }])
            ->orderByDesc('completes_count')
            ->limit(5)
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Complétions',
                    'data' => $quetes->pluck('completes_count'),
                ],
            ],
            'labels' => $quetes->pluck('titre'),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
