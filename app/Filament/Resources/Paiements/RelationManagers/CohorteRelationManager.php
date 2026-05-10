<?php

namespace App\Filament\Resources\Paiements\RelationManagers;

use App\Filament\Resources\Cohortes\CohorteResource;
use Filament\Actions\AttachAction;
use Filament\Actions\DetachAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DetachBulkAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class CohorteRelationManager extends RelationManager
{
    protected static string $relationship = 'cohorte';

    protected static ?string $relatedResource = CohorteResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nom')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('capaciteMax')
                    ->label('Capacité max')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('statut')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match($state) {
                        'EnAttente' => 'En attente',
                        'EnCours' => 'En cours',
                        'Termine' => 'Terminé',
                        default => $state,
                    })
                    ->color(fn (string $state): string => match($state) {
                        'EnAttente' => 'warning',
                        'EnCours' => 'info',
                        'Termine' => 'success',
                        default => 'gray',
                    }),
                TextColumn::make('dateDebut')
                    ->label('Date de début')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('dateFin')
                    ->label('Date de fin')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('prix')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->headerActions([
                AttachAction::make()
                    ->recordSelectSearchColumns(['nom'])
                    ->preloadRecordSelect(),
            ])
            ->actions([
                DetachAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DetachBulkAction::make(),
                ]),
            ]);
    }
}
