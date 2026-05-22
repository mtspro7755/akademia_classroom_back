<?php

namespace App\Filament\Resources\Livrables\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class LivrablesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('activite.quete.parcoursFormation.intitule')
                    ->label('Formation')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('apprenant.cohortes.nom')
                    ->label('Cohorte')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('activite.quete.titre')
                    ->label('Quête')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('apprenant.email')
                    ->label('Apprenant')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('activite.titre')
                    ->label('Activité')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('typeLivrable')
                    ->badge(),
                TextColumn::make('statutCorrection')
                    ->searchable(),
                TextColumn::make('dateSoumission')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('dureeEffectue')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('lienDuRepertoire')
                    ->searchable(),
                TextColumn::make('lienDeploye')
                    ->searchable(),
                TextColumn::make('dureeActivite')
                    ->label('Durée prévue')
                    ->numeric()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('estEnRetard')
                    ->label('En retard')
                    ->badge()
                    ->color(fn (bool $state): string => $state ? 'danger' : 'success')
                    ->formatStateUsing(fn (bool $state): string => $state ? 'Oui' : 'Non')
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('minutesRetard')
                    ->label('Retard (min)')
                    ->numeric()
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
