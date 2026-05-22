<?php

namespace App\Filament\Resources\Livrables\Schemas;

use App\Models\Activite;
use App\Models\ParcoursFormation;
use App\Models\Quete;
use App\Models\Apprenant;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Closure;

class LivrableForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('formation_id')
                    ->label('Formation')
                    ->options(ParcoursFormation::all()->pluck('intitule', 'id'))
                    ->searchable()
                    ->live()
                    ->afterStateUpdated(function ($set) {
                        $set('quete_id', null);
                        $set('activite_id', null);
                        $set('apprenant_id', null);
                    }),

                Select::make('quete_id')
                    ->label('Quête')
                    ->options(function (Get $get) {
                        $formationId = $get('formation_id');
                        if (!$formationId) return [];
                        return Quete::where('parcours_formation_id', $formationId)->pluck('titre', 'id');
                    })
                    ->live()
                    ->required()
                    ->afterStateUpdated(function ($set) {
                        $set('activite_id', null);
                    }),

                Select::make('activite_id')
                    ->label('Activité cible')
                    ->options(function (Get $get) { // Typage Get ajouté ici
                        $queteId = $get('quete_id');
                        if (!$queteId) return [];
                        return Activite::where('quete_id', $queteId)->pluck('titre', 'id');
                    })
                    ->required()
                    ->searchable(),

                Select::make('apprenant_id')
                    ->label('Apprenant')
                    ->options(function (Get $get) { // Typage Get ajouté ici
                        $formationId = $get('formation_id');

                        if (!$formationId) {
                            return [];
                        }

                        return Apprenant::whereHas('cohortes', function ($query) use ($formationId) {
                            $query->where('parcours_formation_id', $formationId);
                        })->pluck('email', 'id'); // Changé en 'email' selon ton schéma d'origine
                    })
                    ->disabled(fn (Get $get) => !$get('formation_id'))
                    ->searchable()
                    ->required()
                    ->rules([
                        fn (Get $get): Closure => function (string $attribute, $value, Closure $fail) use ($get) {
                            $formationId = $get('formation_id');
                            if (!$formationId) return;

                            $estInscrit = Apprenant::where('id', $value)
                                ->whereHas('cohortes', function ($query) use ($formationId) {
                                    $query->where('parcours_formation_id', $formationId);
                                })->exists();

                            if (!$estInscrit) {
                                $fail("Erreur d'intégrité : Cet apprenant n'appartient à aucune cohorte de la formation sélectionnée.");
                            }
                        },
                    ]),

                Select::make('typeLivrable')
                    ->options(['Lien' => 'Lien', 'Question' => 'Question'])
                    ->required(),
                TextInput::make('statutCorrection')
                    ->default(null),
                DateTimePicker::make('dateSoumission'),
                TextInput::make('dureeEffectue')
                    ->numeric()
                    ->default(null),
                TextInput::make('lienDuRepertoire')
                    ->default(null),
                TextInput::make('lienDeploye')
                    ->default(null),
                TextInput::make('dureeActivite')
                    ->label('Durée prévue de l\'activité')
                    ->numeric()
                    ->default(null),
                Select::make('estEnRetard')
                    ->label('En retard ?')
                    ->options([
                        false => 'Non',
                        true => 'Oui',
                    ])
                    ->default(false),
                TextInput::make('minutesRetard')
                    ->label('Minutes de retard')
                    ->numeric()
                    ->default(0),
            ]);
    }
}
