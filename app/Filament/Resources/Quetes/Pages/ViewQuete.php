<?php

namespace App\Filament\Resources\Quetes\Pages;

use App\Filament\Resources\Quetes\QueteResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewQuete extends ViewRecord
{
    protected static string $resource = QueteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
