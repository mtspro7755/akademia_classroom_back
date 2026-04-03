<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Penalite;
use App\Models\Apprenant;

class PenaliteSeeder extends Seeder
{
    public function run(): void
    {
        $apprenants = Apprenant::all();

        foreach ($apprenants->random(5) as $apprenant) {
            Penalite::create([
                'apprenant_id' => $apprenant->id,
                'dureeInitial' => 5,
                'tempsDeRetard' => rand(1, 3),
            ]);
        }
    }
}
