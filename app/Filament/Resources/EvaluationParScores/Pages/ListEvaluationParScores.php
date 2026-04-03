<?php

namespace App\Filament\Resources\EvaluationParScores\Pages;

use App\Filament\Resources\EvaluationParScores\EvaluationParScoreResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListEvaluationParScores extends ListRecords
{
    protected static string $resource = EvaluationParScoreResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
