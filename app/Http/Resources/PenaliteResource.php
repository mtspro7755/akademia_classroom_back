<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PenaliteResource extends JsonResource
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
            'dureeInitial' => $this->dureeInitial,
            'tempsDeRetard' => $this->tempsDeRetard,
            'penalite' => $this->penalite,

            'apprenant' => new ApprenantResource(
                $this->whenLoaded('apprenant')
            ),

            'created_at' => $this->created_at?->toDateTimeString(),
        ];
    }
}
