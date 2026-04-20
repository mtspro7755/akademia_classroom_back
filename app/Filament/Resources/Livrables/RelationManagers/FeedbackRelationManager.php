<?php

namespace App\Filament\Resources\Livrables\RelationManagers;

use App\Models\Livrable;
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

class FeedbackRelationManager extends RelationManager
{
    protected static string $relationship = 'feedback';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('livrable_id')
                    ->label('Livrable concerné')
                    ->options(Livrable::all()->mapWithKeys(function ($livrable) {
                        return [$livrable->id => "{$livrable->typeLivrable} - {$livrable->activite->titre}"];
                    }))
                    ->searchable()
                    ->required(),

                Textarea::make('avisCritique')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('avisCritique')
            ->columns([
                TextColumn::make('livrable.type')
                    ->label('Type de rendu')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Lien' => 'success',
                        'Fichier' => 'info',
                        'Question' => 'warning',
                        default => 'gray',
                    })
                    ->sortable(),


                TextColumn::make('livrable.activite.titre')
                    ->label('Activité')
                    ->description(fn ($record) => "Parcours: " . $record->livrable->activite->quete->parcoursFormation->intitule)
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
