<?php

namespace App\Filament\Resources\CanalDeDiscussions\Pages;

use App\Filament\Resources\CanalDeDiscussions\CanalDeDiscussionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCanalDeDiscussion extends EditRecord
{
    protected static string $resource = CanalDeDiscussionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
