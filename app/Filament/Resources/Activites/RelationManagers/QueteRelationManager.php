<?php

namespace App\Filament\Resources\Activites\RelationManagers;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class QueteRelationManager extends RelationManager
{
    protected static string $relationship = 'quete';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('titre')
                    ->required(),
                Select::make('statut')
                    ->options(['Actif' => 'Actif', 'Inactif' => 'Inactif'])
                    ->required(),
                DatePicker::make('dateDebut')
                    ->required(),
                DatePicker::make('dateLimite')
                    ->required(),
                TextInput::make('niveauDifficulte')
                    ->required()
                    ->numeric(),
                TextInput::make('parcours_formation_id')
                    ->required()
                    ->numeric(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('titre')
            ->columns([
                TextColumn::make('titre')
                    ->searchable(),
                TextColumn::make('statut')
                    ->badge(),
                TextColumn::make('dateDebut')
                    ->date()
                    ->sortable(),
                TextColumn::make('dateLimite')
                    ->date()
                    ->sortable(),
                TextColumn::make('niveauDifficulte')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('parcours_formation_id')
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
