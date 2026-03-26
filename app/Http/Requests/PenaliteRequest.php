<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PenaliteRequest extends FormRequest
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
            'apprenant_id' => 'required|exists:apprenants,id',
            'dureeInitial' => 'required|integer|min:0',
            'tempsDeRetard' => 'required|integer|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'apprenant_id.required' => 'L\'identifiant de l\'apprenant est obligatoire.',
            'apprenant_id.exists' => 'L\'apprenant sélectionné n\'existe pas dans notre système.',

            'dureeInitial.required' => 'La durée initiale est obligatoire.',
            'dureeInitial.integer' => 'La durée initiale doit être un nombre entier.',
            'dureeInitial.min' => 'La durée initiale ne peut pas être négative.',

            'tempsDeRetard.required' => 'Le temps de retard est obligatoire.',
            'tempsDeRetard.integer' => 'Le temps de retard doit être un nombre entier.',
            'tempsDeRetard.min' => 'Le temps de retard ne peut pas être négatif.',
        ];
    }
}
