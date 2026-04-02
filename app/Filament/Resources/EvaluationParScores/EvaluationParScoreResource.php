<?php

namespace App\Filament\Resources\EvaluationParScores;

use App\Filament\Resources\EvaluationParScores\Pages\CreateEvaluationParScore;
use App\Filament\Resources\EvaluationParScores\Pages\EditEvaluationParScore;
use App\Filament\Resources\EvaluationParScores\Pages\ListEvaluationParScores;
use App\Filament\Resources\EvaluationParScores\Pages\ViewEvaluationParScore;
use App\Filament\Resources\EvaluationParScores\Schemas\EvaluationParScoreForm;
use App\Filament\Resources\EvaluationParScores\Schemas\EvaluationParScoreInfolist;
use App\Filament\Resources\EvaluationParScores\Tables\EvaluationParScoresTable;
use App\Models\EvaluationParScore;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class EvaluationParScoreResource extends Resource
{
    protected static ?string $model = EvaluationParScore::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'score';

    public static function form(Schema $schema): Schema
    {
        return EvaluationParScoreForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return EvaluationParScoreInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EvaluationParScoresTable::configure($table);
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
            'index' => ListEvaluationParScores::route('/'),
            'create' => CreateEvaluationParScore::route('/create'),
            'view' => ViewEvaluationParScore::route('/{record}'),
            'edit' => EditEvaluationParScore::route('/{record}/edit'),
        ];
    }
}
