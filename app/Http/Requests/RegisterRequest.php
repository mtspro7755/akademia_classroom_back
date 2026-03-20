<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nomComplet' => 'required|string|max:100',
            'phone' => 'required|string|max:9',
            'email' => 'required|email|unique:apprenants,email',
            'password' => 'required|min:6',
            'pseudo' => 'required|string|unique:apprenants,pseudo',
            'profil_id' => 'required|exists:profils,id',
        ];
    }

    public function messages(): array
    {
        return [
            'nomComplet.required' => 'Le nom complet est obligatoire.',
            'nomComplet.max' => 'Le nom ne doit pas dépasser 100 caractères.',

            'phone.required' => 'Le numéro de téléphone est obligatoire.',
            'phone.max' => 'Le numéro doit contenir au maximum 9 chiffres.',

            'email.required' => 'L’email est obligatoire.',
            'email.email' => 'Veuillez entrer un email valide.',
            'email.unique' => 'Cet email est déjà utilisé.',

            'password.required' => 'Le mot de passe est obligatoire.',
            'password.min' => 'Le mot de passe doit contenir au moins 6 caractères.',

            'pseudo.required' => 'Le pseudo est obligatoire.',
            'pseudo.unique' => 'Ce pseudo est déjà pris.',

            'profil_id.required' => 'Le profil est obligatoire.',
            'profil_id.exists' => 'Le profil n\'existe pas.',
        ];
    }
}
