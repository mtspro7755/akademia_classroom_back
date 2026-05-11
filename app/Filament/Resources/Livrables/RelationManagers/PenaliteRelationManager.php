<?php

namespace App\Filament\Resources\Livrables\RelationManagers;

use App\Models\Penalite;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class PenaliteRelationManager extends RelationManager
{
    protected static string $relationship = 'penalites';

    protected static ?string $recordTitleAttribute = 'penalite';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\Select::make('apprenant_id')
                    ->relationship('apprenant', 'nom')
                    ->searchable()
                    ->preload()
                    ->label('Apprenant')
                    ->required(),
                Forms\Components\TextInput::make('dureeInitial')
                    ->label('Durée initiale (jours)')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('tempsDeRetard')
                    ->label('Temps de retard (jours)')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('penalite')
                    ->label('Pénalité')
                    ->numeric()
                    ->readOnly()
                    ->helperText('Calculée automatiquement: temps de retard × 10'),
                Forms\Components\Select::make('type_enum')
                    ->label('Type de pénalité')
                    ->options([
                        'retard' => 'Retard',
                        'absence' => 'Absence',
                        'autre' => 'Autre',
                    ])
                    ->required(),
                Forms\Components\Textarea::make('justificatif')
                    ->label('Justificatif')
                    ->rows(3),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('penalite')
            ->columns([
                Tables\Columns\TextColumn::make('apprenant.nom')
                    ->label('Apprenant')
                    ->searchable(),
                Tables\Columns\TextColumn::make('dureeInitial')
                    ->label('Durée initiale')
                    ->suffix(' jours'),
                Tables\Columns\TextColumn::make('tempsDeRetard')
                    ->label('Temps de retard')
                    ->suffix(' jours'),
                Tables\Columns\TextColumn::make('penalite')
                    ->label('Pénalité')
                    ->money('XOF')
                    ->badge()
                    ->color('danger'),
                Tables\Columns\TextColumn::make('type_enum')
                    ->label('Type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'retard' => 'warning',
                        'absence' => 'danger',
                        'autre' => 'gray',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Date')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type_enum')
                    ->label('Type de pénalité')
                    ->options([
                        'retard' => 'Retard',
                        'absence' => 'Absence',
                        'autre' => 'Autre',
                    ]),
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
