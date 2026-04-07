<?php

namespace App\Filament\Resources\Activites\RelationManagers;

use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CriteresRelationManager extends RelationManager
{
    protected static string $relationship = 'criteres';

    protected static ?string $inverseRelationship = 'activite';

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            Textarea::make('critere')
                ->required()
                ->columnSpanFull(),

            Textarea::make('question')
                ->required()
                ->columnSpanFull(),

            TextInput::make('point')
                ->numeric()
                ->required()
                ->default(0),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('critere')
            ->columns([
                TextColumn::make('critere')->searchable(),

                TextColumn::make('point')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->toggleable(true),

                TextColumn::make('updated_at')
                    ->dateTime()
                    ->toggleable(true),
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
