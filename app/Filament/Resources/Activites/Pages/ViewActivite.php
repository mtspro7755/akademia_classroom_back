<?php

namespace App\Filament\Resources\Activites\Pages;

use App\Filament\Resources\Activites\ActiviteResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewActivite extends ViewRecord
{
    protected static string $resource = ActiviteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
