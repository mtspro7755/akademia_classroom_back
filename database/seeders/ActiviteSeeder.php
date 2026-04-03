<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Activite;
use App\Models\Quete;

class ActiviteSeeder extends Seeder
{
    public function run(): void
    {
        $quetes = Quete::all();

        foreach ($quetes as $quete) {
            for ($i = 1; $i <= 3; $i++) {
                Activite::create([
                    'quete_id' => $quete->id,
                    'titre' => "Activité $i",
                    'description' => 'Description activité',
                    'duree' => rand(1, 5),
                    'statut' => 'actif',
                    'ordreAffichage' => $i,
                    'typeActivite' => 'atelier',
                ]);
            }
        }
    }
}
