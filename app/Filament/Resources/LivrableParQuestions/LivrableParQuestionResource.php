<?php

namespace App\Filament\Resources\LivrableParQuestions;

use App\Filament\Resources\LivrableParQuestions\Pages\CreateLivrableParQuestion;
use App\Filament\Resources\LivrableParQuestions\Pages\EditLivrableParQuestion;
use App\Filament\Resources\LivrableParQuestions\Pages\ListLivrableParQuestions;
use App\Filament\Resources\LivrableParQuestions\Pages\ViewLivrableParQuestion;
use App\Filament\Resources\LivrableParQuestions\Schemas\LivrableParQuestionForm;
use App\Filament\Resources\LivrableParQuestions\Schemas\LivrableParQuestionInfolist;
use App\Filament\Resources\LivrableParQuestions\Tables\LivrableParQuestionsTable;
use App\Models\LivrableParQuestion;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class LivrableParQuestionResource extends Resource
{
    protected static ?string $model = LivrableParQuestion::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return LivrableParQuestionForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return LivrableParQuestionInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LivrableParQuestionsTable::configure($table);
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
            'index' => ListLivrableParQuestions::route('/'),
            'create' => CreateLivrableParQuestion::route('/create'),
            'view' => ViewLivrableParQuestion::route('/{record}'),
            'edit' => EditLivrableParQuestion::route('/{record}/edit'),
        ];
    }
}
