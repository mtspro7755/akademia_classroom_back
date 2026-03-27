<?php

namespace App\Http\Controllers;

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
                'message' => 'Le compte de ' . $user->nomComplet . ' a été bloqué.'
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
                'message' => 'Le compte de ' . $user->nomComplet . ' a été débloqué.'
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
        try{
            return response()->json([Apprenant::all()]);
        }catch (\Exception $e) {
            Log::debug($e->getMessage());

            return response()->json(['error' => 'Erreur'], 500);
        }
    }

    public function show(Apprenant $user)
    {
        try{
            return response()->json([$user]);
        }catch (\Exception $e) {
            Log::debug($e->getMessage());

            return response()->json(['error' => 'Erreur'], 500);
        }
    }
}
