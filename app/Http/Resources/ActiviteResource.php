<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ActiviteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'titre' => $this->titre,
            'description' => $this->description,
            'duree' => $this->duree,
            'statut' => $this->statut,
            'ordreAffichage' => $this->ordreAffichage,
            'typeActivite' => $this->typeActivite,
            'typeLivrable' => $this->typeLivrable,

            'quete' => new QueteResource(
                $this->whenLoaded('quete')
            ),


            'criteres' => CritereEvaluationResource::collection(
                $this->whenLoaded('criteres')
            ),

            'livrables' => LivrableResource::collection(
                $this->whenLoaded('livrables')
            ),

            'questions' => QuestionResource::collection(
                $this->whenLoaded('questions')
            ),

            'ressources' => RessourceResource::collection(
                $this->whenLoaded('ressources')
            ),
        ];
    }
}
