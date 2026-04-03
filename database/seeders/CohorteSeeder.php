<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cohorte;
use App\Models\ParcoursFormation;

class CohorteSeeder extends Seeder
{
    public function run(): void
    {
        $parcours = ParcoursFormation::first();

        if ($parcours) {
            Cohorte::create([
                'nom' => 'Cohorte 2026',
                'capaciteMax' => 30,
                'statut' => 'EnCours',
                'dateDebut' => now(),
                'dateFin' => now()->addMonths(6),
                'parcours_formation_id' => $parcours->id
            ]);
        }
    }
}
