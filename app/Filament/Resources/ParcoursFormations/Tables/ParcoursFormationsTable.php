<?php

namespace App\Filament\Resources\ParcoursFormations\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ParcoursFormationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('intitule')
                    ->searchable(),

                TextColumn::make('apprenants_count')
                    ->label('Apprenants inscrits')
                    ->getStateUsing(function ($record) {
                        return $record->cohortes()->withCount('apprenants')->get()->sum('apprenants_count');
                    })
                    ->badge()
                    ->color('info'),

                TextColumn::make('statut_global')
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

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
