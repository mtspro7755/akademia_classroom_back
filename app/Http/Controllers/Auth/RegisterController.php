<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\Apprenant;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $data = $request->validated();

        $apprenant = Apprenant::create([
            'nomComplet' => $data['nomComplet'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
            'profil_id' => $data['profil_id'] ?? null,
            'role' => 'apprenant',
            'statutCompte' => true
        ]);

        try {
            Mail::to($apprenant->email)->send(new WelcomeMail($apprenant));
        } catch (\Exception $e) {
            \Log::error("Erreur d'envoi de mail : " . $e->getMessage());
        }

        return response()->json([
            'message' => 'Compte créé avec succès',
            'user' => $apprenant
        ], 201);
    }
}
