<?php

namespace App\Filament\Resources\ParcoursFormations\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ParcoursFormationInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('intitule')
                    ->weight('bold')
                    ->size('lg'),
                TextEntry::make('type')
                    ->label('Type de parcours')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Solo' => 'success',
                        'Group' => 'info',
                        default => 'gray',
                    }),
                TextEntry::make('apprenants_count')
                    ->label('Apprenants inscrits')
                    ->getStateUsing(function ($record) {
                        return $record->cohortes()->withCount('apprenants')->get()->sum('apprenants_count');
                    })
                    ->badge()
                    ->color('info'),
                TextEntry::make('statut_global')
                    ->label('Statut du Parcours')
                    ->badge()
                    ->getStateUsing(function ($record) {
                        if ($record->cohortes()->where('statut', 'EnCours')->exists()) {
                            return 'EnCours';
                        }
                        if ($record->cohortes()->where('statut', 'EnAttente')->exists()) {
                            return 'EnAttente';
                        }
                        return 'Termine';
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'EnCours' => 'success',
                        'EnAttente' => 'warning',
                        'Termine' => 'gray',
                    })
                    ->icon(fn (string $state): string => match ($state) {
                        'EnCours' => 'heroicon-o-play-circle',
                        'EnAttente' => 'heroicon-o-clock',
                        'Termine' => 'heroicon-o-check-badge',
                    }),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
