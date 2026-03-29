<?php

namespace App\Filament\Widgets;

use App\Models\Apprenant;
use Filament\Widgets\ChartWidget;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;

class UsersChart extends ChartWidget
{
    protected ?string $heading = 'Inscriptions des utilisateurs';

    protected function getData(): array
    {
        $today = Apprenant::whereDate('created_at', today())->count();

        $week = Apprenant::whereBetween('created_at',[
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek(),
        ])->count();

        $month = Apprenant::whereMonth('created_at', Carbon::now()->month)->count();

        return [
            'datasets' => [
                [
                    'label' => 'Utilisateurs',
                    'data' => [$today, $week, $month],
                ],
            ],
            'labels' => ['Aujourd’hui', 'Semaine', 'Mois'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
