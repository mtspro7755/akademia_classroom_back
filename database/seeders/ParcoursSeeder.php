<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ParcoursFormation;

class ParcoursSeeder extends Seeder
{
    public function run(): void
    {
        ParcoursFormation::create(['intitule' => 'Développement Web']);
        ParcoursFormation::create(['intitule' => 'Data Science']);
    }
}
