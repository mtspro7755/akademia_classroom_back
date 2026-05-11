<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class LivrableRequest extends FormRequest
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
        $rules = [
            'apprenant_id' => 'required|exists:apprenants,id',
            'activite_id' => 'required|exists:activites,id',
            'lienDuRepertoire' => 'required|string|max:255|url',
            'lienDeploye' => 'nullable|string|max:255|url',
            'typeLivrable' => 'required|in:projet,exercice,rapport,autre',
            'statutCorrection' => 'sometimes|in:en_attente,en_cours,corrige,rejete',
            'dateSoumission' => 'nullable|date|before_or_equal:today',
            'dureeEffectue' => 'nullable|integer|min:0|max:9999',
            'dureeActivite' => 'nullable|integer|min:0|max:9999',
        ];

        // Pour la mise à jour, rendre certains champs optionnels
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $rules['apprenant_id'] = 'sometimes|required|exists:apprenants,id';
            $rules['activite_id'] = 'sometimes|required|exists:activites,id';
            $rules['lienDuRepertoire'] = 'sometimes|required|string|max:255|url';
            $rules['typeLivrable'] = 'sometimes|required|in:projet,exercice,rapport,autre';
        }

        return $rules;
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'apprenant_id.required' => 'L\'apprenant est obligatoire',
            'apprenant_id.exists' => 'L\'apprenant sélectionné n\'existe pas',
            'activite_id.required' => 'L\'activité est obligatoire',
            'activite_id.exists' => 'L\'activité sélectionnée n\'existe pas',
            'lienDuRepertoire.required' => 'Le lien du répertoire est obligatoire',
            'lienDuRepertoire.url' => 'Le lien du répertoire doit être une URL valide',
            'lienDeploye.url' => 'Le lien déployé doit être une URL valide',
            'typeLivrable.required' => 'Le type de livrable est obligatoire',
            'typeLivrable.in' => 'Le type de livrable doit être: projet, exercice, rapport ou autre',
            'statutCorrection.in' => 'Le statut de correction doit être: en_attente, en_cours, corrige ou rejete',
            'dateSoumission.before_or_equal' => 'La date de soumission ne peut pas être dans le futur',
            'dureeEffectue.min' => 'La durée effectuée doit être positive',
            'dureeEffectue.max' => 'La durée effectuée ne peut pas dépasser 9999',
            'dureeActivite.min' => 'La durée de l\'activité doit être positive',
            'dureeActivite.max' => 'La durée de l\'activité ne peut pas dépasser 9999',
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        $response = new JsonResponse([
            'success' => false,
            'message' => 'Validation failed',
            'errors' => $validator->errors()
        ], 422);

        throw new ValidationException($validator, $response);
    }
}
