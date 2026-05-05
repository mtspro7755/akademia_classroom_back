<?php

namespace App\Filament\Resources\Apprenants\RelationManagers;

use Filament\Actions\AttachAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DetachAction;
use Filament\Actions\DetachBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CohortesRelationManager extends RelationManager
{
    protected static string $relationship = 'cohortes';

    public function form(Schema $schema): Schema
    {
        // On garde les champs de l'entité Cohorte pour l'édition/création
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
                    ->options([
                        'EnAttente' => 'En attente',
                        'EnCours' => 'En cours',
                        'Termine' => 'Terminé'
                    ])
                    ->required(),
                TextInput::make('prix')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('devise')
                    ->required()
                    ->default('XOF'),
                // Liaison vers ParcoursFormation selon ton MCD
                Select::make('parcours_formation_id')
                    ->relationship('parcoursFormation', 'intitule')
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nom')
            ->columns([
                TextColumn::make('nom')->searchable(),
                TextColumn::make('statut')->badge(),
                TextColumn::make('dateDebut')->date()->sortable(),
                TextColumn::make('dateFin')->date()->sortable(),
            ])
            ->headerActions([
                AttachAction::make()
                    ->preloadRecordSelect(),
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
                DetachAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DetachBulkAction::make(),
                ]),
            ]);
    }
}
