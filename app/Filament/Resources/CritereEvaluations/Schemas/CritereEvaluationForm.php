<?php

namespace App\Filament\Resources\CritereEvaluations\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class CritereEvaluationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('activite_id')
                    ->required()
                    ->numeric(),
                Textarea::make('critere')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('question')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('point')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
