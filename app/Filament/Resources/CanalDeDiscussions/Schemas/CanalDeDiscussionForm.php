<?php

namespace App\Filament\Resources\CanalDeDiscussions\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class CanalDeDiscussionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('titre')
                    ->required(),
                Textarea::make('description')
                    ->default(null)
                    ->columnSpanFull(),
                Select::make('cohorte_id')
                    ->relationship('cohorte', 'nom')
                    ->default(null),
            ]);
    }
}
