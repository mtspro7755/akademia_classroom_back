<?php

namespace App\Filament\Resources\Activites;

use App\Filament\Resources\Activites\Pages\CreateActivite;
use App\Filament\Resources\Activites\Pages\EditActivite;
use App\Filament\Resources\Activites\Pages\ListActivites;
use App\Filament\Resources\Activites\Pages\ViewActivite;
use App\Filament\Resources\Activites\RelationManagers\CriteresRelationManager;
use App\Filament\Resources\Activites\Schemas\ActiviteForm;
use App\Filament\Resources\Activites\Schemas\ActiviteInfolist;
use App\Filament\Resources\Activites\Tables\ActivitesTable;
use App\Models\Activite;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use App\Filament\Resources\Activites\RelationManagers\QuestionsRelationManager;
use App\Filament\Resources\Activites\RelationManagers\QueteRelationManager;

class ActiviteResource extends Resource
{
    protected static ?string $model = Activite::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'titre';

    public static function getNavigationGroup(): ?string
    {
        return 'Suivi';
    }

    public static function form(Schema $schema): Schema
    {
        return ActiviteForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ActiviteInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ActivitesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            QuestionsRelationManager::class,
            CriteresRelationManager::class,

        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListActivites::route('/'),
            'create' => CreateActivite::route('/create'),
            'view' => ViewActivite::route('/{record}'),
            'edit' => EditActivite::route('/{record}/edit'),
        ];
    }
}
