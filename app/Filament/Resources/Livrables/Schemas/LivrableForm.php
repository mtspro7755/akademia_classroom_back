<?php

namespace App\Filament\Resources\Livrables\Schemas;

use App\Models\Activite;
use App\Models\ParcoursFormation;
use App\Models\Quete;
use App\Models\Cohorte;
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
                        $set('cohorte_id', null);
                        $set('apprenant_id', null);
                    }),

                Select::make('cohorte_id')
                    ->label('Cohorte')
                    ->options(function (Get $get) {
                        $formationId = $get('formation_id');
                        if (!$formationId) return [];

                        return Cohorte::where('parcours_formation_id', $formationId)
                            ->pluck('nom', 'id');
                    })
                    ->live()
                    ->disabled(fn (Get $get) => !$get('formation_id'))
                    ->searchable()
                    ->required()
                    ->afterStateUpdated(function ($set) {
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
                    ->options(function (Get $get) {
                        $queteId = $get('quete_id');
                        if (!$queteId) return [];
                        return Activite::where('quete_id', $queteId)->pluck('titre', 'id');
                    })
                    ->required()
                    ->searchable(),

                Select::make('apprenant_id')
                    ->label('Apprenant')
                    ->options(function (Get $get) {
                        $cohorteId = $get('cohorte_id');
                        if (!$cohorteId) return [];

                        // On filtre pour n'avoir QUE les apprenants de la cohorte sélectionnée
                        return Apprenant::whereHas('cohortes', function ($query) use ($cohorteId) {
                            $query->where('cohorte_id', $cohorteId);
                        })->pluck('email', 'id');
                    })
                    ->disabled(fn (Get $get) => !$get('cohorte_id'))
                    ->searchable()
                    ->required()
                    ->rules([
                        fn (Get $get): Closure => function (string $attribute, $value, Closure $fail) use ($get) {
                            $cohorteId = $get('cohorte_id');
                            if (!$cohorteId) return;

                            // Test d'intégrité strict : l'apprenant doit être dans cette cohorte précise
                            $estInscrit = Apprenant::where('id', $value)
                                ->whereHas('cohortes', function ($query) use ($cohorteId) {
                                    $query->where('cohorte_id', $cohorteId);
                                })->exists();

                            if (!$estInscrit) {
                                $fail("Erreur d'intégrité : Cet apprenant n'appartient pas à la cohorte sélectionnée.");
                            }
                        },
                    ]),

                Select::make('typeLivrable')
                    ->options(['Lien' => 'Lien', 'Question' => 'Question'])
                    ->required(),
                TextInput::make('statutCorrection')
                    ->required()
                    ->default(null),
                DateTimePicker::make('dateSoumission')
                    ->required(),
                TextInput::make('dureeEffectue')
                    ->numeric()
                    ->default(null)
                    ->required(),
                TextInput::make('lienDuRepertoire')
                    ->required()
                    ->default(null),
                TextInput::make('lienDeploye')
                    ->required()
                    ->default(null),
                TextInput::make('dureeActivite')
                    ->label('Durée prévue de l\'activité')
                    ->required()
                    ->numeric()
                    ->default(null),
                Select::make('estEnRetard')
                    ->label('En retard ?')
                    ->required()
                    ->options([
                        false => 'Non',
                        true => 'Oui',
                    ])
                    ->default(false),
                TextInput::make('minutesRetard')
                    ->label('Minutes de retard')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
