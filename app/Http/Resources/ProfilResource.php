<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfilResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'typeProfil'=> $this->typeProfil,
            'description' => $this->description,
            'niveauMinimal'=> $this->niveauMinimal,
            'niveauMaximal' => $this->niveauMaximal,

            'apprenants' => ApprenantResource::collection(
                $this->whenLoaded('apprenants')
            ),
        ];
    }
}
