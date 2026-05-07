<?php

namespace App\Filament\Resources\ParcoursFormations\Pages;

use App\Filament\Resources\ParcoursFormations\ParcoursFormationResource;
use Filament\Actions\Action;
use Filament\Resources\Pages\ViewRecord;

class ViewParcoursFormation extends ViewRecord
{
    protected static string $resource = ParcoursFormationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('edit')
                ->url(fn ($record): string => route('filament.admin.resources.parcours-formations.edit', ['record' => $record]))
                ->icon('heroicon-o-pencil-square'),
        ];
    }
}
