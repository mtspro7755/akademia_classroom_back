<?php

namespace App\Filament\Resources\ParcoursFormations\Pages;

use App\Filament\Resources\ParcoursFormations\ParcoursFormationResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListParcoursFormations extends ListRecords
{
    protected static string $resource = ParcoursFormationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
