<?php

namespace App\Filament\Resources\Livrables\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class LivrablesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('apprenant_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('activite_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('typeLivrable')
                    ->badge(),
                TextColumn::make('statutCorrection')
                    ->searchable(),
                TextColumn::make('dateSoumission')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('dureeEffectue')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('lienDuRepertoire')
                    ->searchable(),
                TextColumn::make('lienDeploye')
                    ->searchable(),
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
