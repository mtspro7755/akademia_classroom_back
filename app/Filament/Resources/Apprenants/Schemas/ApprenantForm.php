<?php

namespace App\Filament\Resources\Apprenants\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ApprenantForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nomComplet')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                TextInput::make('phone')
                    ->tel()
                    ->required(),
                TextInput::make('password')
                    ->password()
                    ->required(),
                TextInput::make('pseudo')
                    ->default(null),
                Select::make('role')
                    ->options([
                        'Apprenant' => 'apprenant',
                        'Formateur' => 'formateur',
                    ])
                    ->required(),
                Toggle::make('statutCompte')
                    ->label('Activer le compte')
                    ->required(),
                Select::make('groupe_activite_id')
                    ->label('Groupe d\'activité')
                    ->relationship('groupeActivite', 'nom')
                    ->searchable()
                    ->preload()
                    ->nullable(),
            ]);
    }
}
