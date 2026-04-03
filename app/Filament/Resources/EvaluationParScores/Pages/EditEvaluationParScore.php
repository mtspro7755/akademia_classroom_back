<?php

namespace App\Filament\Resources\EvaluationParScores\Pages;

use App\Filament\Resources\EvaluationParScores\EvaluationParScoreResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditEvaluationParScore extends EditRecord
{
    protected static string $resource = EvaluationParScoreResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
