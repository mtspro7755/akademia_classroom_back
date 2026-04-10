<?php

namespace App\Filament\Widgets;

use App\Models\Quete;
use App\Models\Livrable;
use App\Models\Penalite;
use App\Models\ParcoursFormation;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Carbon\Carbon;

class AdminStats extends BaseWidget
{
    protected function getStats(): array
    {
        $livrablesTotal = Livrable::count();
        $livrablesAujourdhui = Livrable::whereDate('created_at', Carbon::today())->count();
        $livrablesValides = Livrable::where('statutCorrection', 'valide')->count();
        $livrablesEnAttente = Livrable::where('statutCorrection', 'en_attente')->count();

        $totalParcours = ParcoursFormation::count();
        $parcoursTermines = ParcoursFormation::whereDoesntHave('cohortes', function ($q) {
            $q->where('statut', '!=', 'Termine');
        })->count();

        $totalQuetes = Quete::count();
        $quetesCompletes = Quete::whereHas('apprenants', function ($q) {
            $q->where('statut', 'termine');
        })->count();

        return [
            Stat::make('Livrables soumis', $livrablesTotal)
                ->description($livrablesAujourdhui . " soumis aujourd'hui")
                ->descriptionIcon($livrablesAujourdhui > 0 ? 'heroicon-m-arrow-trending-up' : null)
                ->color($livrablesAujourdhui > 0 ? 'success' : 'gray'),

            Stat::make('Livrables validés', $livrablesValides)
                ->description($livrablesTotal > 0 ? round(($livrablesValides / $livrablesTotal) * 100, 2) . "% du total" : "0%"),

            Stat::make('En attente', $livrablesEnAttente)
                ->description("À corriger par les coachs")
                ->color('warning'),

            Stat::make('Complétion Parcours', round(($parcoursTermines / max($totalParcours, 1)) * 100, 2) . '%')
                ->description($parcoursTermines . " sur " . $totalParcours . " formations terminées")
                ->color('primary'),

            Stat::make('Taux réussite Quêtes', ($totalQuetes > 0 ? round(($quetesCompletes / $totalQuetes) * 100, 2) : 0) . '%')
                ->description($quetesCompletes . " sur " . $totalQuetes . " quêtes réussies"),

            Stat::make('Pénalités', Penalite::count())
                ->description(Penalite::whereDate('created_at', Carbon::today())->count() . " aujourd'hui")
                ->color('danger'),
        ];
    }
}
