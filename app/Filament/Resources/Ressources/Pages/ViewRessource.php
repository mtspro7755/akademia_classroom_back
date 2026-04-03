<?php

namespace App\Filament\Resources\Ressources\Pages;

use App\Filament\Resources\Ressources\RessourceResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewRessource extends ViewRecord
{
    protected static string $resource = RessourceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
