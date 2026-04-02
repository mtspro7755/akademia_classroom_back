<?php

namespace App\Filament\Resources\Livrables\Pages;

use App\Filament\Resources\Livrables\LivrableResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditLivrable extends EditRecord
{
    protected static string $resource = LivrableResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
