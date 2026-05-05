<?php

namespace App\Filament\Resources\Apprenants\RelationManagers;

use App\Models\Quete;
use Filament\Actions\AttachAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DetachAction;
use Filament\Actions\DetachBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class QuetesRelationManager extends RelationManager
{
    protected static string $relationship = 'quetes';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('statut')
                    ->options([
                        'EnCours' => 'En cours',
                        'Termine' => 'Terminée',
                    ])
                    ->default('EnCours')
                    ->required(),
                TextInput::make('dureeEffective')
                    ->label('Durée effective (heures)')
                    ->numeric(),
                DatePicker::make('dateSoumission')
                    ->label('Date de soumission'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('titre')
            ->columns([
                TextColumn::make('titre')->searchable(),
                TextColumn::make('niveauDifficulte')->badge(),
                // Affichage des données pivot
                TextColumn::make('pivot.statut')
                    ->label('État')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'EnCours' => 'warning',
                        'Termine' => 'success',
                        default => 'gray',
                    }),
                TextColumn::make('pivot.dateSoumission')
                    ->label('Soumise le')
                    ->date(),
            ])
            ->headerActions([
                AttachAction::make()
                    ->preloadRecordSelect()
                    ->form(fn (AttachAction $action): array => [
                        $action->getRecordSelect(),
                        Select::make('statut')
                            ->options(['EnCours' => 'En cours', 'Termine' => 'Terminée'])
                            ->default('EnCours')
                            ->required(),
                    ])
                    ->before(function (AttachAction $action, $livewire, array $data) {
                        $apprenant = $livewire->ownerRecord;

                        if (!$apprenant) {
                            $action->halt();
                            return;
                        }


                        $dejaInscrit = $apprenant->quetes()
                            ->where('quete_id', $data['recordId'])
                            ->exists();

                        if ($dejaInscrit) {
                            Notification::make()
                                ->danger()
                                ->title('Action impossible')
                                ->body('Cet apprenant est déjà inscrit à cette quête.')
                                ->send();

                            $action->halt();
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
