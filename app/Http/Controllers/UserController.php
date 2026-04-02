<?php

namespace App\Http\Controllers;

use App\Http\Resources\ApprenantResource;
use App\Models\Apprenant;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function block(Apprenant $user)
    {
        try{
            $user->update([
                'statutCompte' => false
            ]);

            return response()->json([
                'message' => 'Le compte de ' . $user->nomComplet . ' a été bloqué.',
                'user' => new ApprenantResource($user)
            ]);
        }catch (\Exception $e) {
            Log::debug($e->getMessage());

            return response()->json(['error' => 'Erreur'], 500);
        }
    }

    public function unblock(Apprenant $user)
    {
        try{
            $user->update([
                'statutCompte' => true
            ]);

            return response()->json([
                'message' => 'Le compte de ' . $user->nomComplet . ' a été débloqué.',
                'user' => new ApprenantResource($user)
            ]);
        }catch (\Exception $e) {
            Log::debug($e->getMessage());

            return response()->json(['error' => 'Erreur'], 500);
        }
    }

    public function destroy(Apprenant $user)
    {
        try{
            $user->delete();

            return response()->json([
                'message' => 'Utilisateur supprimé avec succès.'
            ]);
        }catch (\Exception $e) {
            Log::debug($e->getMessage());

            return response()->json(['error' => 'Erreur'], 500);
        }
    }

    public function index()
    {
        try {
            $users = Apprenant::with([
                'profil',
                'cohortes',
                'penalites'
            ])->get();

            return ApprenantResource::collection($users);

        } catch (\Exception $e) {
            Log::debug($e->getMessage());

            return response()->json(['error' => 'Erreur'], 500);
        }
    }

    public function show(Apprenant $user)
    {
        try {
            $user->load([
                'profil',
                'cohortes',
                'penalites',
                'posts',
                'quetes',
                'livrables'
            ]);

            return new ApprenantResource($user);

        } catch (\Exception $e) {
            Log::debug($e->getMessage());

            return response()->json(['error' => 'Erreur'], 500);
        }
    }
}
