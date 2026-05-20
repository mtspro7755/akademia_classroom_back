<?php

namespace App\Filament\Resources\Cohortes\RelationManagers;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ParcoursFormationRelationManager extends RelationManager
{
    protected static string $relationship = 'parcoursFormation';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('intitule')
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nom')
            ->columns([
                TextColumn::make('intitule')
                    ->searchable(),
                TextColumn::make('type')
                    ->label('Type de parcours')
                    ->badge()
                    ->color(fn (string $state): string => match($state) {
                        'Solo' => 'success',
                        'Group' => 'info',
                    })
                    ->sortable(),
                TextColumn::make('apprenants_count')
                    ->label('Apprenants inscrits')
                    ->sortable(),
                TextColumn::make('statut')
                    ->label('Statut du Parcours')
                    ->badge()
                    ->color(fn (string $state): string => match($state) {
                        'Actif' => 'success',
                        'Inactif' => 'warning',
                        'Archivé' => 'danger',
                    })
                    ->sortable(),
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
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
