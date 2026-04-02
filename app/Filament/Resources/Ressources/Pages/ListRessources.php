<?php

namespace App\Filament\Resources\Ressources\Pages;

use App\Filament\Resources\Ressources\RessourceResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListRessources extends ListRecords
{
    protected static string $resource = RessourceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
