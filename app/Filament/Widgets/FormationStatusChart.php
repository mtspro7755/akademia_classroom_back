<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Cohorte;


class FormationStatusChart extends ChartWidget
{
    protected ?string $heading  = 'Statut des formations';

    protected function getData(): array
    {
        $enCours = Cohorte::where('statut', 'EnCours')->count();
        $termine = Cohorte::where('statut', 'Termine')->count();
        $attente = Cohorte::where('statut', 'EnAttente')->count();

        return [
            'datasets' => [
                [
                    'label' => 'Statuts',
                    'data' => [$enCours, $termine, $attente],
                    'backgroundColor' => ['#fbbf24', '#22c55e', '#94a3b8'],
                ],
            ],
            'labels' => ['En cours', 'Terminé', 'En attente'],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
