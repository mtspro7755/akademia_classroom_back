<?php

namespace App\Filament\Resources\CritereEvaluations\Pages;

use App\Filament\Resources\CritereEvaluations\CritereEvaluationResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditCritereEvaluation extends EditRecord
{
    protected static string $resource = CritereEvaluationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
