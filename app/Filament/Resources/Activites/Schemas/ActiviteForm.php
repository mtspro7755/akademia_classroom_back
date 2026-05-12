<?php

namespace App\Filament\Resources\Activites\Schemas;

use App\Models\Activite;
use App\Models\ParcoursFormation;
use App\Models\Quete;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

class ActiviteForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('parcours_id')
                    ->label('Parcours de Formation')

                    ->options(ParcoursFormation::pluck('intitule', 'id'))
                    ->searchable()
                    ->preload()
                    ->live()
                    ->required()

                    ->afterStateHydrated(function (Set $set, Get $get, ?Activite $record) {
                        if ($record && $record->quete) {
                            $set('parcours_id', $record->quete->parcours_formation_id);
                        }
                    })

                    ->afterStateUpdated(fn (Set $set) => $set('quete_id', null)),

                Select::make('quete_id')
                    ->label('Quête')
                    ->relationship('quete', 'titre')
                    ->searchable(['quetes.titre'])
                    ->preload()
                    ->required()
                    ->options(function (Get $get) {
                        $parcoursId = $get('parcours_id');

                        if (! $parcoursId) {
                            return Quete::all()->pluck('titre', 'id');
                        }

                        return Quete::where('parcours_formation_id', $parcoursId)
                            ->pluck('titre', 'id');
                    }),

                TextInput::make('titre')
                    ->required(),
                Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('duree')
                    ->required()
                    ->numeric(),
                Select::make('statut')
                    ->options([
                        'Brouillon' => 'Brouillon',
                        'Publié' => 'Publié',
                        'Archivé' => 'Archivé',
                    ])
                    ->required()
                    ->native(false),
                TextInput::make('ordreAffichage')
                    ->required()
                    ->numeric(),
                Select::make('typeActivite')
                    ->options(['Veille' => 'Veille', 'Atelier' => 'Atelier'])
                    ->required(),
                Select::make('typeLivrable')
                    ->options(['Lien' => 'Lien', 'Question' => 'Question'])
                    ->required(),
                Select::make('modaliteTravail')
                    ->label('Modalité de travail')
                    ->options(['individuel' => 'Individuel', 'collectif' => 'Collectif'])
                    ->default('individuel')
                    ->required(),
            ]);
    }
}
