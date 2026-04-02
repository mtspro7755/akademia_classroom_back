<?php

namespace App\Filament\Resources\Ressources\Pages;

use App\Filament\Resources\Ressources\RessourceResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditRessource extends EditRecord
{
    protected static string $resource = RessourceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
