<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApprenantQueteResource extends JsonResource
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
            'statut' => $this->pivot->statut ?? null,
            'dureeEffective' => $this->pivot->dureeEffective ?? null,
            'dateSoumission' => $this->pivot->dateSoumission ?? null,
        ];
    }
}
