<?php

namespace App\Filament\Resources\Penalites\Pages;

use App\Filament\Resources\Penalites\PenaliteResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPenalites extends ListRecords
{
    protected static string $resource = PenaliteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
