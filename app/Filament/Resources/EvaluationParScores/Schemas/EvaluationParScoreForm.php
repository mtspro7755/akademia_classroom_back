<?php

namespace App\Filament\Resources\EvaluationParScores\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class EvaluationParScoreForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('livrable_id')
                    ->required()
                    ->numeric(),
                TextInput::make('critere_evaluation_id')
                    ->required()
                    ->numeric(),
                TextInput::make('score')
                    ->required()
                    ->numeric(),
                Textarea::make('commentaire')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
