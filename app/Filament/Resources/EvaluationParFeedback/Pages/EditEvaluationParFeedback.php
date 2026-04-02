<?php

namespace App\Filament\Resources\EvaluationParFeedback\Pages;

use App\Filament\Resources\EvaluationParFeedback\EvaluationParFeedbackResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditEvaluationParFeedback extends EditRecord
{
    protected static string $resource = EvaluationParFeedbackResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
