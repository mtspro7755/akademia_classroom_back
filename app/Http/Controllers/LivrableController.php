<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LivrableRequest;
use App\Http\Resources\LivrableResource;
use App\Models\Livrable;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class LivrableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $query = Livrable::with(['apprenant', 'activite', 'scores', 'feedback', 'penalites']);

        // Filtrer par apprenant si spécifié
        if ($request->has('apprenant_id')) {
            $query->where('apprenant_id', $request->apprenant_id);
        }

        // Filtrer par activité si spécifié
        if ($request->has('activite_id')) {
            $query->where('activite_id', $request->activite_id);
        }

        // Filtrer par statut si spécifié
        if ($request->has('statut_correction')) {
            $query->where('statutCorrection', $request->statut_correction);
        }

        // Filtrer les livrables en retard
        if ($request->has('en_retard')) {
            $query->where('estEnRetard', $request->boolean('en_retard'));
        }

        $livrables = $query->paginate($request->get('per_page', 15));

        return response()->json([
            'success' => true,
            'data' => LivrableResource::collection($livrables),
            'meta' => [
                'current_page' => $livrables->currentPage(),
                'last_page' => $livrables->lastPage(),
                'per_page' => $livrables->perPage(),
                'total' => $livrables->total(),
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LivrableRequest $request): JsonResponse
    {
        try {
            $livrable = Livrable::create($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Livrable created successfully',
                'data' => new LivrableResource($livrable->load(['apprenant', 'activite']))
            ], 201);

        } catch (\Exception $e) {
            Log::error('Erreur création livrable: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la création du livrable'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Livrable $livrable): JsonResponse
    {
        try {
            return response()->json([
                'success' => true,
                'data' => new LivrableResource($livrable->load(['apprenant', 'activite', 'scores', 'feedback', 'reponsesQuestions', 'penalites']))
            ]);

        } catch (\Exception $e) {
            Log::error('Erreur affichage livrable: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'affichage du livrable'
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LivrableRequest $request, Livrable $livrable): JsonResponse
    {
        try {
            $livrable->update($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Livrable updated successfully',
                'data' => new LivrableResource($livrable->load(['apprenant', 'activite']))
            ]);

        } catch (\Exception $e) {
            Log::error('Erreur mise à jour livrable: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la mise à jour du livrable'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Livrable $livrable): JsonResponse
    {
        try {
            $livrable->delete();

            return response()->json([
                'success' => true,
                'message' => 'Livrable deleted successfully'
            ]);

        } catch (\Exception $e) {
            Log::error('Erreur suppression livrable: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la suppression du livrable'
            ], 500);
        }
    }

    /**
     * Get livrables for the authenticated apprenant
     */
    public function mesLivrables(): JsonResponse
    {
        $user = auth()->user();
        $apprenant = $user->apprenant;

        if (!$apprenant) {
            return response()->json([
                'success' => false,
                'message' => 'User is not an apprenant'
            ], 403);
        }

        $livrables = Livrable::where('apprenant_id', $apprenant->id)
            ->with(['activite', 'scores', 'feedback', 'penalites'])
            ->paginate(15);

        return response()->json([
            'success' => true,
            'data' => LivrableResource::collection($livrables),
            'meta' => [
                'current_page' => $livrables->currentPage(),
                'last_page' => $livrables->lastPage(),
                'per_page' => $livrables->perPage(),
                'total' => $livrables->total(),
            ]
        ]);
    }

    /**
     * Get livrables by activity
     */
    public function livrablesByActivite($activiteId): JsonResponse
    {
        $livrables = Livrable::where('activite_id', $activiteId)
            ->with(['apprenant', 'scores', 'feedback', 'penalites'])
            ->paginate(15);

        return response()->json([
            'success' => true,
            'data' => LivrableResource::collection($livrables),
            'meta' => [
                'current_page' => $livrables->currentPage(),
                'last_page' => $livrables->lastPage(),
                'per_page' => $livrables->perPage(),
                'total' => $livrables->total(),
            ]
        ]);
    }

    /**
     * Update correction status
     */
    public function updateStatutCorrection(LivrableRequest $request, Livrable $livrable): JsonResponse
    {
        $livrable->update(['statutCorrection' => $request->validated()['statutCorrection']]);

        return response()->json([
            'success' => true,
            'message' => 'Statut de correction mis à jour avec succès',
            'data' => new LivrableResource($livrable->load(['apprenant', 'activite']))
        ]);
    }
}
