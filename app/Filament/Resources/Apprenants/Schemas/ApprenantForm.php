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
                TextInput::make('role')
                    ->required(),
                Toggle::make('statutCompte')
                    ->required(),
                Select::make('profil_id')
                    ->label('Profil')
                    ->relationship('profil', 'typeProfil')
                    ->searchable()
                    ->preload()
                    ->required(),
            ]);
    }
}
