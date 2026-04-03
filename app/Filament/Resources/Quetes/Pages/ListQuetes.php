<?php

namespace App\Filament\Resources\Quetes\Pages;

use App\Filament\Resources\Quetes\QueteResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListQuetes extends ListRecords
{
    protected static string $resource = QueteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
