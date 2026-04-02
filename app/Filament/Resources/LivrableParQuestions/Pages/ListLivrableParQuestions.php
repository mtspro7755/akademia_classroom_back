<?php

namespace App\Filament\Resources\LivrableParQuestions\Pages;

use App\Filament\Resources\LivrableParQuestions\LivrableParQuestionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListLivrableParQuestions extends ListRecords
{
    protected static string $resource = LivrableParQuestionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
