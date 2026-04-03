<?php

namespace App\Filament\Widgets;

use App\Models\Quete;
use App\Models\Livrable;
use App\Models\Penalite;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AdminStats extends BaseWidget
{
    protected function getStats(): array
    {
        $totalQuetes = Quete::count();

        $quetesCompletes = Quete::whereHas('apprenants', function ($q) {
            $q->where('statut', 'termine');
        })->count();

        $livrablesTotal = Livrable::count();

        $livrablesValides = Livrable::where('statutCorrection', 'valide')->count();

        $livrablesEnAttente = Livrable::where('statutCorrection', 'en_attente')->count();

        $penalites = Penalite::count();

        $parcoursCompletion = $totalQuetes > 0
            ? round(($quetesCompletes / $totalQuetes) * 100, 2)
            : 0;

        return [

            Stat::make('Total Quêtes', $totalQuetes),

            Stat::make('Quêtes complétées', $quetesCompletes),

            Stat::make(
                'Taux réussite',
                $totalQuetes > 0
                    ? round(($quetesCompletes / $totalQuetes) * 100, 2) . '%'
                    : '0%'
            ),

            Stat::make('Livrables soumis', $livrablesTotal),

            Stat::make('Livrables validés', $livrablesValides),

            Stat::make('En attente', $livrablesEnAttente),

            Stat::make(
                'Taux validation',
                $livrablesTotal > 0
                    ? round(($livrablesValides / $livrablesTotal) * 100, 2) . '%'
                    : '0%'
            ),

            Stat::make('Pénalités', $penalites),

            Stat::make('Complétion Parcours', $parcoursCompletion . '%'),
        ];


    }
}
