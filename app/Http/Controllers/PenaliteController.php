<?php

namespace App\Http\Controllers;

use App\Http\Requests\PenaliteRequest;
use App\Models\Apprenant;
use App\Models\Penalite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PenaliteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $penalites = Penalite::with('apprenant')->get();

            return response()->json([
                'success' => true,
                'data' => $penalites
            ]);
        } catch (\Exception $e) {
            Log::debug($e->getMessage());

            return response()->json([
                'error' => 'Erreur lors de la récupération des pénalités'
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PenaliteRequest $request)
    {
        try {

            $penalite = Penalite::create($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Pénalité attribuée avec succès',
                'data' => $penalite
            ], 201);

        } catch (\Exception $e) {
            Log::debug($e->getMessage());

            return response()->json([
                'error' => 'Erreur lors de la création de la pénalité'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Penalite $penalite)
    {
        try {
            return response()->json([
                'success' => true,
                'data' => $penalite->load('apprenant')
            ]);
        } catch (\Exception $e) {
            Log::debug($e->getMessage());

            return response()->json([
                'error' => 'Erreur lors de la récupération'
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PenaliteRequest $request, Penalite $penalite)
    {
        try {
            $penalite->update($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Pénalité mise à jour',
                'data' => $penalite
            ]);
        } catch (\Exception $e) {
            Log::debug($e->getMessage());

            return response()->json([
                'error' => 'Erreur lors de la mise à jour'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penalite $penalite)
    {
        try {
            $penalite->delete();

            return response()->json([
                'success' => true,
                'message' => 'Pénalité supprimée'
            ]);
        } catch (\Exception $e) {
            Log::debug($e->getMessage());

            return response()->json([
                'error' => 'Erreur lors de la suppression'
            ], 500);
        }
    }

    public function apprenantsAvecPenalites()
    {
        try {
            $apprenants = Apprenant::whereHas('penalites')
                ->with('penalites')
                ->get();

            return response()->json([
                'success' => true,
                'data' => $apprenants
            ]);
        } catch (\Exception $e) {
            Log::debug($e->getMessage());

            return response()->json([
                'error' => 'Erreur lors de la récupération'
            ], 500);
        }
    }
}
