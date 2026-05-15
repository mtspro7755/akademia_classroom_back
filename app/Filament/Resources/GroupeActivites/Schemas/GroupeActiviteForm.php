<?php

namespace App\Filament\Resources\GroupeActivites\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class GroupeActiviteForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nom')
                    ->required(),
                Select::make('activite_id')
                    ->relationship('activite', 'titre')
                    ->default(null),
            ]);
    }
}
