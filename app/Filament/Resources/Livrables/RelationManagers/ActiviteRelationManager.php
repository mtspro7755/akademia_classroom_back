<?php

namespace App\Filament\Resources\Livrables\RelationManagers;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ActiviteRelationManager extends RelationManager
{
    protected static string $relationship = 'activite';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('quete_id')
                    ->required()
                    ->numeric(),
                TextInput::make('titre')
                    ->required(),
                Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('duree')
                    ->required()
                    ->numeric(),
                TextInput::make('statut')
                    ->required(),
                TextInput::make('ordreAffichage')
                    ->required()
                    ->numeric(),
                Select::make('typeActivite')
                    ->options(['Veille' => 'Veille', 'Atelier' => 'Atelier'])
                    ->required(),
                Select::make('typeLivrable')
                    ->options(['Lien' => 'Lien', 'Question' => 'Question'])
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('titre')
            ->columns([
                TextColumn::make('quete_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('titre')
                    ->searchable(),
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
