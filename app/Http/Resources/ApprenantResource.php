<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApprenantResource extends JsonResource
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
            'nomComplet' => $this->nomComplet,
            'email' => $this->email,
            'phone' => $this->phone,
            'pseudo' => $this->pseudo,
            'role' => $this->role,
            'statutCompte' => $this->statutCompte,


            'profil' => new ProfilResource($this->whenLoaded('profil')),

            'cohortes' => CohorteResource::collection(
                $this->whenLoaded('cohortes')
            ),

            'penalites' => PenaliteResource::collection(
                $this->whenLoaded('penalites')
            ),

            'posts' => PostResource::collection(
                $this->whenLoaded('posts')
            ),

            'quetes' => ApprenantQueteResource::collection(
                $this->whenLoaded('quetes')
            ),

            'livrables' => LivrableResource::collection(
                $this->whenLoaded('livrables')
            ),

            'created_at' => $this->created_at?->toDateTimeString(),
        ];
    }
}
