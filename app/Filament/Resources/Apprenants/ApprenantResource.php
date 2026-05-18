<?php

namespace App\Filament\Resources\Apprenants;

use App\Filament\Resources\Apprenants\Pages\CreateApprenant;
use App\Filament\Resources\Apprenants\Pages\EditApprenant;
use App\Filament\Resources\Apprenants\Pages\ListApprenants;
use App\Filament\Resources\Apprenants\Pages\ViewApprenant;
use App\Filament\Resources\Apprenants\RelationManagers\CandidaturesRelationManager;
use App\Filament\Resources\Apprenants\RelationManagers\CohortesRelationManager;
use App\Filament\Resources\Apprenants\RelationManagers\PenalitesRelationManager;
use App\Filament\Resources\Apprenants\RelationManagers\QuetesRelationManager;
use App\Filament\Resources\Apprenants\Schemas\ApprenantForm;
use App\Filament\Resources\Apprenants\Schemas\ApprenantInfolist;
use App\Filament\Resources\Apprenants\Tables\ApprenantsTable;
use App\Models\Apprenant;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ApprenantResource extends Resource
{
    protected static ?string $model = Apprenant::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'nomComplet';

    public static function getNavigationGroup(): ?string
    {
        return 'Utilisateurs';
    }

    public static function form(Schema $schema): Schema
    {
        return ApprenantForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ApprenantInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ApprenantsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            PenalitesRelationManager::class,
            CohortesRelationManager::class,
            QuetesRelationManager::class,
            CandidaturesRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListApprenants::route('/'),
            'create' => CreateApprenant::route('/create'),
            'view' => ViewApprenant::route('/{record}'),
            'edit' => EditApprenant::route('/{record}/edit'),
        ];
    }
}
