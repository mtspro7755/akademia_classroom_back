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
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
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
                    ->label('Durée initiale')
                    ->required()
                    ->numeric(),
                TextInput::make('tempsDeRetard')
                    ->label('Temps de retard')
                    ->required()
                    ->numeric(),
                TextInput::make('penalite')
                    ->label('Pénalité')
                    ->required()
                    ->numeric(),
                Select::make('type_enum')
                    ->label('Type')
                    ->options([
                        'activite' => 'Activité',
                        'quete' => 'Quête',
                    ])
                    ->required(),
                FileUpload::make('justificatif')
                    ->label('Justificatif (PDF)')
                    ->directory('justificatifs-penalites')
                    ->acceptedFileTypes(['application/pdf'])
                    ->nullable(),
                Select::make('livrable_id')
                    ->label('Livrable associé')
                    ->relationship('livrable', 'id')
                    ->searchable()
                    ->preload()
                    ->nullable(),
            ]);
    }

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('dureeInitial')
                    ->label('Durée initiale')
                    ->numeric(),
                TextEntry::make('tempsDeRetard')
                    ->label('Temps de retard')
                    ->numeric(),
                TextEntry::make('penalite')
                    ->label('Pénalité')
                    ->numeric(),
                TextEntry::make('type_enum')
                    ->label('Type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'activite' => 'info',
                        'quete' => 'warning',
                        default => 'gray',
                    }),
                TextEntry::make('justificatif')
                    ->label('Justificatif')
                    ->formatStateUsing(fn ($state) => $state ? 'PDF disponible' : 'Aucun')
                    ->placeholder('Aucun'),
                TextEntry::make('livrable.id')
                    ->label('Livrable associé')
                    ->placeholder('Non spécifié'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
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
                    ->label('Pénalité')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('type_enum')
                    ->label('Type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'activite' => 'info',
                        'quete' => 'warning',
                        default => 'gray',
                    }),
                TextColumn::make('justificatif')
                    ->label('Justificatif')
                    ->formatStateUsing(fn ($state) => $state ? 'PDF' : '-')
                    ->toggleable(),
                TextColumn::make('livrable.id')
                    ->label('Livrable ID')
                    ->sortable()
                    ->toggleable(),
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
