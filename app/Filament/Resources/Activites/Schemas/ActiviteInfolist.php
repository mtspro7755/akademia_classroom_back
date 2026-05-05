<?php

namespace App\Filament\Resources\Activites\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ActiviteInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('quete.titre')
                    ->label('Quête associée')
                    ->weight('bold')
                    ->color('primary'),

                TextEntry::make('ressources.titre')
                    ->label('Ressource associée')
                    ->listWithLineBreaks()
                    ->bulleted()
                    ->placeholder('Aucune ressource associée')
                    ->weight('bold')
                    ->color('primary'),

                TextEntry::make('titre'),
                TextEntry::make('description')
                    ->columnSpanFull(),
                TextEntry::make('duree')
                    ->numeric(),
                TextEntry::make('statut'),
                TextEntry::make('ordreAffichage')
                    ->numeric(),
                TextEntry::make('typeActivite')
                    ->badge(),
                TextEntry::make('typeLivrable')
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
