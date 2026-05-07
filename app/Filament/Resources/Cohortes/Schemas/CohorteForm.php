<?php

namespace App\Filament\Resources\Cohortes\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CohorteForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nom')
                    ->required(),
                TextInput::make('capaciteMax')
                    ->required()
                    ->numeric(),
                DatePicker::make('dateDebut')
                    ->required(),
                DatePicker::make('dateFin')
                    ->required(),
                Select::make('statut')
                    ->options(['EnAttente' => 'En attente', 'EnCours' => 'En cours', 'Termine' => 'Termine'])
                    ->required(),
                TextInput::make('prix')
                    ->label('Prix')
                    ->numeric()
                    ->decimalPlaces(2)
                    ->default(0.00)
                    ->step(0.01),
                TextInput::make('devise')
                    ->label('Devise')
                    ->default('XOF')
                    ->maxLength(3),
                Select::make('parcours_formation_id')
                    ->label('Parcours de formation')
                    ->relationship('parcoursFormation', 'intitule')
                    ->searchable()
                    ->preload()
                    ->required(),
            ]);
    }
}
