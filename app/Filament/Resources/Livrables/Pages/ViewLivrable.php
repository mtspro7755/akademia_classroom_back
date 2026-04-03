<?php

namespace App\Filament\Resources\Livrables\Pages;

use App\Filament\Resources\Livrables\LivrableResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewLivrable extends ViewRecord
{
    protected static string $resource = LivrableResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
