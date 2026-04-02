<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActiviteRequest;
use App\Http\Resources\ActiviteResource;
use App\Http\Resources\CritereEvaluationResource;
use App\Http\Resources\QuestionResource;
use App\Models\Activite;
use App\Models\Quete;
use App\Models\Ressource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ActiviteController extends Controller
{
    public function index()
    {
        try {
            $activites = Activite::with([
                'quete',
                'criteres',
                'questions',
                'ressources',
                'livrables'
            ])->get();

            return response()->json([
                'success' => true,
                'data' => ActiviteResource::collection($activites)
            ]);

        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Erreur récupération des activités'
            ], 500);
        }
    }

    public function store(ActiviteRequest $request)
    {
        try {
            $activite = Activite::create($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Activité créée avec succès',
                'data' => new ActiviteResource($activite)
            ], 201);

        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Erreur création activité'
            ], 500);
        }
    }


    public function show(Activite $activite)
    {
        try {
            $activite->load([
                'quete',
                'criteres',
                'questions',
                'Ressources',
                'livrables'
            ]);

            return response()->json([
                'success' => true,
                'data' => new ActiviteResource($activite)
            ]);

        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Erreur récupération activité'
            ], 500);
        }
    }

    public function update(ActiviteRequest $request, Activite $activite)
    {
        try {
            $activite->update($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Activité mise à jour',
                'data' => new ActiviteResource($activite)
            ]);

        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Erreur mise à jour'
            ], 500);
        }
    }


    public function destroy(Activite $activite)
    {
        try {
            $activite->delete();

            return response()->json([
                'success' => true,
                'message' => 'Activité supprimée'
            ]);

        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Erreur suppression'
            ], 500);
        }
    }

    public function getByQuete(Quete $quete)
    {
        try {
            $activites = $quete->activites()->with([
                'questions',
                'criteres'
            ])->get();

            return response()->json([
                'success' => true,
                'data' => ActiviteResource::collection($activites)
            ]);

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Erreur recuperation'
            ], 500);
        }
    }

    public function attachRessources(Request $request, Activite $activite)
    {
        try {
            $activite->ressources()->syncWithoutDetaching($request->ressources);

            return response()->json([
                'message' => 'Ressources ajoutées'
            ]);
        }catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Erreur ajout ressource'
            ],500);
        }
    }

    public function detachRessource(Activite $activite, Ressource $ressource)
    {
        try {
            $activite->ressources()->detach($ressource->id);

            return response()->json([
                'message' => 'Ressource retirée'
            ]);
        }catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Erreur suppression ressource'
            ]);
        }
    }


    public function addQuestion(Request $request, Activite $activite)
    {
        try {
            $question = $activite->questions()->create([
                'intitule' => $request->intitule
            ]);

            return response()->json([
                'message' => 'Question ajoutée',
                'data' => new QuestionResource($question)
            ]);
        }catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Erreur ajout question'
            ],500);
        }
    }

    public function addCritere(Request $request, Activite $activite)
    {
        try {
            $critere = $activite->criteres()->create([
                'critere' => $request->critere,
                'question' => $request->question,
                'point' => $request->point
            ]);

            return response()->json([
                'message' => 'Critère ajouté',
                'data' => new CritereEvaluationResource($critere)
            ]);
        }catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Erreur ajout critere'
            ],500);
        }
    }

    public function reorder(Request $request)
    {
        try {
            foreach ($request->activites as $item) {
                Activite::where('id', $item['id'])
                    ->update(['ordreAffichage' => $item['ordre']]);
            }

            return response()->json([
                'message' => 'Ordre mis à jour'
            ]);
        }catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Erreur ordre'
            ],500);
        }
    }

    public function changeStatut(Request $request, Activite $activite)
    {
        try {
            $activite->update([
                'statut' => $request->statut
            ]);

            return response()->json([
                'message' => 'Statut mis à jour',
                'data' => new ActiviteResource($activite)
            ]);
        }catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Erreur statut'
            ],500);
        }
    }


    public function myActivites()
    {
        try {
            $user = auth()->user();

            $activites = Activite::whereHas('quete.apprenants', function ($q) use ($user) {
                $q->where('apprenant_id', $user->id);
            })->with('quete')->get();

            return ActiviteResource::collection($activites);
        }catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Erreur liste activites'
            ],500);
        }
    }

}
