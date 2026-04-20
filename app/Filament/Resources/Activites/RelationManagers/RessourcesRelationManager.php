<?php

namespace App\Filament\Resources\Activites\RelationManagers;

use Filament\Actions\AttachAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DetachAction;
use Filament\Actions\DetachBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RessourcesRelationManager extends RelationManager
{
    protected static string $relationship = 'ressources';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('titre')
                ->required()
                    ->maxLength(255),

                Select::make('type')
                    ->options([
                        'lien' => 'Lien URL',
                        'pdf' => 'Fichier PDF',
                    ])
                    ->default('lien')
                    ->live()
                    ->required(),

                TextInput::make('contenu')
                    ->label('URL du lien')
                    ->url()
                    ->required()
                    ->visible(fn ($get) => $get('type') === 'lien'),

                FileUpload::make('contenu')
                    ->label('Fichier PDF')
                    ->directory('ressources-pedagogiques')
                    ->acceptedFileTypes(['application/pdf'])
                    ->required()
                    ->visible(fn ($get) => $get('type') === 'pdf'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('titre')
            ->columns([
                TextColumn::make('titre')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pdf' => 'danger',
                        'lien' => 'success',
                        default => 'gray',
                    }),
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
                AttachAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DetachAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DetachBulkAction::make(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
