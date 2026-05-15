<?php

namespace App\Filament\Resources\GroupeActivites\Pages;

use App\Filament\Resources\GroupeActivites\GroupeActiviteResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditGroupeActivite extends EditRecord
{
    protected static string $resource = GroupeActiviteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
