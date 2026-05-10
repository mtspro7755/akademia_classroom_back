<?php

namespace App\Filament\Resources\Paiements\RelationManagers;

use App\Filament\Resources\Apprenants\ApprenantResource;
use Filament\Actions\AttachAction;
use Filament\Actions\DetachAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DetachBulkAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class ApprenantRelationManager extends RelationManager
{
    protected static string $relationship = 'apprenant';

    protected static ?string $relatedResource = ApprenantResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nomComplet')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('phone')
                    ->searchable(),
                TextColumn::make('role')
                    ->badge(),
                TextColumn::make('statutCompte')
                    ->badge()
                    ->formatStateUsing(fn (bool $state): string => $state ? 'Actif' : 'Inactif'),
            ])
            ->headerActions([
                AttachAction::make()
                    ->recordSelectSearchColumns(['nomComplet', 'email'])
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
