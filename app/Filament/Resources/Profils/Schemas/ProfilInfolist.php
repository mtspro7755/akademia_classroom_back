<?php

namespace App\Filament\Resources\Profils\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ProfilInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('typeProfil')
                    ->badge(),
                TextEntry::make('description')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('niveauMinimal')
                    ->numeric(),
                TextEntry::make('niveauMaximal')
                    ->numeric(),
            ]);
    }
}
