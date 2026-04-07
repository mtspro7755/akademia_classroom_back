<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ParcoursFormationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // ou auth()->check() pour restreindre aux utilisateurs connectés
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $parcoursId = $this->route('parcours_formation') ? $this->route('parcours_formation')->id : null;

        return [
            'intitule' => [
                'required',
                'string',
                'max:255',
                'unique:parcours_formations,intitule,' . $parcoursId
            ],
        ];
    }

    /**
     * Get the custom validation messages.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'intitule.required' => 'L\'intitulé du parcours de formation est obligatoire.',
            'intitule.string' => 'L\'intitulé doit être une chaîne de caractères valide.',
            'intitule.max' => 'L\'intitulé ne doit pas dépasser 255 caractères.',
            'intitule.unique' => 'Ce parcours de formation existe déjà. Veuillez saisir un intitulé différent.',
        ];
    }
}
