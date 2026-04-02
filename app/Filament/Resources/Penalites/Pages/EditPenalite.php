<?php

namespace App\Filament\Resources\Penalites\Pages;

use App\Filament\Resources\Penalites\PenaliteResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditPenalite extends EditRecord
{
    protected static string $resource = PenaliteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
