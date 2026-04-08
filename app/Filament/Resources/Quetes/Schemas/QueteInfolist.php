<?php

namespace App\Filament\Resources\Quetes\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class QueteInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('titre'),
                TextEntry::make('statut')
                    ->badge(),
                TextEntry::make('dateDebut')
                    ->date(),
                TextEntry::make('dateLimite')
                    ->date(),
                TextEntry::make('niveauDifficulte')
                    ->numeric(),
                TextEntry::make('parcoursFormation.intitule')
                    ->label('Parcours associé'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
