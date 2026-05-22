<?php

namespace App\Filament\Resources\Cohortes\RelationManagers;


use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use App\Models\Livrable;
use App\Filament\Resources\Livrables\Schemas\LivrableForm;
use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;

class LivrablesRelationManager extends RelationManager
{
    protected static string $relationship = 'apprenants';
    protected static ?string $title = 'Livrables';

    // 🎯 AJOUT DE LA MÉTHODE FORM (Se réfère à ton LivrableForm existant)
    public function form(Schema $schema): Schema
    {
        // On injecte directement la configuration propre qu'on a codée au début
        return LivrableForm::configure($schema);
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(fn () => Livrable::query()->whereHas('apprenant.cohortes', function ($q) {
                $q->where('cohorte_id', $this->getOwnerRecord()->id);
            }))
            ->columns([
                TextColumn::make('apprenant.nomComplet')
                    ->label('Apprenant')
                    ->searchable(),

                TextColumn::make('activite.titre')
                    ->label('Activité cible'),

                TextColumn::make('typeLivrable')
                    ->badge(),

                TextColumn::make('statutCorrection')
                    ->label('Statut')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Validé' => 'success',
                        'À corriger' => 'warning',
                        default => 'gray',
                    }),

                TextColumn::make('dateSoumission')
                    ->label('Soumis le')
                    ->dateTime(),
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}
