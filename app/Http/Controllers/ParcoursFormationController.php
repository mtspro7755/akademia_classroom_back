<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParcoursFormationRequest;
use App\Http\Resources\ParcoursFormationResource;
use App\Http\Resources\QueteResource;
use App\Models\ParcoursFormation;
use Illuminate\Support\Facades\Log;

class ParcoursFormationController extends Controller
{
    public function index()
    {
        try {
            $parcours = ParcoursFormation::with(['cohortes', 'quetes'])->get();
            return ParcoursFormationResource::collection($parcours);
        } catch (\Exception $e) {
            Log::debug($e->getMessage());
            return response()->json(['error' => 'Erreur'], 500);
        }
    }

    public function show(ParcoursFormation $parcoursFormation)
    {
        try {
            $parcoursFormation->load(['cohortes', 'quetes']);
            return new ParcoursFormationResource($parcoursFormation);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur'], 500);
        }
    }

    public function store(ParcoursFormationRequest $request)
    {
        try {
            $parcoursFormation = ParcoursFormation::create($request->validated());
            return response()->json([
                'success' => true,
                'data' => new ParcoursFormationResource($parcoursFormation)
            ], 201);
        } catch (\Exception $e) {
            Log::debug($e->getMessage());
            return response()->json(['error' => 'Erreur'], 500);
        }
    }

    public function update(ParcoursFormationRequest $request, ParcoursFormation $parcoursFormation)
    {
        try {
            $parcoursFormation->update($request->validated());
            return response()->json([
                'success' => true,
                'data' => new ParcoursFormationResource($parcoursFormation)
            ]);
        } catch (\Exception $e) {
            Log::debug($e->getMessage());
            return response()->json(['error' => 'Erreur'], 500);
        }
    }

    public function delete(ParcoursFormation $parcoursFormation)
    {
        try {
            $parcoursFormation->delete();
            return response()->json([
                'success' => true,
                'message' => 'Suppression du ParcoursFormation réussi'
            ]);
        } catch (\Exception $e) {
            Log::debug($e->getMessage());
            return response()->json(['error' => 'Erreur'], 500);
        }
    }

    public function getMyParcoursFormation()
    {
        try {
            $user = auth()->user();

            $cohortes = $user->cohortes()
                ->with(['parcoursFormation', 'apprenants' => function($query) {
                    // On filtre pour ne prendre que celui qui a le rôle formateur
                    $query->where('role', 'formateur');
                }])
                ->get();

            $data = $cohortes->map(function ($cohorte) {
                // On récupère le premier utilisateur trouvé avec le rôle formateur
                $formateur = $cohorte->apprenants->first();

                return [
                    'id' => $cohorte->parcoursFormation->id,
                    'intitule' => $cohorte->parcoursFormation->intitule,
                    'formateur_nom' => $formateur ? $formateur->nomComplet : 'En attente d\'attribution'
                ];
            });

            return response()->json(['data' => $data]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getQuetes(ParcoursFormation $parcoursFormation)
    {
        try {
            return QueteResource::collection($parcoursFormation->quetes);
        } catch (\Exception $e) {
            Log::debug($e->getMessage());
            return response()->json(['error' => 'Erreur'], 500);
        }
    }
}
