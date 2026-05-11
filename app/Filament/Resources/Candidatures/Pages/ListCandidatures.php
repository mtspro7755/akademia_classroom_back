<?php

namespace App\Filament\Resources\Candidatures\Pages;

use App\Filament\Resources\Candidatures\CandidatureResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCandidatures extends ListRecords
{
    protected static string $resource = CandidatureResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
