<?php

namespace App\Filament\Resources\ParcoursFormations\Pages;

use App\Filament\Resources\ParcoursFormations\ParcoursFormationResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewParcoursFormation extends ViewRecord
{
    protected static string $resource = ParcoursFormationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
