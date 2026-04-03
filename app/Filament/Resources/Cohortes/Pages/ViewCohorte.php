<?php

namespace App\Filament\Resources\Cohortes\Pages;

use App\Filament\Resources\Cohortes\CohorteResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewCohorte extends ViewRecord
{
    protected static string $resource = CohorteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
