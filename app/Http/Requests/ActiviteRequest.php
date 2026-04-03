<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActiviteRequest extends FormRequest
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
            'quete_id' => 'required|exists:quetes,id',
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duree' => 'required|integer',
            'statut' => 'required|string',
            'ordreAffichage' => 'nullable|integer',
            'typeActivite' => 'required|string',
            'typeLivrable' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'quete_id.required' => 'L\'identifiant de la quête est obligatoire.',
            'quete_id.exists' => 'La quête sélectionnée n\'existe pas dans notre système.',

            'titre.required' => 'Le titre de l\'activité est obligatoire.',
            'titre.string' => 'Le titre doit être une chaîne de caractères valide.',
            'titre.max' => 'Le titre ne doit pas dépasser 255 caractères.',

            'description.string' => 'La description doit être une chaîne de caractères valide.',

            'duree.required' => 'La durée de l\'activité est obligatoire.',
            'duree.integer' => 'La durée doit être un nombre entier.',

            'statut.required' => 'Le statut de l\'activité est obligatoire.',
            'statut.string' => 'Le statut doit être une chaîne de caractères valide.',

            'ordreAffichage.integer' => 'L\'ordre d\'affichage doit être un nombre entier.',

            'typeActivite.required' => 'Le type d\'activité est obligatoire.',
            'typeActivite.string' => 'Le type d\'activité doit être une chaîne de caractères valide.',

            'typeLivrable.string' => 'Le type de livrable doit être une chaîne de caractères valide.',
        ];
    }
}
