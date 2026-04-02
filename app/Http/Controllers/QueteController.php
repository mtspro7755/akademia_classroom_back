<?php

namespace App\Http\Controllers;

use App\Http\Requests\QueteRequest;
use App\Http\Resources\QueteResource;
use App\Models\Quete;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class QueteController extends Controller
{
    public function index()
    {
        try {
            $quetes = Quete::with(['parcoursFormation'])->get();

            return response()->json([
                'success' => true,
                'data' => QueteResource::collection($quetes)
            ]);

        } catch (\Exception $e) {

            Log::error('Erreur index Quete: '.$e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la récupération des quêtes'
            ], 500);
        }
    }

    public function store(QueteRequest $request)
    {
        try {
            $quete = Quete::create($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Quête créée avec succès',
                'data' => new QueteResource($quete)
            ], 201);

        } catch (\Exception $e) {

            Log::error('Erreur store Quete: '.$e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la création de la quête'
            ], 500);
        }
    }

    public function show(Quete $quete)
    {
        try {
            $quete->load(['parcoursFormation', 'activites']);

            return response()->json([
                'success' => true,
                'data' => new QueteResource($quete)
            ]);

        } catch (\Exception $e) {

            Log::error('Erreur show Quete: '.$e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la récupération'
            ], 500);
        }
    }

    public function update(QueteRequest $request, Quete $quete)
    {
        try {
            $quete->update($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Quête mise à jour',
                'data' => new QueteResource($quete)
            ]);

        } catch (\Exception $e) {

            Log::error('Erreur update Quete: '.$e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la mise à jour'
            ], 500);
        }
    }

    public function destroy(Quete $quete)
    {
        try {

            if ($quete->activites()->count() > 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Impossible de supprimer une quête avec des activités'
                ], 400);
            }

            $quete->delete();

            return response()->json([
                'success' => true,
                'message' => 'Quête supprimée'
            ]);

        } catch (\Exception $e) {

            Log::error('Erreur delete Quete: '.$e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la suppression'
            ], 500);
        }
    }

    public function getQuetesByEtudiant()
    {
        try {

            $user = auth()->user();

            $quetes = $user->quetes()
                ->with(['parcoursFormation'])
                ->get();

            return response()->json([
                'success' => true,
                'data' => QueteResource::collection($quetes)
            ]);

        } catch (\Exception $e) {

            Log::error('Erreur getQuetesByEtudiant: '.$e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la récupération des quêtes'
            ], 500);
        }
    }
}
