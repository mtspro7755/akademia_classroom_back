<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (!$token = auth()->attempt($credentials)) {
            return response()->json([
                'message' => 'Identifiants invalides'
            ], 401);
        }

        $user = auth()->user();

        if (!$user->statutCompte) {
            return response()->json([
                'message' => 'Compte bloqué'
            ], 403);
        }

        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'apprenant' => auth()->user()
        ]);
    }


    public function logout(){
        try{
            JWTAuth::invalidate(JWTAuth::getToken());

            return response()->json([
                'message' => 'Déconnexion réussie'
            ]);
        }catch(\Exception $e){
            return response()->json([
                'error' => 'Impossible de se déconnecter'
            ],500);
        }
    }
}
