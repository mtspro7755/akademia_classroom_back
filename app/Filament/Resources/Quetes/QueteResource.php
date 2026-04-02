<?php

namespace App\Filament\Resources\Quetes;

use App\Filament\Resources\Quetes\Pages\CreateQuete;
use App\Filament\Resources\Quetes\Pages\EditQuete;
use App\Filament\Resources\Quetes\Pages\ListQuetes;
use App\Filament\Resources\Quetes\Pages\ViewQuete;
use App\Filament\Resources\Quetes\Schemas\QueteForm;
use App\Filament\Resources\Quetes\Schemas\QueteInfolist;
use App\Filament\Resources\Quetes\Tables\QuetesTable;
use App\Models\Quete;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class QueteResource extends Resource
{
    protected static ?string $model = Quete::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'titre';

    public static function form(Schema $schema): Schema
    {
        return QueteForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return QueteInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return QuetesTable::configure($table);
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
            'index' => ListQuetes::route('/'),
            'create' => CreateQuete::route('/create'),
            'view' => ViewQuete::route('/{record}'),
            'edit' => EditQuete::route('/{record}/edit'),
        ];
    }
}
