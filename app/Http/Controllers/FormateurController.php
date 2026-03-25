<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\Apprenant;
use Illuminate\Support\Facades\Hash;

class FormateurController extends Controller
{
    public function storeFormateur(RegisterRequest $request)
    {
        $data = $request->validated();

        $formateur = Apprenant::create([
            'nomComplet' => $data['nomComplet'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
            'profil_id' => $data['profil_id'],
            'role' => 'formateur',
            'statutCompte' => true
        ]);

        return response()->json([
            'message' => 'Compte créé avec succès',
            'user'=>$formateur
        ], 201);
    }

    public function updateFormateur(RegisterRequest $request, Apprenant $formateur)
    {
        $data = $request->validated();

        $updateData = [
            'nomComplet'   => $data['nomComplet'],
            'email'        => $data['email'],
            'phone'        => $data['phone'],
            'profil_id'    => $data['profil_id'],
            'role'         => 'formateur',
            'statutCompte' => true,
        ];

        if (!empty($data['password'])) {
            $updateData['password'] = Hash::make($data['password']);
        }

        $formateur->update($updateData);

        return response()->json([
            'success' => true,
            'message' => 'Formateur mis à jour avec succès',
            'data'    => $formateur
        ]);
    }

    public function deleteFormateur(Apprenant $formateur)
    {
        if ($formateur->role !== 'formateur') {
            return response()->json([
                'message' => 'Action impossible : cet utilisateur n\'est pas un formateur.'
            ], 403);
        }
        return response()->json([
            'message' => 'Formateur supprimé avec succès'
        ]);
    }

    public function showFormateur(Apprenant $formateur)
    {
        if ($formateur->role !== 'formateur') {
            return response()->json([
                'success' => false,
                'message' => 'Utilisateur non trouvé ou n\'est pas un formateur.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $formateur
        ]);
    }

    public function indexFormateur()
    {
        return response()->json([
            'success' => true,
            'data' => Apprenant::formateurs()->get()
        ]);
    }



}
