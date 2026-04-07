<?php

namespace App\Filament\Resources\Thematiques;

use App\Filament\Resources\Thematiques\Pages\CreateThematique;
use App\Filament\Resources\Thematiques\Pages\EditThematique;
use App\Filament\Resources\Thematiques\Pages\ListThematiques;
use App\Filament\Resources\Thematiques\Pages\ViewThematique;
use App\Filament\Resources\Thematiques\Schemas\ThematiqueForm;
use App\Filament\Resources\Thematiques\Schemas\ThematiqueInfolist;
use App\Filament\Resources\Thematiques\Tables\ThematiquesTable;
use App\Models\Thematique;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ThematiqueResource extends Resource
{
    protected static ?string $model = Thematique::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'titre';

    public static function getNavigationGroup(): ?string
    {
        return 'Pédagogie';
    }

    public static function form(Schema $schema): Schema
    {
        return ThematiqueForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ThematiqueInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ThematiquesTable::configure($table);
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
            'index' => ListThematiques::route('/'),
            'create' => CreateThematique::route('/create'),
            'view' => ViewThematique::route('/{record}'),
            'edit' => EditThematique::route('/{record}/edit'),
        ];
    }
}
