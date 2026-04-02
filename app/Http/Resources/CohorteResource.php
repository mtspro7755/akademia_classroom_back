<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CohorteResource extends JsonResource
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
            'nom' => $this->nom,
            'capaciteMax' => $this->capaciteMax,
            'dateDebut' => $this->dateDebut,
            'dateFin' => $this->dateFin,
            'statut' => $this->statut,

            'parcoursFormation' => new ParcoursFormationResource(
                $this->whenLoaded('parcoursFormation')
            ),

            'apprenants' => ApprenantResource::collection(
                $this->whenLoaded('apprenants')
            ),
        ];
    }
}
