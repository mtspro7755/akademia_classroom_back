<?php

namespace App\Http\Controllers;

use App\Models\ParcoursFormation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;

class ParcourFormationController extends Controller
{
    public function indexParcoursFormation()
    {
        try{
            return response()->json(ParcoursFormation::all());
        }catch (\Exception $e) {
            Log::debug($e->getMessage());

            return response()->json(['error' => 'Erreur'], 500);
        }
    }

    public function showParcoursFormation(ParcoursFormation $parcoursFormation )
    {
        try{
            return response()->json($parcoursFormation);
        }catch (\Exception $e) {
            return response()->json(['error' => 'Erreur'], 500);
        }
    }

    public function storeParcoursFormation(Request $request)
    {
        try {
            $parcoursFormation=ParcoursFormation::create([
                'intitule' => $request->intitule
            ]);

            return response()->json([
                'succes'=>true,
                'parcoursFormation' => $parcoursFormation
            ], 201);
        }catch (\Exception $e) {
            Log::debug($e->getMessage());
            return response()->json(['error' => 'Erreur'], 500);
        }
    }

    public function updateParcoursFormation(Request $request, ParcoursFormation $parcoursFormation)
    {
        try {
            $parcoursFormation->update($request->all());

            return response()->json([
                'succes'=>true,
                'parcoursFormation' => $parcoursFormation
            ]);
        }catch (\Exception $e) {
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

            $cohorte = $user->cohortes()->with('parcours')->first();

            if (!$cohorte) {
                return response()->json([
                    'message' => 'Aucune cohorte trouvée'
                ], 404);
            }

            return response()->json($cohorte->parcours);
        }catch (\Exception $e) {
            Log::debug($e->getMessage());

            return response()->json(['error' => 'Erreur'], 500);
        }

    }

    public function getQuetes(ParcoursFormation $parcoursFormation)
    {
        try {
            return response()->json($parcoursFormation->quetes);
        }catch (\Exception $e) {
            Log::debug($e->getMessage());
            return response()->json(['error' => 'Erreur'], 500);
        }
    }
}
