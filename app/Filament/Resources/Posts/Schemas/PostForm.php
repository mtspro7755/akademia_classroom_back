<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('apprenant_id')
                    ->relationship('apprenant', 'email')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('thematique_id')
                    ->relationship('thematique', 'titre')
                    ->searchable()
                    ->preload()
                    ->required(),
                Textarea::make('contenu')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('description')
                    ->default(null)
                    ->columnSpanFull(),
                Select::make('parent_post_id')
                    ->label('Répondre à')
                    ->relationship('parent', 'contenu')
                    ->searchable()
                    ->placeholder('Laisser vide si c\'est un nouveau sujet'),
                Select::make('typePost')
                    ->options(['Question' => 'Question', 'Reponse' => 'Reponse'])
                    ->required(),
            ]);
    }
}
