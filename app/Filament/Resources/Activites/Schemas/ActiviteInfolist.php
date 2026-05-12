<?php

namespace App\Filament\Resources\Activites\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ActiviteInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Informations générales
                TextEntry::make('quete.parcoursFormation.intitule')
                    ->label('Parcours de Formation')
                    ->badge()
                    ->color('primary'),

                TextEntry::make('quete.titre')
                    ->label('Quête associée')
                    ->weight('bold')
                    ->color('success'),

                TextEntry::make('titre')
                    ->label('Activité')
                    ->formatStateUsing(function (string $state, $record): string {
                        $typeIcon = $record->typeActivite === 'Veille' ? '🔍' : '🛠️';
                        return "{$typeIcon} {$state}";
                    })
                    ->weight('semibold'),

                TextEntry::make('description')
                    ->label('Description')
                    ->markdown(),

                // Détails de l'activité
                TextEntry::make('typeActivite')
                    ->label('Type d\'activité')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Veille' => 'info',
                        'Atelier' => 'warning',
                    }),

                TextEntry::make('duree')
                    ->label('Durée (heures)')
                    ->numeric()
                    ->suffix(' h'),

                TextEntry::make('modaliteTravail')
                    ->label('Modalité de travail')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'individuel' => 'success',
                        'collectif' => 'primary',
                    }),

                TextEntry::make('statut')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Brouillon' => 'gray',
                        'Publié' => 'success',
                        'Archivé' => 'danger',
                    }),

                TextEntry::make('ordreAffichage')
                    ->label('Ordre d\'affichage')
                    ->numeric(),

                TextEntry::make('typeLivrable')
                    ->label('Type de livrable')
                    ->badge()
                    ->color('secondary'),

                // Métadonnées
                TextEntry::make('created_at')
                    ->label('Date de création')
                    ->dateTime('d/m/Y H:i')
                    ->placeholder('-'),

                TextEntry::make('updated_at')
                    ->label('Dernière modification')
                    ->dateTime('d/m/Y H:i')
                    ->placeholder('-'),
            ]);
    }
}
