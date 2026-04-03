<?php

namespace App\Filament\Resources\LivrableParQuestions\Pages;

use App\Filament\Resources\LivrableParQuestions\LivrableParQuestionResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewLivrableParQuestion extends ViewRecord
{
    protected static string $resource = LivrableParQuestionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
