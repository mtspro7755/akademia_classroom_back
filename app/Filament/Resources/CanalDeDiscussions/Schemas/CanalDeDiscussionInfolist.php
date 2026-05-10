<?php

namespace App\Filament\Resources\CanalDeDiscussions\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Section;
use Filament\Schemas\Schema;

class CanalDeDiscussionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informations du canal')
                    ->schema([
                        TextEntry::make('titre')
                            ->label('Titre'),
                        TextEntry::make('description')
                            ->label('Description')
                            ->markdown()
                            ->columnSpanFull(),
                        TextEntry::make('cohorte.nom')
                            ->label('Cohorte'),
                        TextEntry::make('created_at')
                            ->label('Créé le')
                            ->dateTime(),
                        TextEntry::make('updated_at')
                            ->label('Modifié le')
                            ->dateTime(),
                    ])
                    ->columns(2),
            ]);
    }
}
