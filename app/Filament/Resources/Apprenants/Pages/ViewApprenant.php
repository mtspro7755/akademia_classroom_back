<?php

namespace App\Filament\Resources\Apprenants\Pages;

use App\Filament\Resources\Apprenants\ApprenantResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewApprenant extends ViewRecord
{
    protected static string $resource = ApprenantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
