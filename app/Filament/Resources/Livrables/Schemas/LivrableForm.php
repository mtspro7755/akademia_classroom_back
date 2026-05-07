<?php

namespace App\Filament\Resources\Livrables\Schemas;

use App\Models\Activite;
use App\Models\ParcoursFormation;
use App\Models\Quete;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

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
                    ->afterStateUpdated(fn ($set) => $set('quete_id', null)),

                Select::make('quete_id')
                    ->label('Quête')
                    ->options(function ($get) {
                        $formationId = $get('formation_id');
                        if (!$formationId) return [];
                        return Quete::where('parcours_formation_id', $formationId)->pluck('titre', 'id');
                    })
                    ->live()
                    ->required()
                    ->afterStateUpdated(fn ($set) => $set('activite_id', null)),


                Select::make('activite_id')
                ->label('Activité cible')
                    ->options(function ($get) {
                        $queteId = $get('quete_id');
                        if (!$queteId) return [];
                        return Activite::where('quete_id', $queteId)->pluck('titre', 'id');
                    })
                    ->required()
                    ->searchable(),

                Select::make('apprenant_id')
                    ->label('Apprenant')
                    ->relationship('apprenant', 'email')
                    ->searchable()
                    ->preload()
                    ->required(),
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
