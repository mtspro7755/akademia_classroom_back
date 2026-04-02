<?php

namespace App\Filament\Resources\Thematiques\Pages;

use App\Filament\Resources\Thematiques\ThematiqueResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditThematique extends EditRecord
{
    protected static string $resource = ThematiqueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
