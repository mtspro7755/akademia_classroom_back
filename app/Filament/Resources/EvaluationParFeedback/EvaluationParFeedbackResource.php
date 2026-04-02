<?php

namespace App\Filament\Resources\EvaluationParFeedback;

use App\Filament\Resources\EvaluationParFeedback\Pages\CreateEvaluationParFeedback;
use App\Filament\Resources\EvaluationParFeedback\Pages\EditEvaluationParFeedback;
use App\Filament\Resources\EvaluationParFeedback\Pages\ListEvaluationParFeedback;
use App\Filament\Resources\EvaluationParFeedback\Pages\ViewEvaluationParFeedback;
use App\Filament\Resources\EvaluationParFeedback\Schemas\EvaluationParFeedbackForm;
use App\Filament\Resources\EvaluationParFeedback\Schemas\EvaluationParFeedbackInfolist;
use App\Filament\Resources\EvaluationParFeedback\Tables\EvaluationParFeedbackTable;
use App\Models\EvaluationParFeedback;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class EvaluationParFeedbackResource extends Resource
{
    protected static ?string $model = EvaluationParFeedback::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'avisCritique';

    public static function form(Schema $schema): Schema
    {
        return EvaluationParFeedbackForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return EvaluationParFeedbackInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EvaluationParFeedbackTable::configure($table);
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
            'index' => ListEvaluationParFeedback::route('/'),
            'create' => CreateEvaluationParFeedback::route('/create'),
            'view' => ViewEvaluationParFeedback::route('/{record}'),
            'edit' => EditEvaluationParFeedback::route('/{record}/edit'),
        ];
    }
}
