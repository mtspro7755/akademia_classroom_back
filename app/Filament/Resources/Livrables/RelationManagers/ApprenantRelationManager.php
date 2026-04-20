<?php

namespace App\Filament\Resources\Livrables\RelationManagers;

use App\Models\Profil;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ApprenantRelationManager extends RelationManager
{
    protected static string $relationship = 'apprenant';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nomComplet')
                    ->required()
                    ->maxLength(255),

                TextInput::make('email')
                    ->label('Adresse Email')
                    ->email()
                    ->required()
                    ->unique(ignoreRecord: true),

                TextInput::make('phone')
                    ->label('Téléphone')
                    ->tel()
                    ->required(),

                TextInput::make('password')
                    ->label('Mot de passe')
                    ->password()
                    ->required(fn ($livewire) => $livewire instanceof CreateAction)
                    ->dehydrated(fn ($state) => filled($state)),

                TextInput::make('pseudo')
                    ->default(null),


                Select::make('role')
                    ->options([
                        'Apprenant' => 'apprenant',
                        'Formateur' => 'formateur',
                    ])
                    ->required()
                    ->native(false),

                Toggle::make('statutCompte')
                    ->label('Compte Actif')
                    ->default(true)
                    ->required(),


                Select::make('profil_id')
                    ->label('Type de Profil')
                    ->options(Profil::all()->pluck('typeProfil', 'id'))
                    ->searchable()
                    ->preload()
                    ->default(null),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nomComplet')
            ->columns([
                TextColumn::make('nomComplet')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),

                TextColumn::make('role')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Formateur' => 'info',
                        'Apprenant' => 'success',
                        default => 'gray',
                    }),

                TextColumn::make('profil.typeProfil')
                    ->label('Profil')
                    ->placeholder('Aucun profil')
                    ->sortable(),

                IconColumn::make('statutCompte')
                    ->label('Actif')
                    ->boolean()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Inscrit le')
                    ->dateTime('d/m/Y')
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
