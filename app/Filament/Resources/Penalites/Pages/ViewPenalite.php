<?php

namespace App\Filament\Resources\Penalites\Pages;

use App\Filament\Resources\Penalites\PenaliteResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewPenalite extends ViewRecord
{
    protected static string $resource = PenaliteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
