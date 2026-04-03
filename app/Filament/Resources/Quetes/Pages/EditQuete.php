<?php

namespace App\Filament\Resources\Quetes\Pages;

use App\Filament\Resources\Quetes\QueteResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditQuete extends EditRecord
{
    protected static string $resource = QueteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
