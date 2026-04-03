<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Quete;
use App\Models\ParcoursFormation;

class QueteSeeder extends Seeder
{
    public function run(): void
    {
        $parcours = ParcoursFormation::first();

        for ($i = 1; $i <= 5; $i++) {
            Quete::create([
                'titre' => 'Quête ' . $i,
                'statut' => 'actif',
                'dateDebut' => now(),
                'dateLimite' => now()->addDays(10),
                'niveauDifficulte' => 2,
                'parcours_formation_id' => $parcours->id
            ]);
        }
    }
}
