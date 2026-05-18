<?php

namespace App\Filament\Resources\GroupeActivites\Pages;

use App\Filament\Resources\GroupeActivites\GroupeActiviteResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewGroupeActivite extends ViewRecord
{
    protected static string $resource = GroupeActiviteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
