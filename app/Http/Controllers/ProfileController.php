<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    public function updateInfo(ProfileRequest $request)
    {
        try{
            $user = auth()->user();

            $user->update([
                'nomComplet' => $request->nomComplet ?? $user->nomComplet,
                'email' => $request->email ?? $user->email,
            ]);

            return response()->json([
                'message' => 'Profil mis à jour',
                'user' => $user
            ]);
        }catch (\Exception $e) {
            Log::debug($e->getMessage());

            return response()->json(['error' => 'Erreur'], 500);
        }
    }

    public function changePassword(ProfileRequest $request){
        try{
            $user = auth()->user();

            if (!Hash::check($request->old_password, $user->password)) {
                return response()->json([
                    'message' => 'Ancien mot de passe incorrect'
                ], 400);
            }

            if (!$request->new_password) {
                return response()->json([
                    'message' => 'Nouveau mot de passe requis'
                ], 400);
            }

            $user->password=Hash::make($request->new_password);
            $user->save();

            return response()->json([
                'message' => 'Mot de passe modifié avec succès'
            ]);
        }catch (\Exception $e) {
            Log::debug($e->getMessage());

            return response()->json(['error' => 'Erreur'], 500);
        }
    }
}
