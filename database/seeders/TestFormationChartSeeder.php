<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ParcoursFormation;
use App\Models\Apprenant;

class TestFormationChartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dev = ParcoursFormation::create(['intitule' => 'Développement Web']);
        $design = ParcoursFormation::create(['intitule' => 'Design Graphique']);

        $cohorteDev = $dev->cohortes()->create([
            'nom' => 'Promo 2026 Web',
            'dateDebut' => '2026-04-25',
            'dateFin' => '2026-12-25',
            'capaciteMax' => 30,
            'statut' => 'EnCours'
        ]);

        $cohorteDesign = $design->cohortes()->create([
            'nom' => 'Promo 2026 Design',
            'dateDebut' => '2026-05-01', // Ajouté
            'dateFin' => '2026-11-30',   // Ajouté
            'capaciteMax' => 20,
            'statut' => 'EnCours'
        ]);

        for ($i = 0; $i < 15; $i++) {
            $uniqueId = time() . $i;

            $apprenant = Apprenant::create([
                'nomComplet' => "Apprenant $i",
                'email' => "user$uniqueId@test.com",
                'phone' => "7712345$i",
                'password' => bcrypt('password'),
                'role' => 'apprenant',
                'statutCompte' => true,
                'profil_id' => null //
            ]);

            $cohorteDev->apprenants()->attach($apprenant->id);
            $cohorteDesign->apprenants()->attach($apprenant->id);
        }
    }
}
