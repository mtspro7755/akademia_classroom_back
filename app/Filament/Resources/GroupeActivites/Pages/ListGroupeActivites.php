<?php

namespace App\Filament\Resources\GroupeActivites\Pages;

use App\Filament\Resources\GroupeActivites\GroupeActiviteResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListGroupeActivites extends ListRecords
{
    protected static string $resource = GroupeActiviteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
