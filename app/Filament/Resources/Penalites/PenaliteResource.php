<?php

namespace App\Filament\Resources\Penalites;

use App\Filament\Resources\Penalites\Pages\CreatePenalite;
use App\Filament\Resources\Penalites\Pages\EditPenalite;
use App\Filament\Resources\Penalites\Pages\ListPenalites;
use App\Filament\Resources\Penalites\Pages\ViewPenalite;
use App\Filament\Resources\Penalites\Schemas\PenaliteForm;
use App\Filament\Resources\Penalites\Schemas\PenaliteInfolist;
use App\Filament\Resources\Penalites\Tables\PenalitesTable;
use App\Models\Penalite;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PenaliteResource extends Resource
{
    protected static ?string $model = Penalite::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'tempsDeRetard';

    public static function form(Schema $schema): Schema
    {
        return PenaliteForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PenaliteInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PenalitesTable::configure($table);
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
            'index' => ListPenalites::route('/'),
            'create' => CreatePenalite::route('/create'),
            'view' => ViewPenalite::route('/{record}'),
            'edit' => EditPenalite::route('/{record}/edit'),
        ];
    }
}
