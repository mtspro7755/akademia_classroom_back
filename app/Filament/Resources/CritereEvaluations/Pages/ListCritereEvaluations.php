<?php

namespace App\Filament\Resources\CritereEvaluations\Pages;

use App\Filament\Resources\CritereEvaluations\CritereEvaluationResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCritereEvaluations extends ListRecords
{
    protected static string $resource = CritereEvaluationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
