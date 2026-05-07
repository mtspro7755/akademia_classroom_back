<?php

namespace App\Filament\Resources\Candidatures;

use App\Filament\Resources\Candidatures\Pages\CreateCandidature;
use App\Filament\Resources\Candidatures\Pages\EditCandidature;
use App\Filament\Resources\Candidatures\Pages\ListCandidatures;
use App\Filament\Resources\Candidatures\Pages\ViewCandidature;
use App\Filament\Resources\Candidatures\Schemas\CandidatureForm;
use App\Filament\Resources\Candidatures\Schemas\CandidatureInfolist;
use App\Filament\Resources\Candidatures\Tables\CandidaturesTable;
use App\Models\Candidature;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CandidatureResource extends Resource
{
    protected static ?string $model = Candidature::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'statut';

    public static function form(Schema $schema): Schema
    {
        return CandidatureForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CandidatureInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CandidaturesTable::configure($table);
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
            'index' => ListCandidatures::route('/'),
            'create' => CreateCandidature::route('/create'),
            'view' => ViewCandidature::route('/{record}'),
            'edit' => EditCandidature::route('/{record}/edit'),
        ];
    }
}
