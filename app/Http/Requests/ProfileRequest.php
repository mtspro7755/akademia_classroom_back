<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'nomComplet' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:apprenants,email,' . auth()->id(),
            'phone' => 'sometimes|string|max:9',

            'old_password' => 'required_with:new_password',
            'new_password' => 'nullable|min:6|confirmed',
        ];
    }

    public function messages(): array
    {
        return [
            'nomComplet.string' => 'Le nom complet doit être une chaîne de caractères valide.',
            'nomComplet.max' => 'Le nom complet ne peut pas dépasser 255 caractères.',

            'email.email' => 'Veuillez saisir une adresse email valide.',
            'email.unique' => 'Cette adresse email est déjà utilisée par un autre compte.',

            'phone.string' => 'Le numéro de téléphone doit être une chaîne de caractères valide.',
            'phone.max' => 'Le numéro de téléphone ne peut pas dépasser 9 caractères.',

            'old_password.required_with' => 'Vous devez saisir votre mot de passe actuel pour définir un nouveau mot de passe.',
            'new_password.min' => 'Le nouveau mot de passe doit contenir au moins 6 caractères.',
            'new_password.confirmed'=> 'La confirmation du nouveau mot de passe ne correspond pas.',
        ];
    }
}
