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
                TextInput::make('parcours_formation_id')
                    ->required()
                    ->numeric(),
            ]);
    }
}
