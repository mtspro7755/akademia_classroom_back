<?php

namespace App\Http\Controllers;

use App\Models\Apprenant;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function block($id)
    {
        $user=Apprenant::findOrFail($id);
        $user->update(['statutCompte' => false ]);

        return response()->json(['message' => 'Le compte de ' . $user->nomComplet . ' a été bloqué.']);
    }

    public function unblock($id)
    {
        $user=Apprenant::findOrFail($id);
        $user->update(['statutCompte' => true ]);

        return response()->json(['message' => 'Le compte de ' . $user->nomComplet . ' a été débloqué.']);
    }


    public function destroy($id)
    {
        $user = Apprenant::findOrfail($id);
        $user->delete();

        return response()->json(['message' => 'Utilisateur supprimé avec succès.']);
    }
}
