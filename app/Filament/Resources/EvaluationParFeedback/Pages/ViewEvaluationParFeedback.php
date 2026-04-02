<?php

namespace App\Filament\Resources\EvaluationParFeedback\Pages;

use App\Filament\Resources\EvaluationParFeedback\EvaluationParFeedbackResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewEvaluationParFeedback extends ViewRecord
{
    protected static string $resource = EvaluationParFeedbackResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
