<?php

namespace App\Http\Controllers;

use App\Models\Thematique;
use App\Http\Requests\ThematiqueRequest;
use Illuminate\Support\Facades\Log;

class ThematiqueController extends Controller
{
    public function index()
    {
        try {
            $thematiques = Thematique::all();

            return response()->json([
                'success' => true,
                'data' => $thematiques
            ]);

        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Erreur récupération'
            ], 500);
        }
    }

    public function store(ThematiqueRequest $request)
    {
        try {
            $thematique = Thematique::create($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Thématique créée',
                'data' => $thematique
            ], 201);

        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Erreur création'
            ], 500);
        }
    }

    public function show(Thematique $thematique)
    {
        try {
            return response()->json([
                'success' => true,
                'data' => $thematique
            ]);

        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Erreur récupération'
            ], 500);
        }
    }

    public function update(ThematiqueRequest $request, Thematique $thematique)
    {
        try {
            $thematique->update($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Thématique mise à jour',
                'data' => $thematique
            ]);

        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Erreur mise à jour'
            ], 500);
        }
    }

    public function destroy(Thematique $thematique)
    {
        try {
            $thematique->delete();

            return response()->json([
                'success' => true,
                'message' => 'Thématique supprimée'
            ]);

        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Erreur suppression'
            ], 500);
        }
    }
}
