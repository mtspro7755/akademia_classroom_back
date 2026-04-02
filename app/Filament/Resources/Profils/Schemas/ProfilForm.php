<?php

namespace App\Filament\Resources\Profils\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ProfilForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('typeProfil')
                    ->options(['Novice' => 'Novice', 'Intermediaire' => 'Intermediaire', 'Aguerri' => 'Aguerri'])
                    ->required(),
                Textarea::make('description')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('niveauMinimal')
                    ->required()
                    ->numeric(),
                TextInput::make('niveauMaximal')
                    ->required()
                    ->numeric(),
            ]);
    }
}
