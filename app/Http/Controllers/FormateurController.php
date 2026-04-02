<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Resources\ApprenantResource;
use App\Models\Apprenant;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class FormateurController extends Controller
{
    public function storeFormateur(RegisterRequest $request)
    {
        try{
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
                'user' => new ApprenantResource($formateur)
            ], 201);
        }catch (\Exception $e){
            Log::debug($e->getMessage());
            return response()->json(['error' => 'Erreur'], 500);
        }
    }

    public function updateFormateur(RegisterRequest $request, Apprenant $formateur)
    {
        try{
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
                'data' => new ApprenantResource($formateur)
            ]);
        }catch (\Exception $e){
            Log::debug($e->getMessage());
            return response()->json(['error' => 'Erreur'], 500);
        }
    }

    public function deleteFormateur(Apprenant $formateur)
    {
        try {
            if ($formateur->role !== 'formateur') {
                return response()->json([
                    'message' => 'Action impossible'
                ], 403);
            }

            $formateur->delete();

            return response()->json([
                'message' => 'Formateur supprimé avec succès'
            ]);

        } catch (\Exception $e){
            Log::debug($e->getMessage());
            return response()->json(['error' => 'Erreur'], 500);
        }
    }

    public function showFormateur(Apprenant $formateur)
    {
        try {
            if ($formateur->role !== 'formateur') {
                return response()->json([
                    'success' => false,
                    'message' => 'Utilisateur non trouvé ou n\'est pas un formateur.'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => new ApprenantResource($formateur)
            ]);
        }catch (\Exception $e){
            Log::debug($e->getMessage());
            return response()->json(['error' => 'Erreur'], 500);
        }
    }

    public function indexFormateur()
    {
        try {
            $formateurs = Apprenant::formateurs()->get();

            return ApprenantResource::collection($formateurs);

        } catch (\Exception $e){
            Log::debug($e->getMessage());
            return response()->json(['error' => 'Erreur'], 500);
        }
    }



}
