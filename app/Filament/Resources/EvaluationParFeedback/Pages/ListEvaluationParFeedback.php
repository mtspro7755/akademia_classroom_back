<?php

namespace App\Filament\Resources\EvaluationParFeedback\Pages;

use App\Filament\Resources\EvaluationParFeedback\EvaluationParFeedbackResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListEvaluationParFeedback extends ListRecords
{
    protected static string $resource = EvaluationParFeedbackResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
