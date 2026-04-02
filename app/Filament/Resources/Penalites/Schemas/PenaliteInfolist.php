<?php

namespace App\Filament\Resources\Penalites\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class PenaliteInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('dureeInitial')
                    ->numeric(),
                TextEntry::make('tempsDeRetard')
                    ->numeric(),
                TextEntry::make('penalite')
                    ->numeric(),
                TextEntry::make('apprenant_id')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
