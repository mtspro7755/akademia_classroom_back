<?php

namespace App\Filament\Resources\Candidatures\RelationManagers;

use App\Filament\Resources\Paiements\PaiementResource;
use Filament\Actions\CreateAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class PaiementsRelationManager extends RelationManager
{
    protected static string $relationship = 'paiements';

    protected static ?string $relatedResource = PaiementResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                CreateAction::make()
                    ->mutateFormDataUsing(function (array $data): array {
                        $candidature = $this->getOwnerRecord();
                        $data['candidature_id'] = $candidature->id;
                        $data['apprenant_id'] = $candidature->apprenant_id;

                        // Si la candidature est liée à une cohorte, la récupérer
                        if ($candidature->apprenant && $candidature->apprenant->cohortes()->exists()) {
                            $data['cohorte_id'] = $candidature->apprenant->cohortes()->first()->id;
                        }

                        return $data;
                    }),
            ]);
    }
}
