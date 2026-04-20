<?php

namespace App\Filament\Resources\Livrables\RelationManagers;

use App\Models\Activite;
use App\Models\ParcoursFormation;
use App\Models\Quete;
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
                Select::make('formation_id')
                    ->label('Formation')
                    ->options(ParcoursFormation::all()->pluck('intitule', 'id'))
                    ->searchable()
                    ->live()
                    ->afterStateUpdated(fn ($set) => $set('quete_id', null)), // Suppression du typage Set pour sécurité

                Select::make('quete_id')
                    ->label('Quête')
                    ->options(function ($get) {
                        $formationId = $get('formation_id');
                        if (!$formationId) return [];
                        return Quete::where('parcours_formation_id', $formationId)->pluck('titre', 'id');
                    })
                    ->live()
                    ->required()
                    ->afterStateUpdated(fn ($set) => $set('activite_id', null)),


                Select::make('activite_id')
                ->label('Activité cible')
                    ->options(function ($get) {
                        $queteId = $get('quete_id');
                        if (!$queteId) return [];
                        return Activite::where('quete_id', $queteId)->pluck('titre', 'id');
                    })
                    ->required()
                    ->searchable(),

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
                // Affichage du Parcours de Formation (via la relation Quete)
                TextColumn::make('quete.parcoursFormation.intitule')
                    ->label('Parcours')
                    ->sortable()
                    ->searchable(),

                // Affichage du Titre de la Quête au lieu de l'ID numérique
                TextColumn::make('quete.titre')
                    ->label('Quête')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('titre')
                    ->label('Activité')
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
                    ->badge()
                    ->color('info'),

                TextColumn::make('typeLivrable')
                    ->badge()
                    ->color('warning'),

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
