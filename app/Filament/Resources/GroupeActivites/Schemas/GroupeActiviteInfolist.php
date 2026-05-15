<?php

namespace App\Filament\Resources\GroupeActivites\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class GroupeActiviteInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('nom'),
                TextEntry::make('activite.titre')
                    ->label('Activité')
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
