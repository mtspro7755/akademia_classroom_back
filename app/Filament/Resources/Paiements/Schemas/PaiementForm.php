<?php

namespace App\Filament\Resources\Paiements\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PaiementForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('candidature_id')
                    ->relationship('candidature', 'statut')
                    ->nullable(),
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
                    ->required(),
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
                Select::make('apprenant_id')
                    ->relationship('apprenant', 'nomComplet')
                    ->required(),
                Select::make('cohorte_id')
                    ->relationship('cohorte', 'nom')
                    ->required(),
            ]);
    }
}
