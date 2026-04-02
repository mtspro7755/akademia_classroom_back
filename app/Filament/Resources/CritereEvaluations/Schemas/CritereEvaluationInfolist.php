<?php

namespace App\Filament\Resources\CritereEvaluations\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class CritereEvaluationInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('activite_id')
                    ->numeric(),
                TextEntry::make('critere')
                    ->columnSpanFull(),
                TextEntry::make('question')
                    ->columnSpanFull(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('point')
                    ->numeric(),
            ]);
    }
}
