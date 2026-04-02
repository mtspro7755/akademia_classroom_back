<?php

namespace App\Http\Controllers;

use App\Http\Resources\ParcoursFormationResource;
use App\Http\Resources\QueteResource;
use App\Models\ParcoursFormation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;

class ParcourFormationController extends Controller
{
    public function indexParcoursFormation()
    {
        try {
            $parcours = ParcoursFormation::with([
                'cohortes',
                'quetes'
            ])->get();

            return ParcoursFormationResource::collection($parcours);

        } catch (\Exception $e) {
            Log::debug($e->getMessage());
            return response()->json(['error' => 'Erreur'], 500);
        }
    }

    public function showParcoursFormation(ParcoursFormation $parcoursFormation )
    {
        try {
            $parcoursFormation->load([
                'cohortes',
                'quetes'
            ]);

            return new ParcoursFormationResource($parcoursFormation);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur'], 500);
        }
    }

    public function storeParcoursFormation(Request $request)
    {
        try {
            $parcoursFormation = ParcoursFormation::create([
                'intitule' => $request->intitule
            ]);

            return response()->json([
                'success' => true,
                'data' => new ParcoursFormationResource($parcoursFormation)
            ], 201);

        } catch (\Exception $e) {
            Log::debug($e->getMessage());
            return response()->json(['error' => 'Erreur'], 500);
        }
    }

    public function updateParcoursFormation(Request $request, ParcoursFormation $parcoursFormation)
    {
        try {
            $parcoursFormation->update($request->all());

            return response()->json([
                'success' => true,
                'data' => new ParcoursFormationResource($parcoursFormation)
            ]);

        } catch (\Exception $e) {
            Log::debug($e->getMessage());
            return response()->json(['error' => 'Erreur'], 500);
        }
    }

    public function deleteParcoursFormation(ParcoursFormation $parcoursFormation)
    {
        try {
            $parcoursFormation->delete();
            return response()->json([
                'succes'=>true,
                'message'=> 'suppression du ParcoursFormation réussi'
            ]);
        }catch (\Exception $e) {
            Log::debug($e->getMessage());
            return response()->json(['error' => 'Erreur'], 500);
        }
    }

    public function getMyParcoursFormation()
    {
        try {
            $user = auth()->user();

            $cohorte = $user->cohortes()
                ->with('parcoursFormation')
                ->first();

            if (!$cohorte) {
                return response()->json([
                    'message' => 'Aucune cohorte trouvée'
                ], 404);
            }

            return new ParcoursFormationResource(
                $cohorte->parcoursFormation
            );

        } catch (\Exception $e) {
            Log::debug($e->getMessage());
            return response()->json(['error' => 'Erreur'], 500);
        }

    }

    public function getQuetes(ParcoursFormation $parcoursFormation)
    {
        try {
            $quetes = $parcoursFormation->quetes;

            return QueteResource::collection($quetes);

        } catch (\Exception $e) {
            Log::debug($e->getMessage());
            return response()->json(['error' => 'Erreur'], 500);
        }
    }
}
