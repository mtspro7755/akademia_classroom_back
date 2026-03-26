<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'contenu' => 'required|string',
            'description' => 'nullable|string',
            'typePost' => 'required|in:question,reponse,annonce',
            'thematique_id' => 'required|exists:thematiques,id',
            'parent_post_id' => 'nullable|exists:posts,id'
        ];
    }

    public function messages(): array
    {
        return [
            'contenu.required' => 'Le contenu du message est obligatoire.',
            'contenu.string' => 'Le contenu doit être une chaîne de caractères valide.',

            'description.string' => 'La description doit être une chaîne de caractères.',

            'typePost.required' => 'Le type de publication est obligatoire.',
            'typePost.in' => 'Le type de publication doit être : question, réponse ou annonce.',

            'thematique_id.required' => 'La thématique est obligatoire.',
            'thematique_id.exists' => 'La thématique sélectionnée n\'existe pas.',

            'parent_post_id.exists' => 'Le message parent auquel vous faites référence n\'existe pas.',
        ];
    }
}
