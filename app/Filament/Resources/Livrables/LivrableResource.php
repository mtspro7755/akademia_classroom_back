<?php

namespace App\Filament\Resources\Livrables;

use App\Filament\Resources\Livrables\Pages\CreateLivrable;
use App\Filament\Resources\Livrables\Pages\EditLivrable;
use App\Filament\Resources\Livrables\Pages\ListLivrables;
use App\Filament\Resources\Livrables\Pages\ViewLivrable;
use App\Filament\Resources\Livrables\RelationManagers\FeedbackRelationManager;
use App\Filament\Resources\Livrables\RelationManagers\ReponsesQuestionsRelationManager;
use App\Filament\Resources\Livrables\RelationManagers\ScoresRelationManager;
use App\Filament\Resources\Livrables\Schemas\LivrableForm;
use App\Filament\Resources\Livrables\Schemas\LivrableInfolist;
use App\Filament\Resources\Livrables\Tables\LivrablesTable;
use App\Models\Livrable;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class LivrableResource extends Resource
{
    protected static ?string $model = Livrable::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'lienDuRepertoire';

    public static function getNavigationGroup(): ?string
    {
        return 'Suivi';
    }

    public static function form(Schema $schema): Schema
    {
        return LivrableForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return LivrableInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LivrablesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            FeedbackRelationManager::class,
            ScoresRelationManager::class,
            ReponsesQuestionsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListLivrables::route('/'),
            'create' => CreateLivrable::route('/create'),
            'view' => ViewLivrable::route('/{record}'),
            'edit' => EditLivrable::route('/{record}/edit'),
        ];
    }
}
