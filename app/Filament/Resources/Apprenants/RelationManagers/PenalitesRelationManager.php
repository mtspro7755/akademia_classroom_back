<?php

namespace App\Filament\Resources\Apprenants\RelationManagers;

use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PenalitesRelationManager extends RelationManager
{
    protected static string $relationship = 'penalites';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('dureeInitial')
                    ->required()
                    ->numeric(),
                TextInput::make('tempsDeRetard')
                    ->required()
                    ->numeric(),
                TextInput::make('penalite')
                    ->required()
                    ->numeric(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('penalite')
            ->columns([
                TextColumn::make('dureeInitial')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('tempsDeRetard')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('penalite')
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
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
                AssociateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DissociateAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DissociateBulkAction::make(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
