<?php

namespace App\Filament\Resources\Livrables\Pages;

use App\Filament\Resources\Livrables\LivrableResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListLivrables extends ListRecords
{
    protected static string $resource = LivrableResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
