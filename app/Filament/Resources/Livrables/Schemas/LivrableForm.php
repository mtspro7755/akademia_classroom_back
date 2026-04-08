<?php

namespace App\Filament\Resources\Livrables\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class LivrableForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('apprenant_id')
                    ->label('Apprenant')
                    ->relationship('apprenant', 'email')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('activite_id')
                    ->label('Activité')
                    ->relationship('activite', 'titre')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('typeLivrable')
                    ->options(['Lien' => 'Lien', 'Question' => 'Question'])
                    ->required(),
                TextInput::make('statutCorrection')
                    ->default(null),
                DateTimePicker::make('dateSoumission'),
                TextInput::make('dureeEffectue')
                    ->numeric()
                    ->default(null),
                TextInput::make('lienDuRepertoire')
                    ->default(null),
                TextInput::make('lienDeploye')
                    ->default(null),
            ]);
    }
}
