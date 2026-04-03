<?php

namespace App\Filament\Resources\EvaluationParFeedback\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class EvaluationParFeedbackForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('livrable_id')
                    ->required()
                    ->numeric(),
                Textarea::make('avisCritique')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
