<?php

namespace App\Filament\Widgets;

use App\Models\ParcoursFormation;
use Filament\Widgets\ChartWidget;

class FormationChart extends ChartWidget
{
    protected ?string $heading = 'Statistiques des formations';

    protected function getData(): array
    {
        $formations = ParcoursFormation::withCount('Cohortes')->get();

        $labels=[];
        $apprenantsCount=[];

        foreach ($formations as $formation) {
            $labels[]=$formation->intitule;
            $count = $formation->cohortes()
                ->withCount('apprenants')
                ->get()
                ->sum('apprenants_count');

            $apprenantsCount[] = $count;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Apprenants par formation',
                    'data' => $apprenantsCount,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
