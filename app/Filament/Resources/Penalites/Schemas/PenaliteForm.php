<?php

namespace App\Filament\Resources\Penalites\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PenaliteForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('dureeInitial')
                    ->required()
                    ->numeric(),
                TextInput::make('tempsDeRetard')
                    ->required()
                    ->numeric(),
                TextInput::make('penalite')
                    ->required()
                    ->numeric(),
                TextInput::make('apprenant_id')
                    ->required()
                    ->numeric(),
            ]);
    }
}
