<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CohorteRequest extends FormRequest
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
            'nom' => 'required|string|max:255',
            'capaciteMax' => 'required|integer|min:1',
            'dateDebut' => 'required|date',
            'dateFin' => 'required|date|after_or_equal:dateDebut',
            'statut' => 'required|in:EnAttente,EnCours,Termine',
            'parcours_formation_id' => 'required|exists:parcours_formations,id',
        ];
    }

    public function messages(): array
    {
        return [
            'nom.required' => 'Le nom de la promotion est obligatoire.',
            'nom.string' => 'Le nom doit être une chaîne de caractères.',
            'nom.max' => 'Le nom ne doit pas dépasser 255 caractères.',

            'capaciteMax.required' => 'La capacité maximale est obligatoire.',
            'capaciteMax.integer' => 'La capacité maximale doit être un nombre entier.',
            'capaciteMax.min' => 'La capacité maximale doit être au moins 1.',

            'dateDebut.required' => 'La date de début est obligatoire.',
            'dateDebut.date' => 'La date de début doit être une date valide.',

            'dateFin.required' => 'La date de fin est obligatoire.',
            'dateFin.date' => 'La date de fin doit être une date valide.',
            'dateFin.after_or_equal' => 'La date de fin doit être postérieure ou égale à la date de début.',

            'statut.required' => 'Le statut est obligatoire.',
            'statut.in' => 'Le statut doit être : EnAttente, EnCours ou Termine.',

            'parcours_formation_id.required' => 'Le parcours de formation est obligatoire.',
            'parcours_formation_id.exists' => 'Le parcours de formation sélectionné n\'existe pas.',
        ];
    }
}
