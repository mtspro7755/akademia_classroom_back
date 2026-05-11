<?php

namespace App\Filament\Resources\Cohortes\RelationManagers;

use App\Filament\Resources\Paiements\PaiementResource;
use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class PaiementsRelationManager extends RelationManager
{
    protected static string $relationship = 'paiements';

    protected static ?string $relatedResource = PaiementResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('apprenant.nomComplet')
                    ->label('Apprenant')
                    ->searchable()
                    ->placeholder('-'),
                TextColumn::make('montant')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('devise')
                    ->searchable(),
                TextColumn::make('moyenPaiement')
                    ->badge(),
                TextColumn::make('statut')
                    ->badge(),
                TextColumn::make('datePaiement')
                    ->dateTime()
                    ->sortable()
                    ->placeholder('-'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->headerActions([
                CreateAction::make()
                    ->mutateFormDataUsing(function (array $data): array {
                        $cohorte = $this->getOwnerRecord();
                        $data['cohorte_id'] = $cohorte->id;
                        return $data;
                    }),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}
