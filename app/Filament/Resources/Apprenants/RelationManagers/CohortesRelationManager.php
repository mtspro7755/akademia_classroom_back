<?php

namespace App\Filament\Resources\Apprenants\RelationManagers;

use App\Models\Cohorte;
use Filament\Actions\AttachAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DetachAction;
use Filament\Actions\DetachBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Notifications\Notification;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CohortesRelationManager extends RelationManager
{
    protected static string $relationship = 'cohortes';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nom')
                    ->required(),
                TextInput::make('capaciteMax')
                    ->required()
                    ->numeric(),
                DatePicker::make('dateDebut')
                    ->required(),
                DatePicker::make('dateFin')
                    ->required(),
                Select::make('statut')
                    ->options([
                        'EnAttente' => 'En attente',
                        'EnCours' => 'En cours',
                        'Termine' => 'Terminé'
                    ])
                    ->required(),
                TextInput::make('prix')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('devise')
                    ->required()
                    ->default('XOF'),
                Select::make('parcours_formation_id')
                    ->relationship('parcoursFormation', 'intitule')
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nom')
            ->columns([
                TextColumn::make('nom')->searchable(),
                TextColumn::make('statut')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'EnAttente' => 'gray',
                        'EnCours' => 'success',
                        'Termine' => 'info',
                    }),
                TextColumn::make('dateDebut')->date()->sortable(),
                TextColumn::make('dateFin')->date()->sortable(),
                TextColumn::make('apprenants_count')
                    ->counts('apprenants')
                    ->label('Inscrits'),
            ])
            ->headerActions([
                AttachAction::make()
                    ->preloadRecordSelect()
                    ->recordSelectSearchColumns(['nom'])
                    ->before(function (AttachAction $action, $livewire, array $data) {
                        // Récupération sécurisée de l'apprenant (le parent de la relation)
                        $apprenant = $livewire->ownerRecord;

                        if (! $apprenant) {
                            Notification::make()
                                ->danger()
                                ->title('Erreur système')
                                ->body('Impossible de retrouver les données de l\'apprenant.')
                                ->send();
                            $action->halt();
                            return;
                        }

                        $existeActive = $apprenant->cohortes()
                            ->where('statut', 'EnCours')
                            ->exists();

                        if ($existeActive) {
                            Notification::make()
                                ->danger()
                                ->title('Action impossible')
                                ->body('Cet apprenant est déjà inscrit dans une cohorte active.')
                                ->send();

                            $action->halt();
                        }

                        $cohorteId = $data['recordId'] ?? null;
                        if ($cohorteId) {
                            $cohorte = Cohorte::find($cohorteId);

                            if ($cohorte && $cohorte->apprenants()->count() >= $cohorte->capaciteMax) {
                                Notification::make()
                                    ->danger()
                                    ->title('Capacité atteinte')
                                    ->body("La cohorte '{$cohorte->nom}' est déjà complète ({$cohorte->capaciteMax} places).")
                                    ->send();

                                $action->halt();
                            }
                        }
                    }),
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
                DetachAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DetachBulkAction::make(),
                ]),
            ]);
    }
}
