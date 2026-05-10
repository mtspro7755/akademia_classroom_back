<?php

namespace App\Filament\Resources\Paiements\RelationManagers;

use App\Filament\Resources\Candidatures\CandidatureResource;
use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class CandidaturesRelationManager extends RelationManager
{
    protected static string $relationship = 'candidature';

    protected static ?string $relatedResource = CandidatureResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('statut')
                    ->label('Statut')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match($state) {
                        'en_attente' => 'En attente',
                        'acceptee' => 'Acceptée',
                        'rejetee' => 'Rejetée',
                        default => $state,
                    })
                    ->color(fn (string $state): string => match($state) {
                        'en_attente' => 'warning',
                        'acceptee' => 'success',
                        'rejetee' => 'danger',
                        default => 'gray',
                    }),
                TextColumn::make('apprenant.nomComplet')
                    ->label('Apprenant')
                    ->searchable()
                    ->placeholder('-'),
                TextColumn::make('created_at')
                    ->label('Date de candidature')
                    ->dateTime()
                    ->sortable()
                    ->placeholder('-'),
                TextColumn::make('updated_at')
                    ->label('Dernière modification')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->placeholder('-'),
            ])
            ->headerActions([
                CreateAction::make()
                    ->mutateFormDataUsing(function (array $data): array {
                        $paiement = $this->getOwnerRecord();
                        $data['apprenant'] = $paiement->apprenant;
                        $data['cohorte'] = $paiement->cohorte;
                        return $data;
                    }),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}
