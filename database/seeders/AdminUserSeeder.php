<?php

namespace Database\Seeders;

use App\Models\Apprenant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        Apprenant::updateOrCreate(
            ['email' => 'admin@terangacode.com'],
            [
                'nomComplet' => 'admin',
                'phone' => '770000000',
                'pseudo' => 'admin',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'statutCompte' => true,
            ]
        );
    }
}
