<?php

namespace App\Filament\Resources\Apprenants\Pages;

use App\Filament\Resources\Apprenants\ApprenantResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditApprenant extends EditRecord
{
    protected static string $resource = ApprenantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
