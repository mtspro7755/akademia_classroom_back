<?php

namespace App\Http\Controllers;

use App\Http\Requests\CohorteRequest;
use App\Models\Apprenant;
use App\Models\Cohorte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CohorteController extends Controller
{
    public function store(CohorteRequest $request)
    {
        try {
            $cohorte = Cohorte::create($request->validated());

            return response()->json([
                'message' => 'Cohorte créée avec succès',
                'data' => $cohorte
            ], 201);
        }catch (\Exception $e){
            Log::debug($e->getMessage());
            return response()->json(['error' => 'Erreur'], 500);
        }
    }

    public function show(Cohorte $cohorte)
    {
        try {
            return response()->json([$cohorte]);
        }catch (\Exception $e){
            Log::debug($e->getMessage());
            return response()->json(['error' => 'Erreur'], 500);
        }
    }

    public function index()
    {
        try {
            return response()->json(Cohorte::all());
        }catch (\Exception $e){
            Log::debug($e->getMessage());
            return response()->json(['error' => 'Erreur'], 500);
        }
    }


    public function update(CohorteRequest $request, Cohorte $cohorte)
    {
        try {
            $cohorte->update($request->validated());

            return response()->json([
                'message' => 'Cohorte mise à jour',
                'data' => $cohorte
            ]);
        }catch (\Exception $e){
            Log::debug($e->getMessage());
            return response()->json(['error' => 'Erreur'], 500);
        }
    }

    public function destroy(Cohorte $cohorte)
    {
        try {
            if ($cohorte->statut === 'EnCours') {
                return response()->json([
                    'message' => 'Impossible de supprimer une cohorte en cours'
                ], 400);
            }

            $cohorte->delete();

            return response()->json([
                'message' => 'Cohorte supprimée'
            ]);
        }catch (\Exception $e){
            Log::debug($e->getMessage());
            return response()->json(['error' => 'Erreur'], 500);
        }
    }


    public function attribuerFormateur(Cohorte $cohorte, Request $request)
    {
        try {
            $formateur = Apprenant::formateurs()->findOrFail($request->apprenant_id);

            $cohorte->apprenants()->syncWithoutDetaching([$formateur->id]);

            return response()->json([
                'message' => 'Formateur assigné avec succès'
            ]);
        }catch (\Exception $e){
            Log::debug($e->getMessage());
            return response()->json(['error' => 'Erreur'], 500);
        }
    }


    public function ajouterEtudiant(Cohorte $cohorte, Request $request)
    {
        try{
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
        }catch (\Exception $e){
            Log::debug($e->getMessage());
            return response()->json(['error' => 'Erreur'], 500);
        }
    }

    public function retirerEtudiant(Cohorte $cohorte, Request $request)
    {
        try{
            $cohorte->apprenants()->detach($request->apprenant_id);

            return response()->json([
                'message' => 'Étudiant retiré'
            ]);
        }catch (\Exception $e){
            Log::debug($e->getMessage());
            return response()->json(['error' => 'Erreur'], 500);
        }
    }


    public function utilisateurs(Cohorte $cohorte)
    {
        try {
            return response()->json([
                'formateur' => $cohorte->formateur,
                'apprenants' => $cohorte->apprenants()->apprenants()->get()
            ]);
        }catch (\Exception $e){
            Log::debug($e->getMessage());
            return response()->json(['error' => 'Erreur'], 500);
        }
    }

    public function lancer(Cohorte $cohorte)
    {
        try{
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
        }catch (\Exception $e){
            Log::debug($e->getMessage());
            return response()->json(['error' => 'Erreur'], 500);
        }
    }


    public function archiver(Cohorte $cohorte)
    {
        try {
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
        }catch (\Exception $e){
            Log::debug($e->getMessage());
            return response()->json(['error' => 'Erreur'], 500);
        }
    }


    public function associerParcours(Cohorte $cohorte, Request $request)
    {
        try{
            $cohorte->update([
                'parcours_formation_id' => $request->parcours_formation_id
            ]);

            return response()->json([
                'message' => 'Parcours associé à la cohorte'
            ]);
        }catch (\Exception $e){
            Log::debug($e->getMessage());
            return response()->json(['error' => 'Erreur'], 500);
        }
    }







}
