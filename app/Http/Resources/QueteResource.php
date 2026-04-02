<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QueteResource extends JsonResource
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
            'statut' => $this->statut,
            'dateDebut' => $this->dateDebut,
            'dateLimite' => $this->dateLimite,
            'niveauDifficulte' => $this->niveauDifficulte,

            'parcoursFormation' => new ParcoursFormationResource(
                $this->whenLoaded('parcoursFormation')
            ),

            'activites' => ActiviteResource::collection(
                $this->whenLoaded('activites')
            ),

            'apprenants' => ApprenantQueteResource::collection(
                $this->whenLoaded('apprenants')
            ),
        ];
    }
}
