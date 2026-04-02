<?php

namespace App\Filament\Resources\Cohortes\Pages;

use App\Filament\Resources\Cohortes\CohorteResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCohortes extends ListRecords
{
    protected static string $resource = CohorteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
