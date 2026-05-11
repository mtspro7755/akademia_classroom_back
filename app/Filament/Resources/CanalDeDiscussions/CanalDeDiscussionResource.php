<?php

namespace App\Filament\Resources\CanalDeDiscussions;

use App\Filament\Resources\CanalDeDiscussions\Pages\CreateCanalDeDiscussion;
use App\Filament\Resources\CanalDeDiscussions\Pages\EditCanalDeDiscussion;
use App\Filament\Resources\CanalDeDiscussions\Pages\ListCanalDeDiscussions;
use App\Filament\Resources\CanalDeDiscussions\Pages\ViewCanalDeDiscussion;
use App\Filament\Resources\CanalDeDiscussions\RelationManagers\MessagesRelationManager;
use App\Filament\Resources\CanalDeDiscussions\Schemas\CanalDeDiscussionForm;
use App\Filament\Resources\CanalDeDiscussions\Tables\CanalDeDiscussionsTable;
use App\Models\CanalDeDiscussion;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CanalDeDiscussionResource extends Resource
{
    protected static ?string $model = CanalDeDiscussion::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'titre';

    public static function getNavigationGroup(): ?string
    {
        return 'Communication';
    }

    public static function form(Schema $schema): Schema
    {
        return CanalDeDiscussionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CanalDeDiscussionsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            MessagesRelationManager::class,
        ];
    }

    public static function getPages(): array

    {
        return [
            'index' => ListCanalDeDiscussions::route('/'),
            'create' => CreateCanalDeDiscussion::route('/create'),
            'view' => ViewCanalDeDiscussion::route('/{record}'),
            'edit' => EditCanalDeDiscussion::route('/{record}/edit'),
        ];
    }
}
