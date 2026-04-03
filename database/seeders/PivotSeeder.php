<?php

namespace Database\Seeders;

use App\Models\Apprenant;
use App\Models\Quete;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PivotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $apprenants = Apprenant::where('role', 'apprenant')->get();
        $quetes = Quete::all();

        foreach ($apprenants as $apprenant) {
            foreach ($quetes->random(3) as $quete) {
                $apprenant->quetes()->attach($quete->id, [
                    'statut' => collect(['EnCours', 'termine'])->random(),
                    'dureeEffective' => rand(1, 10),
                    'dateSoumission' => now()
                ]);
            }
        }
    }
}
