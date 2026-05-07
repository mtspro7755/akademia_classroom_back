<?php

namespace App\Filament\Resources\Candidatures\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CandidatureForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('statut')
                    ->options(['en_cours' => 'En cours', 'accepte' => 'Accepte', 'refuse' => 'Refuse'])
                    ->default('en_cours')
                    ->required(),
                Select::make('apprenant_id')
                    ->label('Apprenant')
                    ->relationship('apprenant', 'nomComplet')
                    ->searchable()
                    ->preload()
                    ->required(),
            ]);
    }
}
