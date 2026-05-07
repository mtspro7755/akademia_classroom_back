<?php

namespace App\Filament\Resources\Candidatures\Pages;

use App\Filament\Resources\Candidatures\CandidatureResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewCandidature extends ViewRecord
{
    protected static string $resource = CandidatureResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
