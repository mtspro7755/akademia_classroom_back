<?php

namespace App\Filament\Resources\Quetes\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class QueteForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('titre')
                    ->required(),
                Select::make('statut')
                    ->options(['Actif' => 'Actif', 'Inactif' => 'Inactif'])
                    ->required(),
                DatePicker::make('dateDebut')
                    ->required(),
                DatePicker::make('dateLimite')
                    ->required(),
                TextInput::make('niveauDifficulte')
                    ->required()
                    ->numeric(),
                Select::make('parcours_formation_id')
                    ->label('Parcours de formation')
                    ->relationship('parcoursFormation', 'intitule')
                    ->searchable()
                    ->preload()
                    ->required(),
            ]);
    }
}
