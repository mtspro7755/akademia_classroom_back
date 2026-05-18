<?php

namespace App\Filament\Resources\Paiements\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;

class PaiementForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('candidature_id')
                    ->label('Candidature de l\'apprenant')
                    ->relationship(
                        name: 'candidature',
                        titleAttribute: 'id',
                        // On utilise 'paiement' au singulier pour correspondre au modèle Candidature
                        modifyQueryUsing: fn (Builder $query) => $query->whereDoesntHave('paiement')
                    )
                    ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->apprenant->nomComplet} - Statut: {$record->statut}")
                    ->searchable()
                    ->preload()
                    ->live()
                    ->required(),

                Select::make('apprenant_id')
                    ->relationship('apprenant', 'nomComplet')
                    ->required(),

                TextInput::make('montant')
                    ->required()
                    ->numeric(),
                TextInput::make('devise')
                    ->required()
                    ->default('XOF'),
                Select::make('moyenPaiement')
                    ->options(['OM' => 'OM', 'Wave' => 'Wave'])
                    ->required(),
                TextInput::make('telephone')
                    ->tel()
                    ->required(),
                TextInput::make('referenceTransaction')
                    ->required()
                    ->unique(ignoreRecord: true),
                Select::make('statut')
                    ->options([
            'en_attente' => 'En attente',
            'confirme' => 'Confirme',
            'echoue' => 'Echoue',
            'rembourse' => 'Rembourse',
        ])
                    ->default('en_attente')
                    ->required(),
                DateTimePicker::make('datePaiement'),
                Select::make('cohorte_id')
                    ->relationship('cohorte', 'nom')
                    ->required(),
            ]);
    }
}
