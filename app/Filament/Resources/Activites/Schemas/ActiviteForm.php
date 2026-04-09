<?php

namespace App\Filament\Resources\Activites\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ActiviteForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('quete_id')
                    ->relationship('quete', 'titre')
                    ->searchable()
                    ->preload()
                    ->required(),

                Select::make('ressources')
                    ->relationship('ressources', 'type')
                    ->multiple()
                    ->preload()
                    ->searchable()
                    ->label('Associer des ressources'),

                TextInput::make('titre')
                    ->required(),
                Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('duree')
                    ->required()
                    ->numeric(),
                Select::make('statut')
                    ->options([
                        'Brouillon' => 'Brouillon',
                        'Publié' => 'Publié',
                        'Archivé' => 'Archivé',
                    ])
                    ->required()
                    ->native(false),
                TextInput::make('ordreAffichage')
                    ->required()
                    ->numeric(),
                Select::make('typeActivite')
                    ->options(['Veille' => 'Veille', 'Atelier' => 'Atelier'])
                    ->required(),
                Select::make('typeLivrable')
                    ->options(['Lien' => 'Lien', 'Question' => 'Question'])
                    ->required(),
            ]);
    }
}
