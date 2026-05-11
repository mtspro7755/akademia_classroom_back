<?php

namespace App\Filament\Resources\CanalDeDiscussions\RelationManagers;

use App\Models\Message;
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

class MessagesRelationManager extends RelationManager
{
    protected static string $relationship = 'messages';

    protected static ?string $recordTitleAttribute = 'contenu';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\Textarea::make('contenu')
                    ->required()
                    ->label('Contenu du message')
                    ->rows(3),
                Forms\Components\Select::make('apprenant_id')
                    ->relationship('apprenant', 'nom')
                    ->searchable()
                    ->preload()
                    ->label('Apprenant')
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('contenu')
            ->columns([
                Tables\Columns\TextColumn::make('contenu')
                    ->label('Contenu')
                    ->limit(50)
                    ->searchable(),
                Tables\Columns\TextColumn::make('apprenant.nom')
                    ->label('Apprenant')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Date')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                //
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
