<?php

namespace App\Filament\Resources\ParcoursFormations\Pages;

use App\Filament\Resources\ParcoursFormations\ParcoursFormationResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditParcoursFormation extends EditRecord
{
    protected static string $resource = ParcoursFormationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
