<?php

namespace App\Filament\Resources\CritereEvaluations\Pages;

use App\Filament\Resources\CritereEvaluations\CritereEvaluationResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewCritereEvaluation extends ViewRecord
{
    protected static string $resource = CritereEvaluationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
