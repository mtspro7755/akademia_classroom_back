<?php

namespace App\Filament\Resources\Thematiques\Pages;

use App\Filament\Resources\Thematiques\ThematiqueResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewThematique extends ViewRecord
{
    protected static string $resource = ThematiqueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
