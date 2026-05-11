<?php

namespace App\Filament\Resources\CanalDeDiscussions\Pages;

use App\Filament\Resources\CanalDeDiscussions\CanalDeDiscussionResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewCanalDeDiscussion extends ViewRecord
{
    protected static string $resource = CanalDeDiscussionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
