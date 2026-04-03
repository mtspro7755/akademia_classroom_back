<?php

namespace App\Filament\Widgets;

use App\Models\Cohorte;
use Filament\Widgets\ChartWidget;

class CohorteProgressChart extends ChartWidget
{
    protected ?string $heading = 'Progression par Cohorte';

    protected function getData(): array
    {
        $cohortes = Cohorte::withCount('apprenants')->get();

        return [
            'datasets' => [
                [
                    'label' => 'Nombre apprenants',
                    'data' => $cohortes->pluck('apprenants_count'),
                ],
            ],
            'labels' => $cohortes->pluck('nom'),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
