<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Livrable;
use App\Models\Apprenant;
use App\Models\Activite;

class LivrableSeeder extends Seeder
{
    public function run(): void
    {
        $apprenants = Apprenant::where('role', 'apprenant')->get();
        $activites = Activite::all();

        foreach ($apprenants as $apprenant) {
            foreach ($activites->random(3) as $activite) {

                Livrable::create([
                    'apprenant_id' => $apprenant->id,
                    'activite_id' => $activite->id,
                    'lienDeploye' => 'https://github.com/test',
                    'typeLivrable' => 'lien',
                    'statutCorrection' => collect(['valide', 'refuse', 'en_attente'])->random(),
                    'dateSoumission' => now(),
                    'dureeEffectue' => rand(1, 5),
                ]);
            }
        }
    }
}
