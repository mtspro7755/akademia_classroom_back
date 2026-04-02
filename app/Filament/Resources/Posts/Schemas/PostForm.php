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
                TextInput::make('apprenant_id')
                    ->required()
                    ->numeric(),
                TextInput::make('thematique_id')
                    ->required()
                    ->numeric(),
                Textarea::make('contenu')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('description')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('parent_post_id')
                    ->numeric()
                    ->default(null),
                Select::make('typePost')
                    ->options(['Question' => 'Question', 'Reponse' => 'Reponse'])
                    ->required(),
            ]);
    }
}
