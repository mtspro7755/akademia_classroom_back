<?php

namespace App\Filament\Resources\Cohortes\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class CohorteInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('nom'),
                TextEntry::make('capaciteMax')
                    ->numeric(),
                TextEntry::make('dateDebut')
                    ->date(),
                TextEntry::make('dateFin')
                    ->date(),
                TextEntry::make('statut')
                    ->badge(),
                TextEntry::make('parcours_formation_id')
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
