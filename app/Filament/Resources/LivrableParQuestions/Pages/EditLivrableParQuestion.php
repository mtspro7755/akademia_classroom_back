<?php

namespace App\Filament\Resources\LivrableParQuestions\Pages;

use App\Filament\Resources\LivrableParQuestions\LivrableParQuestionResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditLivrableParQuestion extends EditRecord
{
    protected static string $resource = LivrableParQuestionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
