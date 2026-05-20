<?php

namespace App\Filament\Resources\ParcoursFormations\RelationManagers;

use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CohortesRelationManager extends RelationManager
{
    protected static string $relationship = 'cohortes';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nom')
                    ->required(),
                TextInput::make('capaciteMax')
                    ->required()
                    ->numeric(),
                DatePicker::make('dateDebut')
                    ->required(),
                DatePicker::make('dateFin')
                    ->required(),
                Select::make('statut')
                    ->options(['EnAttente' => 'En attente', 'EnCours' => 'En cours', 'Termine' => 'Termine'])
                    ->required(),
                TextInput::make('prix')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('devise')
                    ->required()
                    ->default('XOF'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nom')
            ->columns([
                TextColumn::make('nom')
                    ->searchable(),
                TextColumn::make('capaciteMax')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('dateDebut')
                    ->date()
                    ->sortable(),
                TextColumn::make('dateFin')
                    ->date()
                    ->sortable(),
                TextColumn::make('statut')
                    ->badge(),
                TextColumn::make('prix')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('devise')
                    ->searchable(),
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
