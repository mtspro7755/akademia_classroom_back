<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Apprenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'nomComplet' => 'required|string',
            'phone' => 'required|string|max:9',
            'email' => 'required|string|email|unique:apprenants',
            'password' => 'required|min:6',
            'pseudo' => 'required|unique:apprenants',
            'role' => 'nullable|string'
        ]);

        $apprenant = Apprenant::create([
            'nomComplet' => $data['nomComplet'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
            'pseudo' => $data['pseudo'],
            'role' => $data['role'],
            'statutCompte' => true
        ]);

        try{
            Mail::to($apprenant->email)->send(new WelcomeMail($apprenant));
        }catch (\Exception $e){
            \Log::error("Erreur d'envoi de mail : " . $e->getMessage());
        }

        return response()->json($apprenant,201);
    }
}
