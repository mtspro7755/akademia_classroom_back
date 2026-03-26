<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QueteRequest extends FormRequest
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
            'titre' => 'required|string|max:255',
            'statut' => 'required|in:Actif,Inactif',
            'dateDebut' => 'required|date',
            'dateLimite' => 'required|date|after_or_equal:dateDebut',
            'niveauDifficulte' => 'required|integer|min:1|max:5',
            'parcours_formation_id' => 'required|exists:parcours_formations,id',
        ];
    }

    public function messages(): array
    {
        return [
            'titre.required' => 'Le titre de la quête est obligatoire.',
            'titre.string' => 'Le titre doit être une chaîne de caractères.',
            'titre.max' => 'Le titre ne doit pas dépasser 255 caractères.',

            'statut.required' => 'Le statut est obligatoire.',
            'statut.in' => 'Le statut doit être : Actif ou Inactif.',

            'dateDebut.required' => 'La date de début est obligatoire.',
            'dateDebut.date' => 'La date de début doit être une date valide.',

            'dateLimite.required' => 'La date limite est obligatoire.',
            'dateLimite.date' => 'La date limite doit être une date valide.',
            'dateLimite.after_or_equal' => 'La date limite doit être postérieure ou égale à la date de début.',

            'niveauDifficulte.required' => 'Le niveau de difficulté est obligatoire.',
            'niveauDifficulte.integer' => 'Le niveau de difficulté doit être un nombre entier.',
            'niveauDifficulte.min' => 'Le niveau de difficulté doit être au minimum 1.',
            'niveauDifficulte.max' => 'Le niveau de difficulté ne peut pas dépasser 5.',

            'parcours_formation_id.required' => 'Le parcours de formation est obligatoire.',
            'parcours_formation_id.exists' => 'Le parcours de formation sélectionné n\'existe pas.',
        ];
    }
}
