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


            $parcours = $user->cohortes()
                ->with('parcoursFormation')
                ->get()
                ->pluck('parcoursFormation');

            if ($parcours->isEmpty()) {
                return response()->json([], 200);
            }

            return ParcoursFormationResource::collection($parcours);
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
