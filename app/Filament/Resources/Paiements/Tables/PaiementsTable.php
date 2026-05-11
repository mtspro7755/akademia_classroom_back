<?php

namespace App\Filament\Resources\Paiements\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PaiementsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('candidature.statut')
                    ->searchable()
                    ->placeholder('-'),
                TextColumn::make('montant')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('devise')
                    ->searchable(),
                TextColumn::make('moyenPaiement')
                    ->badge(),
                TextColumn::make('telephone')
                    ->searchable(),
                TextColumn::make('referenceTransaction')
                    ->searchable(),
                TextColumn::make('statut')
                    ->badge(),
                TextColumn::make('datePaiement')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('apprenant.nomComplet')
                    ->searchable()
                    ->placeholder('-'),
                TextColumn::make('cohorte.nom')
                    ->searchable()
                    ->placeholder('-'),
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
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
