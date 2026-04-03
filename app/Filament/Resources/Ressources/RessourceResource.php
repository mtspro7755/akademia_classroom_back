<?php

namespace App\Filament\Resources\Ressources;

use App\Filament\Resources\Ressources\Pages\CreateRessource;
use App\Filament\Resources\Ressources\Pages\EditRessource;
use App\Filament\Resources\Ressources\Pages\ListRessources;
use App\Filament\Resources\Ressources\Pages\ViewRessource;
use App\Filament\Resources\Ressources\Schemas\RessourceForm;
use App\Filament\Resources\Ressources\Schemas\RessourceInfolist;
use App\Filament\Resources\Ressources\Tables\RessourcesTable;
use App\Models\Ressource;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class RessourceResource extends Resource
{
    protected static ?string $model = Ressource::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'type';

    public static function form(Schema $schema): Schema
    {
        return RessourceForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return RessourceInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RessourcesTable::configure($table);
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
            'index' => ListRessources::route('/'),
            'create' => CreateRessource::route('/create'),
            'view' => ViewRessource::route('/{record}'),
            'edit' => EditRessource::route('/{record}/edit'),
        ];
    }
}
