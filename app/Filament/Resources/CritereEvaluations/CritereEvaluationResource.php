<?php

namespace App\Filament\Resources\CritereEvaluations;

use App\Filament\Resources\CritereEvaluations\Pages\CreateCritereEvaluation;
use App\Filament\Resources\CritereEvaluations\Pages\EditCritereEvaluation;
use App\Filament\Resources\CritereEvaluations\Pages\ListCritereEvaluations;
use App\Filament\Resources\CritereEvaluations\Pages\ViewCritereEvaluation;
use App\Filament\Resources\CritereEvaluations\Schemas\CritereEvaluationForm;
use App\Filament\Resources\CritereEvaluations\Schemas\CritereEvaluationInfolist;
use App\Filament\Resources\CritereEvaluations\Tables\CritereEvaluationsTable;
use App\Models\CritereEvaluation;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CritereEvaluationResource extends Resource
{
    protected static ?string $model = CritereEvaluation::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'critere';

    public static function form(Schema $schema): Schema
    {
        return CritereEvaluationForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CritereEvaluationInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CritereEvaluationsTable::configure($table);
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
            'index' => ListCritereEvaluations::route('/'),
            'create' => CreateCritereEvaluation::route('/create'),
            'view' => ViewCritereEvaluation::route('/{record}'),
            'edit' => EditCritereEvaluation::route('/{record}/edit'),
        ];
    }
}
