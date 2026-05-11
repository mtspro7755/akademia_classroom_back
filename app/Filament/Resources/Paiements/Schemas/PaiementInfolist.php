<?php

namespace App\Filament\Resources\Paiements\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class PaiementInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('candidature.statut')
                    ->label('Candidature')
                    ->placeholder('-'),
                TextEntry::make('montant')
                    ->numeric(),
                TextEntry::make('devise'),
                TextEntry::make('moyenPaiement')
                    ->badge(),
                TextEntry::make('telephone'),
                TextEntry::make('referenceTransaction'),
                TextEntry::make('statut')
                    ->badge(),
                TextEntry::make('datePaiement')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('apprenant.nomComplet')
                    ->label('Apprenant')
                    ->placeholder('-'),
                TextEntry::make('cohorte.nom')
                    ->label('Cohorte')
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
