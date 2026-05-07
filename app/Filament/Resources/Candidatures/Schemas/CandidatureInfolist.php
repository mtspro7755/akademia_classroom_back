<?php

namespace App\Filament\Resources\Candidatures\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class CandidatureInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('statut')
                    ->badge(),
                TextEntry::make('apprenant.nomComplet')
                    ->label('Apprenant')
                    ->weight('bold')
                    ->color('primary'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
