<?php

namespace App\Http\Controllers;

use App\Http\Requests\CohorteRequest;
use App\Models\Apprenant;
use App\Models\Cohorte;
use Illuminate\Http\Request;

class CohorteController extends Controller
{
    public function store(CohorteRequest $request)
    {
        $cohorte = Cohorte::create($request->validated());

        return response()->json([
            'message' => 'Cohorte créée avec succès',
            'data' => $cohorte
        ], 201);
    }

    public function show(Cohorte $cohorte)
    {
        return response()->json([$cohorte]);
    }

    public function index()
    {
        return response()->json(Cohorte::all());
    }


    public function update(CohorteRequest $request, Cohorte $cohorte)
    {
        $cohorte->update($request->validated());

        return response()->json([
            'message' => 'Cohorte mise à jour',
            'data' => $cohorte
        ]);
    }

    public function destroy(Cohorte $cohorte)
    {
        if ($cohorte->statut === 'EnCours') {
            return response()->json([
                'message' => 'Impossible de supprimer une cohorte en cours'
            ], 400);
        }

        $cohorte->delete();

        return response()->json([
            'message' => 'Cohorte supprimée'
        ]);
    }


    public function attribuerFormateur(Cohorte $cohorte, Request $request)
    {
        $formateur = Apprenant::formateurs()->findOrFail($request->apprenant_id);

        $cohorte->apprenants()->syncWithoutDetaching([$formateur->id]);

        return response()->json([
            'message' => 'Formateur assigné avec succès'
        ]);
    }


    public function ajouterEtudiant(Cohorte $cohorte, Request $request)
    {
        $etudiant = Apprenant::apprenants()->findOrFail($request->apprenant_id);

        $alreadyInActive = $etudiant->cohortes()
            ->where('statut', 'EnCours')
            ->exists();

        if ($alreadyInActive) {
            return response()->json([
                'message' => 'Cet apprenant est déjà dans une cohorte active'
            ], 400);
        }


        if ($cohorte->apprenants()->count() >= $cohorte->capaciteMax) {
            return response()->json([
                'message' => 'Cohorte pleine'
            ], 400);
        }

        $cohorte->apprenants()->attach($etudiant->id);

        return response()->json([
            'message' => 'Étudiant ajouté avec succès'
        ]);
    }

    public function retirerEtudiant(Cohorte $cohorte, Request $request)
    {
        $cohorte->apprenants()->detach($request->apprenant_id);

        return response()->json([
            'message' => 'Étudiant retiré'
        ]);
    }


    public function utilisateurs(Cohorte $cohorte)
    {
        return response()->json([
            'formateur' => $cohorte->formateur,
            'apprenants' => $cohorte->apprenants()->apprenants()->get()
        ]);
    }

    public function lancer(Cohorte $cohorte)
    {
        if ($cohorte->statut === 'EnCours') {
            return response()->json([
                'message' => 'La cohorte est déjà en cours'
            ], 400);
        }

        if (!$cohorte->parcours_formation_id) {
            return response()->json([
                'message' => 'Associez un parcours avant de lancer la cohorte'
            ], 400);
        }

        $cohorte->update([
            'statut' => 'EnCours',
            'dateDebut' => now()
        ]);

        return response()->json([
            'message' => 'Cohorte lancée avec succès'
        ]);
    }


    public function archiver(Cohorte $cohorte)
    {
        if ($cohorte->statut === 'Termine') {
            return response()->json([
                'message' => 'La cohorte est déjà terminée'
            ], 400);
        }

        if ($cohorte->statut === 'EnAttente') {
            return response()->json([
                'message' => 'Impossible d’archiver une cohorte non lancée'
            ], 400);
        }

        $cohorte->update([
            'statut' => 'Termine',
            'dateFin' => now()
        ]);

        return response()->json([
            'message' => 'Cohorte archivée avec succès'
        ]);
    }


    public function associerParcours(Cohorte $cohorte, Request $request)
    {
        $cohorte->update([
            'parcours_formation_id' => $request->parcours_formation_id
        ]);

        return response()->json([
            'message' => 'Parcours associé à la cohorte'
        ]);
    }







}
