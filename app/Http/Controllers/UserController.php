<?php

namespace App\Http\Controllers;

use App\Models\Apprenant;

class UserController extends Controller
{
    public function block(Apprenant $user)
    {
        $user->update([
            'statutCompte' => false
        ]);

        return response()->json([
            'message' => 'Le compte de ' . $user->nomComplet . ' a été bloqué.'
        ]);
    }

    public function unblock(Apprenant $user)
    {
        $user->update([
            'statutCompte' => true
        ]);

        return response()->json([
            'message' => 'Le compte de ' . $user->nomComplet . ' a été débloqué.'
        ]);
    }

    public function destroy(Apprenant $user)
    {
        $user->delete();

        return response()->json([
            'message' => 'Utilisateur supprimé avec succès.'
        ]);
    }

    public function index()
    {
        return response()->json([Apprenant::all()]);
    }

    public function show(Apprenant $user)
    {
        return response()->json([$user]);
    }
}
