<?php

namespace App\Http\Controllers;

use App\Models\ParcoursFormation;
use Illuminate\Http\Request;

class ParcourFormationController extends Controller
{
    public function indexParcoursFormation()
    {
        return response()->json(ParcoursFormation::all());
    }

    public function showParcoursFormation(ParcoursFormation $parcoursFormation )
    {
        return response()->json($parcoursFormation);
    }

    public function storeParcoursFormation(Request $request)
    {
        $parcoursFormation=ParcoursFormation::create([
            'intitule' => $request->intitule
        ]);

        return response()->json([
            'succes'=>true,
            'parcoursFormation' => $parcoursFormation
        ], 201);
    }

    public function updateParcoursFormation(Request $request, ParcoursFormation $parcoursFormation)
    {
        $parcoursFormation->update($request->all());

        return response()->json([
            'succes'=>true,
            'parcoursFormation' => $parcoursFormation
        ]);
    }

    public function deleteParcoursFormation(ParcoursFormation $parcoursFormation)
    {
        $parcoursFormation->delete();
        return response()->json([
            'succes'=>true,
            'message'=> 'suppression du ParcoursFormation réussi'
        ]);
    }

    public function getMyParcoursFormation()
    {
        $user = auth()->user();

        $cohorte = $user->cohortes()->with('parcours')->first();

        if (!$cohorte) {
            return response()->json([
                'message' => 'Aucune cohorte trouvée'
            ], 404);
        }

        return response()->json($cohorte->parcours);

    }

    public function getQuetes(ParcoursFormation $parcoursFormation)
    {
        return response()->json($parcoursFormation->quetes);
    }
}
