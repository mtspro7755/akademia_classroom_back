<?php

namespace App\Filament\Resources\Ressources\Schemas;

use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class RessourceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('type')
                    ->options(['lien' => 'Lien', 'pdf' => 'Pdf'])
                    ->default('lien')
                    ->required(),
            ]);
    }
}
