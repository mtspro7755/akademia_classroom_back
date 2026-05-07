<?php

namespace App\Filament\Resources\Livrables\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class LivrableInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('apprenant.email')
                    ->label('Soumis par (Email)'),

                TextEntry::make('activite.titre')
                    ->label('Pour l\'activité'),
                TextEntry::make('typeLivrable')
                    ->badge(),
                TextEntry::make('statutCorrection')
                    ->placeholder('-'),
                TextEntry::make('dateSoumission')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('dureeEffectue')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('lienDuRepertoire')
                    ->placeholder('-'),
                TextEntry::make('lienDeploye')
                    ->placeholder('-'),
                TextEntry::make('dureeActivite')
                    ->label('Durée prévue de l\'activité')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('estEnRetard')
                    ->label('En retard')
                    ->badge()
                    ->color(fn (bool $state): string => $state ? 'danger' : 'success')
                    ->formatStateUsing(fn (bool $state): string => $state ? 'Oui' : 'Non')
                    ->placeholder('-'),
                TextEntry::make('minutesRetard')
                    ->label('Minutes de retard')
                    ->numeric()
                    ->placeholder('-'),
            ]);
    }
}
