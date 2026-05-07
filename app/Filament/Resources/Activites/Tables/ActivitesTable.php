<?php

namespace App\Filament\Resources\Activites\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ActivitesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('quete.titre')
                    ->label('Quête')
                    ->searchable(['quetes.titre'])
                    ->sortable(),

                TextColumn::make('ressources.titre')
                    ->label('Ressource')
                    ->listWithLineBreaks()
                    ->bulleted()
                    ->searchable(['ressources.titre']),

                TextColumn::make('titre')
                    ->searchable(['activites.titre']),
                TextColumn::make('duree')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('statut')
                    ->searchable(),
                TextColumn::make('ordreAffichage')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('typeActivite')
                    ->badge(),
                TextColumn::make('typeLivrable')
                    ->badge(),
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
