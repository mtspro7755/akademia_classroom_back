<?php

namespace App\Filament\Resources\Questions\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class QuestionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('activite_id')
                    ->required()
                    ->numeric(),
                TextInput::make('intitule')
                    ->required(),
            ]);
    }
}
