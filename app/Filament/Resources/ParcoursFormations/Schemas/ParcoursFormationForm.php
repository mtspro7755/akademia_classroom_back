<?php

namespace App\Filament\Resources\ParcoursFormations\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ParcoursFormationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('intitule')
                    ->required(),
                Select::make('type')
                    ->label('Type de parcours')
                    ->options([
                        'Solo' => 'Solo',
                        'Group' => 'Groupe',
                    ])
                    ->default('Solo')
                    ->required(),
            ]);
    }
}
