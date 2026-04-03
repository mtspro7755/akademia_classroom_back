<?php

namespace App\Filament\Resources\Thematiques\Pages;

use App\Filament\Resources\Thematiques\ThematiqueResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListThematiques extends ListRecords
{
    protected static string $resource = ThematiqueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
