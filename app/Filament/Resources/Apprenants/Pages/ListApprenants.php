<?php

namespace App\Filament\Resources\Apprenants\Pages;

use App\Filament\Resources\Apprenants\ApprenantResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListApprenants extends ListRecords
{
    protected static string $resource = ApprenantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
