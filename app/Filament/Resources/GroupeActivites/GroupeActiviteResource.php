<?php

namespace App\Filament\Resources\GroupeActivites;

use App\Filament\Resources\GroupeActivites\Pages\CreateGroupeActivite;
use App\Filament\Resources\GroupeActivites\Pages\EditGroupeActivite;
use App\Filament\Resources\GroupeActivites\Pages\ListGroupeActivites;
use App\Filament\Resources\GroupeActivites\Pages\ViewGroupeActivite;
use App\Filament\Resources\GroupeActivites\Schemas\GroupeActiviteForm;
use App\Filament\Resources\GroupeActivites\Schemas\GroupeActiviteInfolist;
use App\Filament\Resources\GroupeActivites\Tables\GroupeActivitesTable;
use App\Models\GroupeActivite;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class GroupeActiviteResource extends Resource
{
    protected static ?string $model = GroupeActivite::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'nom';

    public static function form(Schema $schema): Schema
    {
        return GroupeActiviteForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return GroupeActiviteInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return GroupeActivitesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListGroupeActivites::route('/'),
            'create' => CreateGroupeActivite::route('/create'),
            'view' => ViewGroupeActivite::route('/{record}'),
            'edit' => EditGroupeActivite::route('/{record}/edit'),
        ];
    }
}
