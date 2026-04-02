<?php

namespace App\Filament\Resources\Ressources\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class RessourceInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('type')
                    ->badge(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
