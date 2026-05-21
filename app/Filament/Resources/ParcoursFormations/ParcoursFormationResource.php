<?php

namespace App\Filament\Resources\ParcoursFormations;

use App\Filament\Resources\ParcoursFormations\Pages\CreateParcoursFormation;
use App\Filament\Resources\ParcoursFormations\Pages\EditParcoursFormation;
use App\Filament\Resources\ParcoursFormations\Pages\ListParcoursFormations;
use App\Filament\Resources\ParcoursFormations\Pages\ViewParcoursFormation;
use App\Filament\Resources\ParcoursFormations\RelationManagers\CohortesRelationManager;
use App\Filament\Resources\ParcoursFormations\RelationManagers\QuetesRelationManager;
use App\Filament\Resources\ParcoursFormations\Schemas\ParcoursFormationForm;
use App\Filament\Resources\ParcoursFormations\Tables\ParcoursFormationsTable;
use App\Models\ParcoursFormation;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ParcoursFormationResource extends Resource
{
    protected static ?string $model = ParcoursFormation::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'intitule';

    public static function getNavigationGroup(): ?string
    {
        return 'Pédagogie';
    }

    public static function form(Schema $schema): Schema
    {
        return ParcoursFormationForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ParcoursFormationsTable::configure($table);
    }

    public static function infolist(Schema $schema): Schema
    {
        return \App\Filament\Resources\ParcoursFormations\Schemas\ParcoursFormationInfolist::configure($schema);
    }

    public static function getRelations(): array
    {
        return [
            CohortesRelationManager::class,
            QuetesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListParcoursFormations::route('/'),
            'create' => CreateParcoursFormation::route('/create'),
            'view' => ViewParcoursFormation::route('/{record}'),
            'edit' => EditParcoursFormation::route('/{record}/edit'),
        ];
    }
}
