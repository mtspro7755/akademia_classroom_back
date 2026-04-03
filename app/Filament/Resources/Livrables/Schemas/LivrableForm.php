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
                TextInput::make('apprenant_id')
                    ->required()
                    ->numeric(),
                TextInput::make('activite_id')
                    ->required()
                    ->numeric(),
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
