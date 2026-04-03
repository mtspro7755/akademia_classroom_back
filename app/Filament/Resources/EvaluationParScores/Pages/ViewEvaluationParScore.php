<?php

namespace App\Filament\Resources\EvaluationParScores\Pages;

use App\Filament\Resources\EvaluationParScores\EvaluationParScoreResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewEvaluationParScore extends ViewRecord
{
    protected static string $resource = EvaluationParScoreResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
