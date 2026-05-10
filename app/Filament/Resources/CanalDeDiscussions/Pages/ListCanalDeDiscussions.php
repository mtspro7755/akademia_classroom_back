<?php

namespace App\Filament\Resources\CanalDeDiscussions\Pages;

use App\Filament\Resources\CanalDeDiscussions\CanalDeDiscussionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCanalDeDiscussions extends ListRecords
{
    protected static string $resource = CanalDeDiscussionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
