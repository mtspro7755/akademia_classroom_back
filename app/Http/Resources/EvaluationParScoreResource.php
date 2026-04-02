<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EvaluationParScoreResource extends JsonResource
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
            'score' => $this->score,
            'commentaire' => $this->commentaire,

            'critere' => new CritereEvaluationResource(
                $this->whenLoaded('critere')
            ),

            'livrable' => new LivrableResource(
                $this->whenLoaded('livrable')
            ),
        ];

    }
}
