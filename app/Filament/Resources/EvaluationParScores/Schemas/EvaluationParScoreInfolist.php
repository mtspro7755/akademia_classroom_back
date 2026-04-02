<?php

namespace App\Filament\Resources\EvaluationParScores\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class EvaluationParScoreInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('livrable_id')
                    ->numeric(),
                TextEntry::make('critere_evaluation_id')
                    ->numeric(),
                TextEntry::make('score')
                    ->numeric(),
                TextEntry::make('commentaire')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
