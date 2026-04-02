<?php

namespace App\Filament\Resources\Cohortes;

use App\Filament\Resources\Cohortes\Pages\CreateCohorte;
use App\Filament\Resources\Cohortes\Pages\EditCohorte;
use App\Filament\Resources\Cohortes\Pages\ListCohortes;
use App\Filament\Resources\Cohortes\Pages\ViewCohorte;
use App\Filament\Resources\Cohortes\Schemas\CohorteForm;
use App\Filament\Resources\Cohortes\Schemas\CohorteInfolist;
use App\Filament\Resources\Cohortes\Tables\CohortesTable;
use App\Models\Cohorte;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CohorteResource extends Resource
{
    protected static ?string $model = Cohorte::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'nom';

    public static function form(Schema $schema): Schema
    {
        return CohorteForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CohorteInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CohortesTable::configure($table);
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
            'index' => ListCohortes::route('/'),
            'create' => CreateCohorte::route('/create'),
            'view' => ViewCohorte::route('/{record}'),
            'edit' => EditCohorte::route('/{record}/edit'),
        ];
    }
}
