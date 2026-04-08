<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class PostInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('apprenant.email')
                    ->label('Posté par'),

                TextEntry::make('thematique.titre')
                    ->label('Thématique'),

                TextEntry::make('contenu')
                    ->markdown()
                    ->columnSpanFull(),
                TextEntry::make('description')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('parent.contenu')
                    ->label('Réponse au message')
                    ->placeholder('Aucun (Ceci est le post racine)'),
                TextEntry::make('typePost')
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
